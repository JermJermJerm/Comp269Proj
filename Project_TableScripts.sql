DROP TABLE IF EXISTS usersTable;
DROP TABLE IF EXISTS teamsTable;
DROP TABLE IF EXISTS membershipsTable;
DROP TABLE IF EXISTS projectsTable;
DROP TABLE IF EXISTS tasksTable;
DROP TABLE IF EXISTS stepsTable;

CREATE TABLE usersTable (
	userID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userFirstName		CHAR(20)		NOT NULL,
    userMiddleName		CHAR(20)		,
    userLastName		CHAR(20)		NOT NULL,
    userPW				VARCHAR(32)		NOT NULL,
    userEmail			VARCHAR(32)		NOT NULL,
    userName			VARCHAR(32)		NOT NULL
);


CREATE TABLE teamsTable (
	teamID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    teamName			CHAR(20)		NOT NULL,
    teamCreationDate	DATE			NOT NULL,
    teamDeletionDate	DATE			
);

/*
	MembershipsTable, literally just teamid | userid to match users and teams, instead of per-team tables
    purpose: see which users belong to a team, or which teams a particular user belongs to
*/
CREATE TABLE membershipsTable (
	teamID		INT(4) PRIMARY KEY NOT NULL,
    userID		INT(4) NOT NULL
);

CREATE TABLE projectsTable (
	projectID				INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    projectName				CHAR(20)		NOT NULL,
    projectCreatorID		CHAR(20)		, #UsersTable->userid
    projectCreationDate		DATE			NOT NULL,
    projectDeletionDate		DATE			,
    projectLatestUpdate		DATE			NOT NULL,
    projectCompletionDate	DATE			
);

CREATE TABLE tasksTable (
	taskID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    taskName				CHAR(20)		NOT NULL,
    taskCreator				CHAR(20)		,
    taskCreationDate		DATE			NOT NULL,
    taskDeletionDate		DATE			,
    taskLatestUpdate		DATE			NOT NULL,
    taskCompletionDate		DATE			,
    parentProjectID			VARCHAR(20)		NOT NULL
);

CREATE TABLE stepsTable (
	stepID					INT				PRIMARY KEY NOT NULL AUTO_INCREMENT,
    stepName				CHAR(20)		NOT NULL,
    stepCreator				CHAR(20)		,
    stepCreationDate		DATE			NOT NULL,
    stepDeletionDate		DATE			,
    stepLatestUpdate		DATE			NOT NULL,
    stepCompletionDate		DATE			,
    parentTaskID			VARCHAR(20)		NOT NULL
);