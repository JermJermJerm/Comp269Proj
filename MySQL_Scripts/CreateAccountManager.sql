/*
	AccountManager is a user that only has permissions on the users table
    This is so that it can only take user input and look for users with matching credentials.
    This determines whether or not 
*/

DROP USER IF EXISTS 'AccountManager'@'localhost';

CREATE USER 'AccountManager'@'localhost'; # IDENTIFIED BY PASSWORD('one')
SET PASSWORD for 'AccountManager'@'localhost' = PASSWORD('one');

SELECT * FROM mysql.user;

GRANT SELECT, INSERT, DROP ON studentsdb.usersTable TO 'AccountManager'@'localhost';


GRANT CREATE USER ON *.* TO 'AccountManager'@'localhost'; 
#Users can only be granted CREATE USER permission on a global level, not per-db nor per-table