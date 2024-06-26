Library used 

```
https://github.com/guiribajustin2004/GuiriLibrary
```
> By Justin Sheen Guiriba




## Configuration Prerequisites

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
"C:/xampp/" 
```

7. go to 
```
"C:/xampp/php"
```

8. click on php.ini under php.exe

9. ctrl + f to search for ";extension=gd"

10. remove the ; from ";extension=gd"

11. restart Apache and mySql from xampp control panel
