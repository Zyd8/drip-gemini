import os
from dotenv import load_dotenv
import google.generativeai as genai
from PIL import Image
import json
import re
from flask import Flask, request, jsonify


class DripGemini:


    def __init__(self, api_key, model_name, image_pool):
        self.api_key = api_key
        self.model_name = model_name
        self.image_pool = image_pool
        self.file_ids = {}

        self.configure()

        # Start remembering
        self.chat = self.model.start_chat(history=[])
        self.upload_image_context()


    def configure(self):
        genai.configure(api_key=self.api_key)
        self.model = genai.GenerativeModel(self.model_name)


    @staticmethod
    def parse_tailoring_response(ai_response):
        parsed_data = {
            "introduction": "",
            "outfits": [],
            "end": ""
        }

        # Define regex patterns for each section
        intro_pattern = r"intro: (.*?)\n"
        outfit_pattern = r"outfit: (\d+)\n((?:ware: (.*?)\nid: (.*?)\n)+)reasoning: (.*?)\n"
        end_pattern = r"end: (.*?)$"

        # Find introduction
        intro_match = re.search(intro_pattern, ai_response, re.DOTALL)
        if intro_match:
            parsed_data["introduction"] = intro_match.group(1).strip()

        # Find outfits
        outfit_matches = re.finditer(outfit_pattern, ai_response, re.DOTALL)
        for match in outfit_matches:
            outfit_number = match.group(1)
            reasoning = match.group(5).strip()

            outfits_data = []
            ware_id_pairs = re.findall(r"ware: (.*?)\nid: (.*?)\n", match.group(2))

            for ware_name, image_id in ware_id_pairs:
                outfit_data = {
                    "outfit": outfit_number,
                    "ware": ware_name.strip(),
                    "id": image_id.strip(),
                    "reasoning": reasoning
                }
                outfits_data.append(outfit_data)

            parsed_data["outfits"].extend(outfits_data)

        # Find end
        end_match = re.search(end_pattern, ai_response, re.DOTALL)
        if end_match:
            parsed_data["end"] = end_match.group(1).strip()

        return parsed_data
    
    
    def upload_image_context(self):

        # Send image id with the uploaded image file
        for image_path in self.image_pool:
            with open(image_path, "rb") as image_file:
                image_data = image_file.read()
            
            file_name = os.path.basename(image_path)
            image_id = f"image_id/{file_name}"

            self.chat.send_message({
                "parts": [
                    {"text": f"{image_id}:"},
                    {"mime_type": "image/jpeg", "data": image_data}
                ]
            })


    def tailoring(self, user_prompt):

        user_suggestion = user_prompt

        response = self.chat.send_message(f"""
            Based on the images, {user_suggestion}, I am implying on an outfit.

            Please follow this strict format for your response (Do not include any extra text or decorations):

            intro: [introduction about the outfit I reffered to] (there is only one intro)

            outfit: [number]
            ware: [ware_name]
            id: [ware_id]
            ware: [ware_name]
            id: [ware_id]
            reasoning: [reasoning for the outfit]

            end: [encouraging words about the outfit appended with an emoji] (there is only one end)

            Example:
            intro: This outfit is perfect for a fantastic casual day out!

            outfit: 1
            ware: jacket
            id: jacket.jpg
            ware: shorts
            id: shorts.jpg
            reasoning: The jacket provides warmth while the shorts keep it casual and comfortable.
    
            outfit: 2
            ware: polo shirt
            id: polo.jpg
            ware: slacks
            id: slacks.jpg
            reasoning: The polo shirt adds a touch of sophistication while the slacks offer both style and comfort, making it perfect for a semi-formal occasion.

            end: You will look great in this outfit! 😊
            """)
                    
        parsed_response = DripGemini.parse_tailoring_response(response.text)
        
        return parsed_response


def get_user_image_path(user_id):
    folder_path = os.path.join("..", "views", "uploaded_img", user_id)
    image_paths = []
    print(folder_path)
    for root, dirs, files in os.walk(folder_path):
        for file in files:
            if file.lower().endswith(('.png', '.jpg', '.jpeg', '.webp', '.heic', 'heif')):
                image_paths.append(os.path.join(root, file))
    return image_paths


load_dotenv()

app = Flask(__name__)

@app.route('/tailoring', methods=['POST'])
def tailoring():

    data = request.get_json()
    prompt = data.get('prompt')
    user_id = data.get('user_id')

    drip_gemini = DripGemini(os.getenv("API_KEY"), "gemini-1.5-flash", get_user_image_path(user_id))

    response = drip_gemini.tailoring(prompt)

    return jsonify(response)


if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000, debug=True)

