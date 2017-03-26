INSERT INTO usersTable VALUES (DEFAULT,'first', 'middle', 'last', 'pw', 'email@addr.es', 'username');

SELECT * FROM usersTable;
DELETE FROM usersTable WHERE userID = '1';


#See all user accounts
SELECT * FROM mysql.user;
SELECT Password('one');
SELECT Password FROM mysql.user WHERE user = 'AccountManager'