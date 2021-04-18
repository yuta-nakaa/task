<?php

require_once __DIR__ . '/functions.php';

$id = filter_input(INPUT_GET, 'id');

// タスク完了処理
updateStatusToDone($id);


// index.phpにリダイレクト
header('Location: index.php');
exit;