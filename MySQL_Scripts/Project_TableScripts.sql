
DROP DATABASE IF EXISTS studentsDB;
CREATE DATABASE studentsDB;
USE studentsDB;

DROP TABLE IF EXISTS usersTable;
DROP TABLE IF EXISTS projectsTable;
DROP TABLE IF EXISTS tasksTable;

CREATE TABLE usersTable (
	userID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    userFirstName		CHAR(20)		NOT NULL,
    userMiddleName		CHAR(20)		,
    userLastName		CHAR(20)		NOT NULL,
    userPW				VARCHAR(32)		NOT NULL,
    userEmail			VARCHAR(32)		,
    userName			VARCHAR(32)		NOT NULL UNIQUE
);

CREATE TABLE projectsTable (
	projectID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    projectName				CHAR(20)		NOT NULL,
    projectCreatorID		CHAR(20)		, #UsersTable->userid
    projectCreationDate		DATE			NOT NULL,
    projectDeletionDate		DATE			,
    projectLatestUpdate		DATE			,
    projectCompleted		bool			NOT NULL,
    projectCompletionDate	DATE			,
    projectDueDate			DATE			
);

CREATE TABLE tasksTable (
	taskID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    taskName				CHAR(20)		NOT NULL,
    taskCreator				CHAR(20)		,
    taskCreationDate		DATE			NOT NULL,
    #taskCompleted			BOOL			NOT NULL,
    taskCompletionDate		DATE			,
    parentProjectID			VARCHAR(20)		NOT NULL
);

ALTER TABLE tasksTable ADD COLUMN taskCompleted BOOL DEFAULT FALSE;