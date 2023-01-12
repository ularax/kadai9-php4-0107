<?php

// 0. SESSION開始！！
session_start();

// 1. ログインチェク処理 loginCheck()
require_once('funcs.php');
login_check();

//PHP:コード記述/修正の流れ
//1. update.phpの処理をマルっとコピー。
//2. POSTデータ取得はidだけ残して他は消し、POSTをGETに変える
//3. データ登録SQL作成のSQL文はprepareの中身をすべて消去し、''の中にDELETE文を書く
//4. データ登録SQL作成のバインド変数（$stmtの部分）はid以外全て消す

//1. POSTデータ取得
$id = $_GET['id'];

//2. DB接続します
//*** function化する！  *****************
//funcs.phpの関数function db_conn()を呼び出す
require_once('funcs.php');
$pdo = db_conn();

//３．データ登録SQL作成
// 1. SQL文を用意
$stmt = $pdo->prepare('DELETE FROM gs_bm_table WHERE id = :id');

//  2. バインド変数を用意
$stmt->bindValue(':id', $id, PDO::PARAM_INT);

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
