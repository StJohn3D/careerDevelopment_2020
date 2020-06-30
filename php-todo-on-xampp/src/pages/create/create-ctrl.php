<?php
  require_once('./db/TodoList.php');
  require_once('./lib/fieldHelpers.php');
  require_once('create-formValidators.php');
  
  $title = getFieldValue('title');
  $description = getFieldValue('description');
  
  $titleState = validateTitle($title);
  $descriptionState = validateDescription($description);
  
  $formIsValid =
    $titleState->valid &&
    $descriptionState->valid
  ;
  
  if (isset($_POST['submit']) && $formIsValid) {
    $todoListId = TodoList::add($title, $description, $userData->id);
  
    if ($todoListId > -1) {
      header('Location: '.$uri."/todoapp/todo.php?id=$todoListId");
      exit;
    }
  }

  if (!isset($_POST['submit'])) {
    $titleState->valid = true;
    $descriptionState->valid = true;
  }
  ?>