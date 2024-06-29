Library used 

```
https://github.com/guiribajustin2004/GuiriLibrary
```
> By Justin Sheen Guiriba


## Backend Setup

1. install xampp.

2. open xampp control panel.

3. in apache row, click config, Apache httpd.conf

4. search for:
```
DocumentRoot "C:/xampp/htdocs"
<Directory "C:/xampp/htdocs">
```
rename to 
```
DocumentRoot "C:/xampp/htdocs/[project-name]"
<Directory "C:/xampp/htdocs/[project-name]">
```

5. clone the project

6. move the project folder to 
``` 
"C:/xampp/htdocs" 
```

7. go to 
```
"C:/xampp/php"
```

8. click on php.ini under php.exe

9. ctrl + f to search for ";extension=gd"

10. remove the ; from ";extension=gd"

11. restart Apache and mySql from xampp control panel


## API Setup

1. After setting up the project, get your API key here
```
https://aistudio.google.com/app/apikey
```

2. Go to the project folder and go to the "api" folder.

3. Inside there will be .env.example, rename it to .env only.

4. Replace what comes after API_KEY= with the key that you copied.

5. then go to the api folder in your terminal/cmd and type:
```
pip install dotenv
```
6. then to run the API:
```
python main.py
```
