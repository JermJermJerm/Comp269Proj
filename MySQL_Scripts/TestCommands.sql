INSERT INTO usersTable VALUES (DEFAULT,'first', 'middle', 'last', 'pw', 'email@addr.es', 'username');

SELECT * FROM usersTable;
DELETE FROM usersTable WHERE userID != '';

#See all user accounts
SELECT * FROM mysql.user;
SELECT Password('one');
SELECT Password FROM mysql.user WHERE user = 'AccountManager';

INSERT INTO userstable VALUES ('DEFAULT', 'first', 'middle', 'last', 'pw', 'e', 'usern');

UPDATE userstable SET useremail='aaaaa' WHERE userID=3;

#DROP USER IF EXISTS ' '@'localhost';

SELECT userPW FROM userstable WHERE userName='U';