<?php

// 0. SESSION開始！！
session_start();

// 1. ログインチェク処理 loginCheck()
require_once('funcs.php');
login_check();

/**
 * [ここでやりたいこと]
 * 1. クエリパラメータの確認 = GETで取得している内容を確認する
 * 2. select.phpのPHP<?php ?>の中身をコピー、貼り付け
 * 3. SQL部分にwhereを追加
 * 4. データ取得の箇所を修正。
 */

$id = $_GET['id'];

//1.  DB接続します
//*** function化する！  *****************
//funcs.phpの関数function db_conn()を呼び出す
require_once('funcs.php');
$pdo = db_conn();

//２．データ取得SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_bm_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT); //PARAM_INTなので注意
$status = $stmt->execute();

//４．データ登録処理後
if ($status === false) {
//SQLエラー関数：sql_error($stmt)*** function化する！***
    sql_error($stmt);
    } else {
    //データが取得できた場合の処理
    $result = $stmt->fetch();
  }
  ?>

<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
(入力項目は「登録/更新」はほぼ同じになるから)
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ登録</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
            display: flex;
            justify-content: space-around;
        }
        .legend {
            text-align: center;
            font-size: 35px;
            color: sienna;
        }
        .form {
            margin: 0 auto;
            padding: 10px;
            line-height: 3;
            width: 100%;
            display: flex;
            justify-content: center;
        }
        .form-title {
            color: sienna;
            font-size: 18px;
        }
        .form-content {
            width: 400px;
            height: 30px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
        .button {
            display: flex;
            justify-content: space-around;
        }
        .submit {
            color: sienna;
            width: 300px;
            height: 60px;
            margin: 30px 10px;
            padding: auto;
            background-color: powderblue;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            line-height: 60px;
            text-decoration-line: none;
        }
        .reset {
            color: sienna;
            width: 300px;
            height: 60px;
            margin: 30px 10px;
            padding: auto;
            background-color: powderblue;
            font-size: 1.8rem;
            font-weight: 600;
            text-align: center;
            line-height: 60px;
            text-decoration-line: none;
        }

    </style>
</head>

<body>

    <!-- Head[Start] -->
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header"><a class="navbar-brand" href="select.php">書籍情報の一覧をみる</a></div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

<form method="post" action="update.php">
<legend class="legend">ブックマークアプリ</legend>
<table class="form">
    <tr>
        <dl>
            <td>
                <dt class="form-title"><label for="title">書籍名：</label></dt>
            </td>
            <td>
                <dd><input type="text" name="title" id="title" class="form-content" value="<?= $result['title']?>"></dd>
            </td>
        </dl>
    </tr>
    <tr>
        <dl>
            <td>
            <dt class="form-title"><label for="url">書籍URL：</label></dt>
                </td>
            <td>
                <dd><input type="text" name="url" id="url" class="form-content" value="<?= $result['url']?>"></dd>
            </td>
        </dl>
    </tr>
    <tr>
        <dl>
            <td>
                <dt class="form-title"><label for="comment">書籍コメント：</label></dt>
            </td>
            <td>
                <dd><Textarea name="comment" id="comment" class="form-content"><?= $result['comment']?></textArea></dd>
            </td>
        </dl>
    </tr>
    <!--typeを書き換えられないようにするためフロントに見せないよう、hiddenにすること-->
    <input type="hidden" name="id" value="<?= $result['id']?>">
</table>
<table class="button">
    <tr>
        <td><input class="submit" type="submit" value="修正する"></input></td>
        <td><input class="reset" type="reset" value="リセット"></input></td>
    </tr>
</table>
</form>
    <!-- Main[End] -->
</body>
</html>

