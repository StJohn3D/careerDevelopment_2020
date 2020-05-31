<?php
require_once('todo_db_connect.php');

class LoginAttempt {
  public $ipAddress = "";
  public $failedCount = 0;
  public $timeStamp = null;
  
  public function __construct($_ipAddress) {
    $this->ipAddress = $_ipAddress;
    $this->getByIpAddress();
  }

  public function set($success) {
    $todoDb = todo_db_connect();

    $failedCount = $success ? 0 : $this->failedCount + 1;
  
    $query = "REPLACE INTO login_attempt(
      ip_address,
      failed_count
    )
    VALUES(
      \"$this->ipAddress\",
      $failedCount
    )
    ";

    $result = $todoDb->query($query);
  
    /* close connection */
    $todoDb->close();
  
    return $result;
  }

  private function getByIpAddress() {
    $todoDb = todo_db_connect();
  
    $query = "SELECT
      l.failed_count,
      l.time_stamp
      FROM login_attempt l
      WHERE l.ip_address = \"$this->ipAddress\""
    ;
  
    $result = $todoDb->query($query);
    
    if ($result->num_rows === 1) {
      $row = $result->fetch_array(MYSQLI_ASSOC);
      $this->failedCount = $row['failed_count'];
      $this->timeStamp = $row['time_stamp'];
    }

    /* free result set */
    $result->free();
  
    /* close connection */
    $todoDb->close();
  }
}

?>