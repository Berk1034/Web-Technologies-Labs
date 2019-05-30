# Web-Technologies-Labs
Cool PHP Labs

## Lab №2:
### Common task:
*On the screen display the menu links with the names (for example, "About the Company", "Services", "Price", "Contacts"). When you click on a link, the background color around the active link changes and remains changed. All code on one page. Do not use javascript. Use GET requests.*
### Variant 9:
*Write a script that counts the sum of digits of the number entered by the user. Also make a check on the correctness of the data entered by the user. The number to receive through the web form.*

## Lab №3:
### Variant 8:
*Write a function that forms the calendar of the school year with the number of the week of the school for a particular course. The first week of the school year is considered the week of September 1st. The numbers of study weeks - from 1 to 4. The year for which the training week calendar should be formed, as well as the course number, to be received via the web form. Holidays and sessions display in bold and other colors. Save the result in a text html-file for later viewing in the browser.*

## Lab №4:
### Variant 8:
*In a free text, all dates (in the format DD.MM.YYYY and MM / DD / YYYY, the day and the month can be single-valued and the year two-digit) in red, while increasing the year by one. The format MM / DD / YYYY lead to DD.MM.YYYY also using a regular expression. Text receive from file.*

## Lab №5:
### Common task:
*This task assumes mastering the general structure of MySQL tables, field types, attributes, indexes (keys), familiarity with basic SQL queries - therefore it is recommended to use the PhpMyAdmin application.*
* *Create a database with UTF8 encoding (utf8_general_ci). Create 2 tables (subject to tables at the discretion of the student) with fields including a field with an index (key) with auto-increment, 1-2 fields with a unique index (key), 1-2 fields in one of the tables that can be associated with another table. Suppose one table contains information about authors' registration and contains, for example, the id, name, password, ip_registration, data_registration fields, and the other, for example, contains thematic articles with the id, author_id fields (meaning that tables), title, text, image, data_publications, hide, opinion, etc. Choose the correct and optimal data types and length for the corresponding fields, such as varchar, text, int, double, bigint, enum, boolean, data, timestamp, etc.*
* *Make a small initial fill / edit / highlight through phpMyAdmin. Examine the relevant SQL commands.*
* *To study import / export of a database file in SQL format.*
* *Create a PHP script to access the created database. Define constants for database access (localhost, name, password, database name). Connect to the database, handle the connection error with the appropriate message, set the UTF8 encoding, display the entire database and (or) part of the fields using sorting on the screen in a table. It is also recommended to display combined data from two tables (for example, the names of the authors and the corresponding headings of the articles they post).*
### Variant 8:
*Create a database containing information about students and their grades in various subjects (at least five). Write a script that forms a list of students with their average points, as well as the minimum and maximum points with the list of subjects for which such a point was obtained. Provide a point adjustment for the student. Display the full list and get it.*

## Lab №6:
### Variant 8:
*Write a script to determine when this user visited the site (full list and number of visits). In this case, the user is not registered and not authorized on the site.*

## Lab №7:
### Variant 3:
*Write a script that sends the letter received to the mailing list stored in the database.*

## Lab №8:
### Variant 8:
*Count the number of times a picture has been shown or a pixel is placed that captures the display of a particular picture with a specific identifier.*
