CREATE DATABASE todo_app;

USE todo_app;

CREATE TABLE person
(
  person_id INT PRIMARY KEY AUTO_INCREMENT,
  person_first_name VARCHAR(256),
  person_last_name VARCHAR(256),
  person_username VARCHAR(55) NOT NULL,
  person_password VARCHAR(256) NOT NULL
);

INSERT INTO
person(
  person_id,
  person_first_name,
  person_last_name,
  person_username,
  person_password
)
VALUES(
  1,
  'John',
  'Smith',
  'defaultUser',
  '1234'
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

INSERT INTO
email_address(
  email_address_id,
  email_address,
  email_address_person_id
)
VALUES(
  1,
  'jsmith@mail.com',
  1
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

INSERT INTO
todo_list(
  todo_list_id,
  todo_list_title,
  todo_list_description,
  todo_list_person_id
)
VALUES(
  1,
  'First Todo List',
  'A starter todo list example.',
  1
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

INSERT INTO
todo(
  todo_id,
  todo_title,
  todo_description,
  todo_due_date,
  todo_completed,
  todo_todo_list_id
)
VALUES(
  1,
  'Buy eggs',
  NULL,
  NULL,
  FALSE,
  1
);
