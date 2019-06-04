//log into mysql
$ mysql -u root -p
Enter password:

//Create db
mysql> CREATE DATABASE [db-name];

//list users and host
mysql> SELECT user, host FROM mysql.user;

//create user and grant privialges to them for created db
mysql> GRANT ALL PRIVILEGES ON [dbname].* TO "[username]"@"[hostname]" IDENTIFIED BY "password";
mysql> FLUSH PRIVILEGES;

//exit out of mysql
mysql> exit

//INSERT an .sql file into exsisting db
// 1. create database
// 2. exit mysql

$ mysql -u [username] -p [dbname] < data-dump.sql
