<?php

/**
 * 1. index.phpのフォームの部分がおかしいので、ここを書き換えて、
 * insert.phpにPOSTでデータが飛ぶようにしてください。
 * 2. insert.phpで値を受け取ってください。
 * 3. 受け取ったデータをバインド変数に与えてください。
 * 4. index.phpフォームに書き込み、送信を行ってみて、実際にPhpMyAdminを確認してみてください！
 */

//1. POSTデータ取得
$title = $_POST['title'];
$url = $_POST['url'];
$comment = $_POST['comment'];


//2. DB接続します
//*** function化する！  *****************
//funcs.phpの関数function db_conn()を呼び出す
require_once('funcs.php');
$pdo = db_conn();


//３．データ登録SQL作成
// 1. SQL文を用意
$stmt = $pdo->prepare("INSERT INTO gs_bm_table(id, title, url, comment, date)
                      VALUES(NULL, :title, :url, :comment, sysdate() )");

//  2. バインド変数を用意
// Integer 数値の場合 PDO::PARAM_INT
// String文字列の場合 PDO::PARAM_STR

$stmt->bindValue(':title', $title, PDO::PARAM_STR);
$stmt->bindValue(':url', $url, PDO::PARAM_STR);
$stmt->bindValue(':comment', $comment, PDO::PARAM_STR);

//3. 実行
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
  //SQLエラー関数：sql_error($stmt)*** function化する！***
      sql_error($stmt);
      } else {
  //リダイレクト関数: redirect($file_name)*** function化する！***
  //index.phpへリダイレクト
      redirect('index.php');
  }
?>
