<?php
require_once('todo_db_connect.php');

class TodoCountsDTO {
  public $todoListId = -1;
  public $numTodos = 0;
  public $numCompleted = 0;

  public function __construct($todoListId, $numTodos, $numCompleted) {
    $this->todoListId = $todoListId;
    $this->numTodos = $numTodos;
    $this->numCompleted = $numCompleted;
  }
}

class TodoDTO {
  public $id = null;
  public $title = "";
  public $description = "";
  public $dueDate = null;
  public $completed = false;

  public function __construct($id = null, $title = "", $description = "", $dueDate = null, $completed = false) {
    $this->id = $id;
    $this->title = $title;
    $this->description = $description;
    $this->dueDate = $dueDate;
    $this->completed = $completed;
  }
}

class Todo {
  public static function getCountsByListId($todoListId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
          COUNT(ALL t.todo_id) num_todos,
          COALESCE(SUM(t.todo_completed), 0) num_completed
        FROM todo t
        WHERE t.todo_todo_list_id = $todoListId
    ";
  
    $result = $todoDb->query($query);

    $countsData = new TodoCountsDTO($todoListId, 0, 0);

    if ($result->num_rows === 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC);

      $countsData = new TodoCountsDTO($todoListId, $row['num_todos'], $row['num_completed']);
    }

    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();

    return $countsData;
  }

  public static function getByListId($todoListId) {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
          t.todo_id,
          t.todo_title,
          t.todo_description,
          t.todo_due_date,
          t.todo_completed
        FROM todo t
        WHERE t.todo_todo_list_id = $todoListId
    ";
  
    $result = $todoDb->query($query);

    $todosData = array();
  
    if (!!$result) {
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
          $todosData[] = new TodoDTO(
            $row['todo_id'],
            $row['todo_title'],
            $row['todo_description'],
            $row['todo_due_date'],
            $row['todo_completed']
          );
        }
      }

      /* free result set */
      $result->free();
    }
  
    /* close connection */
    $todoDb->close();

    return $todosData;
  }

  public static function setChecked($todoId, $checked) {
    $todoDb = todo_db_connect();

    $checkedVal = $checked ? "TRUE" : "FALSE";

    $query = "UPDATE todo
      SET
        todo_completed = $checkedVal
      WHERE todo_id = $todoId;
    ";
  
    $success = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $success;
  }

  public static function add($todoListId, $title, $description, $dueDate) {
    $todoDb = todo_db_connect();

    $descriptionOrNull = (isset($description) && $description !== '') ? "\"$description\"" : 'NULL';

    $dateValue = 'NULL';
    if (isset($dueDate) && $dueDate !== '') {
      $dateTime = new DateTime($dueDate);
      $formatted = $dateTime->format("Y-m-d H:i:s");
      $dateValue = "\"$formatted\"";
    }
  
    $query = "INSERT INTO
    todo(
      todo_title,
      todo_description,
      todo_due_date,
      todo_completed,
      todo_todo_list_id
    )
    VALUES(
      \"$title\",
      $descriptionOrNull,
      $dateValue,
      FALSE,
      $todoListId
    );";
  
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

    $query = "DELETE FROM todo WHERE todo_id = $id";
  
    $success = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $success;
  }

  public static function edit($todoId, $title, $description, $dueDate) {
    $todoDb = todo_db_connect();

    $descriptionOrNull = (isset($description) && $description !== '') ? "\"$description\"" : 'NULL';

    $dateValue = 'NULL';
    if (isset($dueDate) && $dueDate !== '') {
      $dateTime = new DateTime($dueDate);
      $formatted = $dateTime->format("Y-m-d H:i:s");
      $dateValue = "\"$formatted\"";
    }


    $query = "UPDATE todo
      SET
        todo_title = \"$title\",
        todo_description = $descriptionOrNull,
        todo_due_date = $dateValue
      WHERE todo_id = $todoId;
    ";
  
    $success = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $success;
  }
}

?>