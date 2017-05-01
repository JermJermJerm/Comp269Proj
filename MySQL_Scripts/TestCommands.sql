INSERT INTO usersTable VALUES (DEFAULT,'first', 'middle', 'last', 'pw', 'email@addr.es', 'username');

SELECT * FROM usersTable;
#DELETE FROM usersTable WHERE userID != '';


SELECT * FROM mysql.user;

INSERT INTO userstable VALUES ('DEFAULT', 'first', 'middle', 'last', 'pw', 'e', 'usern');

UPDATE userstable SET userPW = 'passing' WHERE username='U';

SELECT userPW FROM userstable WHERE userName='U';

SELECT * FROM projectstable;
DELETE FROM projectstable WHERE projectID='3';

SELECT * FROM taskstable;
INSERT INTO taskstable (taskID, taskName, taskCreator, taskCreationDate, parentProjectID) 
	VALUES (DEFAULT, 'Task1', '2', NOW(), 4 );