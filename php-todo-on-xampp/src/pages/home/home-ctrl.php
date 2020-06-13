<?php
  if(isset($_POST['logout'])) {
    User::logout();
  }

  require_once('./db/TodoList.php');

  $todoListData = TodoList::getByPersonId($userData->id);

  function echoHeaderTitle($userData) {
    if ($userData->firstName !== null) {
      echo $userData->firstName;
      if ($userData->lastName !== null) {
        echo " $userData->lastName";
      }
      echo "'s ";
    } else {
      echo "My ";
    }
    echo "ToDo lists";
  }

?>