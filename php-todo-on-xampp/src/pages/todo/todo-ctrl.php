<?php
  parse_str($_SERVER['QUERY_STRING'], $queryParams);

  $todoListId = $queryParams['id'];
  $activeEditing = null;
  if (isset($queryParams['edit'])) {
    $activeEditing = $queryParams['edit'];
  }
  $editButtonsEnabled = $activeEditing === null;

  if (!$todoListId) {
    header('Location: '.$uri.'/todoapp/create.php/');
    exit;
  }

  require_once('./db/TodoList.php');
  
  $todoListData = TodoList::getById($todoListId);
  
  if ($todoListData === null) {
    header('Location: '.$uri.'/todoapp/404.php/');
    exit;
  }
  
  require_once('./db/Todo.php');
  $countsData = Todo::getCountsByListId($todoListId);
  $todosData = Todo::getByListId($todoListId);

  $formSubmitAddress = "todo.php?" . $_SERVER['QUERY_STRING'];

  if (isset($_POST['delete-confirm'])) {
    TodoList::delete($todoListId);
    header('Location: '.$uri.'/todoapp/index.php/');
    exit;
  }
?>