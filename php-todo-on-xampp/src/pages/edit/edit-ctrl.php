<?php
  parse_str($_SERVER['QUERY_STRING'], $queryParams);

  $todoListId = $queryParams['id'];

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

  $formSubmitAddress = "edit.php?" . $_SERVER['QUERY_STRING'];

  if (isset($_POST['delete-confirm'])) {
    TodoList::delete($todoListId);
    header('Location: '.$uri.'/todoapp/index.php/');
    exit;
  }
?>