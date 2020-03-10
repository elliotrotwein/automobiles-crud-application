# automobiles-crud-application

A basic CRUD application for automobiles that I built (using LAMP stack) as my final project for 'Building Database Applications in PHP' on Coursera. 

This project showcases the culmination of all that I learned in three sequential courses taken on Coursera.com: Building Web Applications in PHP, Building Database Applications in PHP, Intro to SQL. See more about my experience taking these courses on my blog at....

What does this app do?
  - Enables users to create, update and delete any one of their automobiles (because who doesn't
  have so many cars that they need an application to keep track of them) through the use of a GUI 
  - Displays the many automobiles that one has in a table format so they can admire their prized
  list of assets
  
Technical Features:
 - Home page that requires users to log in before displaying data
 - Form validation (on log in and when adding/updating automobile)
 - POST/REDIRECT/GET to avoid form resubmission issues
 - Flash messages that are passed between files using $_SESSION variables
 - Safe from HTML injection through use of htmlentities()
 - Safe from SQL injection through the use of PDO Library

Technologies used:
  - Linux, Apache Web Server, MySQL, PHP (LAMP)
  - PHP Data Objects (PDO) Library
  - VIM
  - ngrok (tool to tunnel to localhost) 

What's missing in this app?
  - Documentation and more comments that explain the code
  - Better validation. The email validation, which is super lightweight, can easily be passed with
  a username of '@'
  - CSS
  - Client side scripting
  - Other stuff. I'm aware this app could use some work. This project was intented to be very
  basic and used as a medium to developing an understanding of core web development concepts.
  Once I have so many automobiles that I can no longer keep track, my plan is to come back and
  really make this thing amazing.

How to run this app on LinuxOS using previously installed LAMP stack:
  1. Fork the repository and then clone
  2. Copy the cloned repo to your local Apache web server (/var/www/html/)
  3. Create a MySQL database with instructions provided in MySQLQueries.txt (TODO: Need to add
  this file)
  4. Open browser and connect to localhost or 127.0.0.1 to render files copied into /var/www/html/
 


