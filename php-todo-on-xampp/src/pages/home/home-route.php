<?php
  require_once('home-ctrl.php');
  require_once('./components/Page.php');
  require_once('./components/AuthedHeader.php');

  $headerContent = AuthedHeader::render($userData);

  $listContent = "";
  foreach ($todoListData as $todoData) {
    $countsData = Todo::getCountsByListId($todoData->id);
    $listContent .= <<<XML
      <article className="todo_card" style="border: 1px solid; padding: 16px;">
        <header>
          <h1>$todoData->title<h1>
          <aside>$countsData->numCompleted/$countsData->numTodos<aside>
        </header>
        <p>$todoData->description</p>
        <a href="/todoapp/edit.php?id=$todoData->id">Edit</a>
      </article>
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
    <a href="/todoapp/create.php">Create new ToDo list</a>
    <hr/>
    $listContent
  XML;

  new Page($userTitle, $headerContent, $bodyContent);
?>