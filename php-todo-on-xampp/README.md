# Excercise: Make a ToDo list using Apache, PHP, and MariaDB - in a Xampp environment

## Local Setup
 - Install XAMPP https://www.apachefriends.org/index.html
   - Select the following to install
     - Server
       - Apache
       - MySQL
     - Program Languages
       - PHP
     - Program Languages
       - phpMyAdmin
   - For VsCode and Windows edit your settings.json file with the following
     - `"php.validate.executablePath": "c:/xampp/php/php.exe"`
     - For more on this: https://code.visualstudio.com/docs/languages/php
 - Provision the SQL Database
   - Run the XAMPP Control Panel
     - Make sure MySQL is running - if not click start
   - Navigate to http://localhost/phpmyadmin/index.php
   - Click on the SQL tab
   - Copy everything from ./setup/provision.sql
   - Paste the copied script into the SQL text field and click Go
   - You should now see a new table called todo_app with 4 tables in it
 - Develop with auto app builds
   - If you did not install xampp to your C:/ drive, update config.json now
   - In a terminal/consol run `npm start` to initiate the develop script.
   - While npm start is running, all files under ./src will be mirror to "C:/xampp/htdocs/todoapp" or whatever you configure ./config.json's output_directory to be.
   - This allows you to make changes and commit from this directory while the app will be instantly deployed to the xampp app.
 - View the app
   - Run the XAMPP Control Panel
     - Make sure both Apache & MySQL are running - if not click start on them
     - Navigate to http://localhost/todoapp/index.php