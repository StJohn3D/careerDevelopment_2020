<?php
require_once('todo_db_connect.php');
require_once('Todo.php');

class TodoListDTO {
  public $id = -1;
  public $title = "";
  public $description = "";

  public function __construct($id, $title, $description) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
  }
}

class TodoList {
  public static function getByPersonId($userId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
        t.todo_list_id,
        t.todo_list_title,
        t.todo_list_description
      FROM todo_list t
      WHERE t.todo_list_person_id = $userId
    ";
  
    $result = $todoDb->query($query);

    $todoListData = array();
  
    if ($result->num_rows > 0) {
      while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
        $todoListData[] = new TodoListDTO(
          $row['todo_list_id'],
          $row['todo_list_title'],
          $row['todo_list_description']
        );
      }
    }
  
    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $todoListData;
  }

  public static function getById($id) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
        t.todo_list_title,
        t.todo_list_description
      FROM todo_list t
      WHERE t.todo_list_id = $id
    ";
  
    $todoListData = null;
  
    $result = $todoDb->query($query);
  
    if (!!$result) { //TODO mirror this pattern to all of the other requests to protect against null/undefined result errors
      if ($result->num_rows === 1) {
        $row = $result->fetch_array(MYSQLI_ASSOC);
        $todoListData = new TodoListDTO(
          $id,
          $row['todo_list_title'],
          $row['todo_list_description']
        );
      }
    
      /* free result set */
      $result->free();
    }
  
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

  public static function delete($id) {
    $todoDb = todo_db_connect();

    $query = "DELETE FROM todo_list WHERE todo_list_id = $id";
  
    $success = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $success;
  }

  public static function edit($id, $title, $description) {
    $todoDb = todo_db_connect();

    $query = "UPDATE todo_list
      SET
        todo_list_title = \"$title\",
        todo_list_description = \"$description\"
      WHERE todo_list_id = $id;
    ";
  
    $success = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $success;
  }
}

?>