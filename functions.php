<?php

require_once __DIR__ . '/config.php';

function connectDb()
{
    try {
        return new PDO(
            DSN,
            USER,
            PASSWORD,
            [PDO::ATTR_ERRMODE =>
            PDO::ERRMODE_EXCEPTION]
        );
    } catch (PDOException $e) {
        echo $e->getMessage();
        exit;
    }
}
function h($str)
{
    return htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

function findTaskByStatus($status)
{
    $dbh = connectDb();
    
    $sql = <<<EOM
    SELECT
        *
    FROM
        tasks
    WHERE
        status = :status;
    EOM;

    // プリペアードステートメント の準備
    $stmt = $dbh->prepare($sql);

    // バインドするパラメーターの準備
    $status = 'notyet';

    // パラメーターのバインド
    $stmt->bindParam(':status', $status, PDO::PARAM_STR);

    // プリペアドステートメントの実行
    $stmt->execute();

    // 結果の取得
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}