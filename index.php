<?php

require_once __DIR__ . '/functions.php';

$title = '';
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // フォームに入力されたデータを受け取る
    $title = filter_input(INPUT_POST, 'title');
    // バリデーション
    $errors = insertValidate($title);
    // エラーチェック
    if (empty($errors)) {
        // タスク登録処理の実行
        insertTask($title);
    }
}
// 未完了タスクの取得
$notyet_tasks = findTaskByStatus(TASK_STATUS_NOTYET);
// 完了タスクの取
$done_tasks = findTaskByStatus(TASK_STATUS_DONE);
?>
<!DOCTYPE html>
<html lang="ja">
<?php include_once __DIR__ . '/_head.html' ?>

<body>
    <div class="wrapper">
        <div class="new-task">
            <h1>My Tasks</h1>
            <?php if ($errors) echo createErrMsg($errors) ?>
            <form action="" method="post">
                <input type="text" name="title" placeholder="タスクを入力してください">
                <input type="submit" value="登録" class="btn submit-btn">
            </form>
        </div>
        <div class="notyet-task">
            <h2>未完了タスク</h2>
            <ul>
                <?php foreach ($notyet_tasks as $task) : ?>
                    <li>
                        <a href="done.php?id=<?= h($task['id']) ?>" class="btn done-btn">完了</a>
                        <a href="edit.php?id=<?= h($task['id']) ?>" class="btn edit-btn">編集</a>
                        <a href="delete.php?id=<?= h($task['id']) ?>" class="btn delete-btn">削除</a>
                        <?= h($task['title']) ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="done-task">
            <h2>完了タスク</h2>
            <?php foreach ($done_tasks as $task) : ?>
                <ul>
                    <li><?= $task['title'] ?></li>
                </ul>
            <?php endforeach; ?>
        </div>
    </div>
</body>

</html>