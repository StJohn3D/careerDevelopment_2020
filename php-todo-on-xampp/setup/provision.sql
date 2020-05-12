CREATE DATABASE todo_app;

USE todo_app;

-- NOTE:
-- FOREIGN KEY, REFERENCES, ON DELETE CASCADE are all basically comments
-- So don't expect them to actually do anything.

CREATE TABLE person
(
  person_id INT PRIMARY KEY AUTO_INCREMENT,
  person_first_name VARCHAR(256),
  person_last_name VARCHAR(256),
  person_name VARCHAR(55) NOT NULL,
  person_password VARCHAR(256) NOT NULL
);

CREATE TABLE email_address
(
  email_address_id INT PRIMARY KEY AUTO_INCREMENT,
  email_address VARCHAR(256) NOT NULL,
  email_address_person_id INT NOT NULL,
  INDEX PERSON (email_address_person_id),
  FOREIGN KEY (email_address_person_id)
    REFERENCES person(person_id)
    ON DELETE CASCADE
);

CREATE TABLE todo_list
(
  todo_list_id INT PRIMARY KEY AUTO_INCREMENT,
  todo_list_title VARCHAR(55) NOT NULL,
  todo_list_description VARCHAR(256),
  todo_list_person_id INT NOT NULL,
  INDEX PERSON (todo_list_person_id),
  FOREIGN KEY (todo_list_person_id)
    REFERENCES person(person_id)
    ON DELETE CASCADE
);

CREATE TABLE todo
(
  todo_id INT PRIMARY KEY AUTO_INCREMENT,
  todo_title VARCHAR(55) NOT NULL,
  todo_description VARCHAR(256),
  todo_due_date DATETIME,
  todo_completed BOOLEAN,
  todo_todo_list_id INT NOT NULL,
  INDEX TODO_LIST (todo_todo_list_id),
  FOREIGN KEY (todo_todo_list_id)
    REFERENCES todo_list(todo_list_id)
    ON DELETE CASCADE
);
