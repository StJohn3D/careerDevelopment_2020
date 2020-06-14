<?php
require_once('todo_db_connect.php');

class TodoListDTO {
  public $id = -1;
  public $title = "";
  public $description = "";
  public $numTodos = 0;
  public $numCompleted = 0;

  public function __construct($id, $title, $description, $numTodos, $numCompleted) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->numTodos = $numTodos;
    $this->numCompleted = $numCompleted;
  }
}

class TodoList {
  public static function getByPersonId($userId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
        t.todo_list_id,
        t.todo_list_title,
        t.todo_list_description,
        COUNT(ALL todo.todo_id) 'num_todos',
        SUM(todo.todo_completed) 'num_completed'
      FROM todo_list t
      INNER JOIN
      todo
      ON todo.todo_todo_list_id = t.todo_list_id
      WHERE t.todo_list_person_id = $userId
    ";
  
    $result = $todoDb->query($query);

    $todoListData = array();
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $todoListData[] = new TodoListDTO(
          $row['todo_list_id'],
          $row['todo_list_title'],
          $row['todo_list_description'],
          $row['num_todos'],
          $row['num_completed']
        );
      }
    }
  
    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $todoListData;
  }

  public static function add($title, $description, $userId) {
    $todoDb = todo_db_connect();

    $descriptionOrNull = $description ? "\"$description\"" : "NULL";
  
    $query = "INSERT INTO
    todo_list(
      todo_list_title,
      todo_list_description,
      todo_list_person_id
    )
    VALUES(
      \"$title\",
      $descriptionOrNull,
      $userId
    )";
  
    $id = -1; //Default return -1 on failure
  
    if($todoDb->query($query) === TRUE) {
      $id = $todoDb->insert_id;
    }
  
    /* close connection */
    $todoDb->close();
  
    return $id;
  }
}

?>