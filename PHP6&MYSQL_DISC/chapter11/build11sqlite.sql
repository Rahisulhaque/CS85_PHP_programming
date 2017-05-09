DROP TABLE agent;
DROP TABLE agent_specialty;
DROP TABLE badspy;
DROP TABLE operation;
DROP TABLE specialty;

CREATE TABLE agent (
  agentID INTEGER PRIMARY KEY,
  name varchar(50),
  operationID int
); 

INSERT INTO agent VALUES (null, 'Bond', 1);
INSERT INTO agent VALUES (null, 'Falcon', 1);
INSERT INTO agent VALUES (null, 'Cardinal', 2);
INSERT INTO agent VALUES (null, 'Blackford', 2);
INSERT INTO agent VALUES (null, 'Rahab', 3);
INSERT INTO agent VALUES (null, 'James Bland', 2);

CREATE TABLE operation (
  operationID INTEGER PRIMARY KEY,
  name varchar(50),
  description varchar(50),
  location varchar(50)
);

INSERT INTO operation VALUES (null, 'Dancing Elephant', 'Infiltrate suspicious zoo', 'London');
INSERT INTO operation VALUES (null, 'Enduring Angst', 'Make bad guys feel really guilty', 'Lower Volta');
INSERT INTO operation VALUES (null, 'Furious Dandelion', 'Plant crabgrass in enemy lawns', 'East Java');

CREATE TABLE specialty (
  specialtyID INTEGER PRIMARY KEY,
  name varchar(50) 
);

INSERT INTO specialty VALUES (null, 'Electronics');
INSERT INTO specialty VALUES (null, 'Counterintelligence');
INSERT INTO specialty VALUES (null, 'Sabotage');
INSERT INTO specialty VALUES (null, 'Doily Design');
INSERT INTO specialty VALUES (null, 'Explosives');
INSERT INTO specialty VALUES (null, 'Flower Arranging');

CREATE TABLE agent_specialty (
  agent_specialtyID INTEGER PRIMARY KEY,
  agentID int,
  specialtyID int
);

INSERT INTO agent_specialty VALUES (null, 1, 2);
INSERT INTO agent_specialty VALUES (null, 1, 3);
INSERT INTO agent_specialty VALUES (null, 2, 1);
INSERT INTO agent_specialty VALUES (null, 2, 6);
INSERT INTO agent_specialty VALUES (null, 3, 2);
INSERT INTO agent_specialty VALUES (null, 4, 4);
INSERT INTO agent_specialty VALUES (null, 4, 5);

CREATE TABLE badspy (
  agentID INTEGER PRIMARY KEY,
  name varchar(30),
  specialty varchar(40),
  assignment varchar(40),
  description varchar(40),
  location varchar(20)
);

INSERT INTO badspy VALUES (null, 'Rahab', 'Electronics, Counterintelligence', 'Raging Dandelion', 'Plant Crabgrass', 'Sudan');
INSERT INTO badspy VALUES (null, 'Gold Elbow', 'Sabatoge, Doily design', 'Dancing Elephant', 'Infiltrate suspicious zoo', 'London');
INSERT INTO badspy VALUES (null, 'Falcon', 'Counterintelligence', 'Dancing Elephant', 'Infiltrate suspicious circus', 'London');
INSERT INTO badspy VALUES (null, 'Cardinal', 'Sabatoge', 'Enduring Angst', 'Make bad guys feel really guilty', 'Lower Volta');
INSERT INTO badspy VALUES (null, 'Blackford', 'Explosives, Flower arranging', 'Enduring Angst', 'Make bad guys feel really guilty', 'Lower Votla');

