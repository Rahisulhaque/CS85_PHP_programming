######################################
# buildSpy.sql
# builds and populates all databases for spy examples
# uses mysql - should adapt easily to other rdbms
# by Andy Harris for PHP/MySQL for Abs. Beg
######################################

######################################
# conventions
######################################
# primary key = table name . ID
# primary key always first fields
# all primary keys autonumbered
# all field names camel-cased
# only link tables use underscore
# foreign keys indicated although mySQL does not always enforce
# every table used as foriegn reference has a name field
######################################

######################################
#housekeeping
######################################

use ph_6;
DROP TABLE IF EXISTS badSpy;
DROP TABLE IF EXISTS agent;
DROP TABLE IF EXISTS operation;
DROP TABLE IF EXISTS specialty;
DROP TABLE IF EXISTS agent_specialty;
DROP TABLE IF EXISTS spyFirst;

######################################
#create badspy table
######################################

CREATE TABLE badSpy (
  agentID int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  name varchar(30),
  specialty varchar(40),
  assignment varchar(40),
  description varchar(40),
  location varchar(20),
  age int
); 

INSERT INTO badSpy VALUES (
  null,'Rahab','Electronics, Counterintelligence',
  'Raging Dandelion','Plant Crabgrass','Sudan', 27
);

INSERT INTO badSpy VALUES(
  null, 'Gold Elbow','Sabatoge, Doily design',
  'Dancing Elephant','Infiltrate suspicious zoo','London', 47
);

INSERT INTO badSpy VALUES(
  null,'Falcon','Counterintelligence',
  'Dancing Elephant','Infiltrate suspicious circus','London', 33
);

INSERT INTO badSpy VALUES(
  null,'Cardinal','Sabatoge',
  'Enduring Angst','Make bad guys feel really guilty','Lower Volta', 29
);

INSERT INTO badSpy VALUES(
  null,'Blackford','Explosives, Flower arranging',
  'Enduring Angst','Make bad guys feel really guilty','Lower Votla', 52
);

DESCRIBE badSpy;
SELECT * FROM badSpy;

######################################
# build agent table
######################################

CREATE TABLE agent (
  agentID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) default NULL,
  operationID int(11) default NULL,
  birthday date,
  PRIMARY KEY  (agentID),
  FOREIGN KEY (operationID) REFERENCES operation (operationID)
);    

INSERT INTO agent VALUES(
  null, 'Bond', 1, '1961-08-30'
);

INSERT INTO agent VALUES(
  null, 'Falcon', 1, '1975-05-23'
);

INSERT INTO agent VALUES(
  null, 'Cardinal', 2, '1979-01-27'
);

INSERT INTO agent VALUES(
  null, 'Blackford', 2, '1956-10-16'
);

INSERT INTO agent VALUES(
  null, 'Rahab', 3, '1981-9-14'
);

######################################
# build agentAge view
######################################
DROP VIEW IF EXISTS agentAgeView;
CREATE VIEW agentAgeView AS
SELECT 
  name,
  birthday,
  operationID,
  CONCAT(
    YEAR(FROM_DAYS(DATEDIFF(NOW(), birthday))), ' years, ',
    MONTH(FROM_DAYS(DATEDIFF(NOW(), birthday))), ' months') as age
FROM agent;

######################################
# build operation table
######################################

CREATE TABLE operation (
  operationID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) default NULL,
  description varchar(50) default NULL,
  location varchar(50) default NULL,
  PRIMARY KEY  (`OperationID`)
);

INSERT INTO operation VALUES(
  null, 'Dancing Elephant', 
  'Infiltrate suspicious zoo', 'London'
);

INSERT INTO operation VALUES(
  null, 'Enduring Angst', 
  'Make bad guys feel really guilty','Lower Volta'
);

INSERT INTO operation VALUES(
 null, 'Furious Dandelion', 
 'Plant crabgrass in enemy lawns','East Java'
);

DESCRIBE operation;
SELECT * FROM operation;

######################################
# build agent operation view
######################################

DROP VIEW IF EXISTS agentOpView;
CREATE VIEW agentOpView AS
SELECT
  agent.name AS 'agent',
  CONCAT(
    YEAR(FROM_DAYS(DATEDIFF(NOW(), birthday))), ' years, ',
    MONTH(FROM_DAYS(DATEDIFF(NOW(), birthday))), ' months')    as age,
  operation.name AS 'operation',
  operation.description AS 'task',
  operation.location AS 'location'
FROM
  agent, operation
WHERE
  agent.operationID = operation.operationID;

######################################
# build specialty table
######################################

CREATE TABLE specialty (
  specialtyID int(11) NOT NULL AUTO_INCREMENT,
  name varchar(50) default NULL,
  PRIMARY KEY  (SpecialtyID)
);   

INSERT INTO specialty VALUES(
  null, 'Electronics'
);

INSERT INTO specialty VALUES(
  null, 'Counterintelligence'
);

INSERT INTO specialty VALUES(
  null, 'Sabatoge'
);

INSERT INTO specialty VALUES(
  null, 'Doily Design'
);

INSERT INTO specialty VALUES(
  null, 'Explosives'
);

INSERT INTO specialty VALUES(
  null, 'Flower Arranging'
);

DESCRIBE specialty;
SELECT * FROM specialty;

######################################
# build agent_specialty table
######################################

CREATE TABLE agent_specialty (
  agent_specialtyID int(11) NOT NULL AUTO_INCREMENT,
  agentID int(11) default NULL,
  specialtyID int(11) default NULL,
  PRIMARY KEY (agent_specialtyID),
  FOREIGN KEY (agentID) REFERENCES agent (agentID),
  FOREIGN KEY (specialtyID) REFERENCES specialty (specialtyID)
);

INSERT INTO agent_specialty VALUES(
  null,1,2
);

INSERT INTO agent_specialty VALUES(
  null,1,3
);

INSERT INTO agent_specialty VALUES(
  null,2,1
);

INSERT INTO agent_specialty VALUES(
  null,2,6
);

INSERT INTO agent_specialty VALUES(
  null,3,2
);

INSERT INTO agent_specialty VALUES(
  null,4,4
);

INSERT INTO agent_specialty VALUES(
  null,4,5
);

DESCRIBE agent_specialty;

######################################
# build agentSpecialty view
######################################
DROP VIEW IF EXISTS agentSpecialtyView;

CREATE VIEW agentSpecialtyView as
SELECT 
  agent.name as 'agent',
  specialty.name as 'specialty'
FROM 
  agent, specialty, agent_specialty
WHERE agent.agentID = agent_specialty.agentID
  AND specialty.specialtyID = agent_specialty.specialtyID;


######################################
# build spyFirst table
######################################

CREATE TABLE spyFirst (
  spyFirstID INT NOT NULL AUTO_INCREMENT,
  codeName VARCHAR(30),
  specialtyA VARCHAR(30),
  specialtyB VARCHAR(30),
  specialtyC VARCHAR(30),
  assignment VARCHAR(40),
  description VARCHAR(40),
  location VARCHAR(20),
  PRIMARY KEY (spyFirstID)
);

DESCRIBE spyFirst;


