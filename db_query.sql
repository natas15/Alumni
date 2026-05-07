CREATE DATABASE alumni;
USE alumni;

CREATE USER 'alumni_user'@'localhost' IDENTIFIED BY 'securepass'; 
GRANT ALL PRIVILEGES ON alumni.* TO 'alumni_user'@'localhost'; 
FLUSH PRIVILEGES;