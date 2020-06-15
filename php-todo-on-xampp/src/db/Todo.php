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
}

?>