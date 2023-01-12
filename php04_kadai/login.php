<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <link rel="stylesheet" href="css/main.css" />
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style>
        div {
            padding: 10px;
            font-size: 16px;
            display: flex;
            justify-content: space-around;
        }
        .navbar-default {
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



    </style>
    <title>ログイン</title>
</head>

<body>

    <header>
        <nav class="navbar navbar-default">ログイン画面</nav>
    </header>
    <header>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- lLOGINogin_act.php は認証処理用のPHPです。 -->
    <form name="form1" action="login_act.php" method="post">
    <table class="form">
        <tr>
            <dl>
                <td>
                    <dt class="form-title"><label for="title">ユーザーID：</label></dt>
                </td>
                <td>
                    <dd><input type="text" name="lid" id="title" class="form-content"></dd>
                </td>
            </dl>
        </tr>
        <tr>
            <dl>
                <td>
                <dt class="form-title"><label for="url">パスワード：</label></dt>
                    </td>
                <td>
                    <dd><input type="password" name="lpw" id="url" class="form-content"></dd>
                </td>
            </dl>
        </tr>
        <tr class="button">
            <td><input class="submit" type="submit" value="ログイン" /></td>
        </tr>
    </table>




    </form>


</body>

</html>
