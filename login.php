<?php
  session_start();

  if (isset($_SESSION['id'])) {
    // セッションにユーザーIDがある=ログインしている
    // トップページに遷移する
    header('Location: index.php');
    exit();
  }

  if (isset($_POST['mail']) && isset($_POST['password'])) {
    $mail = trim($_POST['mail'] ?? '');
    $pass = trim($_POST['password'] ?? '');
  
    // データベースに接続
    //$dsn = 'mysql:host=localhost;dbname=shopping;charset=utf8'; // XAMPP/MAMP/VM
    $dsn = 'mysql:host=mysql;dbname=shopping;charset=utf8'; // Dockerの場合はhostにコンテナ名を設定
    $user = 'shopowner'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
    $password = 'password'; // shopownerに設定したパスワード

    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // プリペアドステートメントを作成
      // sha1を使った時はメルアドとパスワードの両方でクエリ
      //$stmt = $db->prepare("SELECT * FROM users WHERE mail=:mail AND password=:pass");
      // password_hashを使った時はメルアドでクエリ
      $stmt = $db->prepare("SELECT * FROM users WHERE mail=:mail");
      // パラメータを割り当て
      $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
      //$passcode = sha1($pass);
      //$stmt->bindParam(':pass', $passcode, PDO::PARAM_STR);
      // クエリの実行
      $stmt->execute();

      if ($row = $stmt->fetch()) {
        // パスワードをpassword_hashで記録した場合はpassword_verifyでチェック
        // パスワードをsha1で記録した場合はif文をコメントにする
        if (password_verify($pass, $row['password'])) {
          // ログイン成功
          // セッションにユーザーIDをセット
          $_SESSION['id'] = $row['id'];
          header('Location: index.php');
          exit();
        }
      }
      // ログイン失敗
      // もう一度ログインフォームを表示
      header('Location: login.php');
      exit();
    } catch(PDOException $e) {
      die("エラー：" . $e->getMessage());
    }
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <title>ログイン</title>
</head>
<body>
  <div class="container">
    <header>
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <h1>ログイン</h1>
        </div>
      </div>
    </header>
  </div><!-- header col-sm-8 -->
    <hr>

  <div class="container">
    <form action="login.php" method="post" class="row">
      <div class="col-sm-8 offset-sm-2">
        <p>ログインしてください。</p>

        <div class="form-group">
          <label for="mail">メールアドレス</label>
          <input type="email" id="mail" name="mail" class="form-control" placeholder="kadai@exmaple.org" required>
        </div>

        <div class="form-group">
          <label for="password">パスワード</label>
          <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
        </div>

        <button type="submit" class="btn btn-primary">ログイン</button>
      </div><!-- contents col-sm-8 -->
    </form>

    <div class="signup">
    <form action="registration.php" method="post" class="row">
      <div class="col-sm-8 offset-sm-2">
        <h2>新規登録</h2>
        <p>初めての方は新規登録をしてください</p>
        <button type="submit" class="btn btn-primary">新規登録</button>
      </div><!-- contents col-sm-8 -->
    </form>
    </div>
  </div>

    <hr>
  <div class="container">
    <footer>
      <p>&copy; 総合演習 </p>
    </footer>
  </div><!-- footer -->

</body>
</html>
