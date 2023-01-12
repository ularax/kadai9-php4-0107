<?php

// 0. SESSION開始！！
session_start();

// 1. ログインチェク処理 loginCheck()
require_once('funcs.php');
login_check();

//PHP:コード記述/修正の流れ
//1. insert.phpの処理をマルっとコピー。
//2. $id = $_POST["id"]を追加
//3. SQL修正
//   "UPDATE テーブル名 SET 変更したいカラムを並べる WHERE 条件"
//   bindValueにも「id」の項目を追加
//4. header関数"Location"を「select.php」に変更

//1. POSTデータ取得
$title = $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];
$id = $_POST['id'];

//2. DB接続します
//*** function化する！  *****************
//funcs.phpの関数function db_conn()を呼び出す
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
//SQL文を用意
//INSERT INTOを消してUPDATE以下を書き加える
$stmt = $pdo->prepare(
    'UPDATE
    gs_bm_table SET
    id = :id,
    title = :title,
    url = :url,
    comment = :comment,
    date = sysdate()

    WHERE id = :id;'
);

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意

//  3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
//SQLエラー関数：sql_error($stmt)*** function化する！***
    sql_error($stmt);
    } else {
//リダイレクト関数: redirect($file_name)*** function化する！***
//select.phpへリダイレクト
    redirect('select.php');
}
?>
