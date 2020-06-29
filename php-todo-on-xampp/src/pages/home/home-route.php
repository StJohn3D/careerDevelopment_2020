<?php
  require_once('home-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');

  $headerContent = AuthedHeader::render($userData);

  $listContent = "";
  foreach ($todoListData as $todoData) {
    $countsData = Todo::getCountsByListId($todoData->id);
    $listContent .= <<<XML
      <a class="todo_card" title="Click to view todo list: $todoData->title" href="/todoapp/edit.php?id=$todoData->id">
        <header class="todo_card__header">
          <h1>$todoData->title<h1>
          <aside>$countsData->numCompleted/$countsData->numTodos<aside>
        </header>
        <span class="todo_card__description">$todoData->description</span>
      </a>
    XML;
  }

  $userTitle = "";
  if ($userData->firstName !== null) {
    $userTitle .= $userData->firstName;
    if ($userData->lastName !== null) {
      $userTitle .= " $userData->lastName";
    }
    $userTitle .= "'s ";
  } else {
    $userTitle .= "My ";
  }
  $userTitle .= "ToDo lists";

  $bodyContent = <<<XML
    <a class="btn create-btn" title="Create new ToDo list" href="/todoapp/create.php">Create</a>
    $listContent
  XML;

  new Page($userTitle, $headerContent, $bodyContent, null, "home.css");
?>