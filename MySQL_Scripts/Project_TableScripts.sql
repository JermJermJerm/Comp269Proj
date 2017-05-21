DROP DATABASE IF EXISTS doWhatNowDB;
CREATE DATABASE doWhatNowDB;
USE doWhatNowDB;

DROP TABLE IF EXISTS usersTable;
DROP TABLE IF EXISTS projectsTable;
DROP TABLE IF EXISTS tasksTable;
DROP TABLE IF EXISTS teamsTable;
DROP TABLE IF EXISTS teamMembershipsTable;

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
	taskID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    taskName				VARCHAR(64)		NOT NULL,
    taskCreator				CHAR(20)		NOT NULL,
    taskCreationDate		DATE			NOT NULL,
    #taskCompleted			BOOL			NOT NULL, this gets added right after so we can set the default of true / false
    taskCompletionDate		DATE			,
    parentProjectID			VARCHAR(20)		NOT NULL
);

CREATE TABLE teamsTable (
	teamID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    teamName				CHAR(20)		NOT NULL,
    teamCreator				CHAR(20)		NOT NULL,
    teamCreationDate		DATE			NOT NULL
);

CREATE TABLE teamMembershipsTable ( #Keep track of user<>team relationships
    userID					INT				,
    teamID					INT				
);

ALTER TABLE tasksTable ADD COLUMN taskCompleted BOOL DEFAULT FALSE;
