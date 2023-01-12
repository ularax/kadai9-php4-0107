<?php
// 0. SESSION開始！！
session_start();

// 1. ログインチェク処理 loginCheck()
require_once('funcs.php');
login_check();


//クロスサイトスクリプティング対策
//34行目のwhile文のなかの$result[]をh()で囲む
// function h($str)
// {
//     return htmlspecialchars($str, ENT_QUOTES);
// }

//1.  DB接続します
// try {
//   //Password:MAMP='root',XAMPP=''
//   $pdo = new PDO('mysql:dbname=gs_bm;charset=utf8;host=localhost','root','');
// } catch (PDOException $e) {
//   exit('DBConnectError'.$e->getMessage());
// }

//２．データ取得SQL作成
$pdo = db_conn();
$stmt = $pdo->prepare("SELECT * FROM gs_bm_table;");
$status = $stmt->execute();

//３．データ表示
$view="";
if ($status==false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  // exit("ErrorQuery:".$error[2]);
  exit('SQLError:' . print_r($error, true));
}else{
  //elseのなかはSQL実行が成功した場合
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php

  //テーブル表示
  $view .= '<table border="1" width=100% ><tbody>';
  $view .= '<tr><th class="header">番号</th><th class="header">書籍名</th><th class="header">書籍URL</th><th class="header">コメント</th><th class="header">登録日時</th></tr>';

  //テーブル中身（while文でデータを最後まで抽出する）
  while( $result = $stmt->fetch(PDO::FETCH_ASSOC)){
    $view .= '<tr>';

      $view .= '<th class="id">';
        $view .= '<a href="detail.php?id=' . h($result['id']) . '">';
        $view .= h($result['id']);
        $view .= '</a>';
      $view .= '</th>';

      $view .= '<th>';
        $view .= h($result['title']);
      $view .= '</th>';

      $view .= '<th>';
        $view .= h($result['url']);
      $view .= '</th>';

      $view .= '<th>';
        $view .= h($result['comment']);
      $view .= '</th>';

      $view .= '<th class="date">';
        $view .= h($result['date']);
      $view .= '</th>';

      $view .= '<th class="delete">';
        $view .= '<a href="delete.php?id=' . $result['id'] . '">';
        $view .= '[削除]';
        $view .= '</a>';
      $view .= '</th>';

    $view .= '<tr>';
    $pdo = null;

  }
  $view .= '</table></tbody>';
}
?>


<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>フリーアンケート表示</title>
<link rel="stylesheet" href="css/range.css">
<link href="css/bootstrap.min.css" rel="stylesheet">
<style>div{padding:10px; font-size:16px;}</style>
<style>
  .navbar {
    display: flex;
    justify-content: center;
  }
  .header {
    text-align: center;
  }
  .id {
    width: 40px;
    text-align: center;
  }
  .date {
    width: 170px;
  }
  .delete {
    width: 60px;
    text-align: center;
  }
</style>
</head>
<body id="main">
<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
      <a class="navbar-brand" href="index.php">書籍情報を登録する</a>
      </div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<div class="jumbotron">
    <div class="container text-center"><?= $view ?></div>
</div>

<!-- Main[End] -->

</body>
</html>

