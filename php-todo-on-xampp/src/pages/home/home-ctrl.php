<?php
  require_once('./db/TodoList.php');

  $todoListData = TodoList::getByPersonId($userData->id);

?>