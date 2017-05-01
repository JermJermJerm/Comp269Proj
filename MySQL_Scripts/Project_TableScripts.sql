/*
	TODO: Set userIDs, usernames, and email addresses to be unique
*/

DROP DATABASE IF EXISTS studentsDB;
CREATE DATABASE studentsDB;
USE studentsDB;

DROP TABLE IF EXISTS usersTable;
DROP TABLE IF EXISTS teamsTable;
DROP TABLE IF EXISTS membershipsTable;
DROP TABLE IF EXISTS projectsTable;
DROP TABLE IF EXISTS tasksTable;
DROP TABLE IF EXISTS stepsTable;

CREATE TABLE usersTable (
	userID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    userFirstName		CHAR(20)		NOT NULL,
    userMiddleName		CHAR(20)		,
    userLastName		CHAR(20)		NOT NULL,
    userPW				VARCHAR(32)		NOT NULL,
    userEmail			VARCHAR(32)		,
    userName			VARCHAR(32)		NOT NULL UNIQUE
);


/*
CREATE TABLE teamsTable (
	teamID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT UNIQUE,
    teamName			CHAR(20)		NOT NULL,
    teamCreationDate	DATE			NOT NULL,
    teamDeletionDate	DATE			
);

CREATE TABLE membershipsTable (
	teamID		INT(4) PRIMARY KEY NOT NULL,
    userID		INT(4) NOT NULL
);*/

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
    taskDeletionDate		DATE			,
    taskLatestUpdate		DATE			,
    taskCompletionDate		DATE			,
    parentProjectID			VARCHAR(20)		NOT NULL
);
/*
CREATE TABLE stepsTable (
	stepID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    stepName				CHAR(20)		NOT NULL,
    stepCreator				CHAR(20)		,
    stepCreationDate		DATE			NOT NULL,
    stepDeletionDate		DATE			,
    stepLatestUpdate		DATE			NOT NULL,
    stepCompletionDate		DATE			,
    parentTaskID			VARCHAR(20)		NOT NULL
);*/