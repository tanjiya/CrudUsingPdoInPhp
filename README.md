# CRUD using PDO in PHP
 
<h2>User Manual:</h2>
  
- Need to download or clone the project
- Create a Database named **crud_pdo_in_php**
- Create a Table named **employees**
- Table Queries are given below
- Need to put the mySQL user name and password in config/database.php file
- And you are done!
- Just go to your browser and write localhost!
- And Yes, most importantly -- You have to installed Apache, PHP and MySQL on your computer :)

<h2>Upload Image:</h2>

- Need to create a folder name **uploads** in the clonned directory to get the upload file work.
- Folder heirarchy are given below.

<h2>`employees` table queries:</h2>

- CREATE TABLE employees (
- id INT(20) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
- name VARCHAR(50) NOT NULL,
- email VARCHAR(50) NOT NULL,
- website VARCHAR(50) NOT NULL,
- comment VARCHAR(50),
- image_path VARCHAR(255),
- created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
- updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
- );

<h2>Folder hierarchy:</h2>

--config
- database.php

--css
- style.css

--inc
- footer.php
- header.php
- image_upload.php
- record_submit.php 
- record_update.php

--uploads (Store the uploaded image)

--create.php

--delete.php

--edit.php

--index.php
