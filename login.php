<?php
  session_start(); // セッション開始

  if (isset($_SESSION['id'])) {
    // セッションにユーザーIDがある=ログインしている
    // トップページに遷移する
    header('Location: index.php');
  } else if (isset($_POST['name']) && isset($_POST['password'])) {
    // ログインしていないがユーザー名とパスワードが送信されたとき

    // データベースに接続
    //$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
    $dsn = 'mysql:host=mysql;dbname=tennis;charset=utf8'; // Dockerの場合はhostにサービス名を設定
    $user = 'tennisuser'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
    $password = 'password'; // tennisuserに設定したパスワード

    try {
      $db = new PDO($dsn, $user, $password);
      $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      // プリペアドステートメントを作成
      $stmt = $db->prepare(
        "SELECT * FROM users WHERE name=:name AND password=:pass"
      );
      // パラメータを割り当て
      $stmt->bindParam(':name', $_POST['name'], PDO::PARAM_STR);
      $stmt->bindParam(':pass', sha1($_POST['password']), PDO::PARAM_STR);
      // クエリの実行
      $stmt->execute();

      if ($row = $stmt->fetch()) {
        // ユーザーが存在していたので、セッションにユーザーIDをセット
        $_SESSION['id'] = $row['id'];
        header('Location: index.php');
        exit();
      } else {
        // 1レコードも取得できなかったとき
        // ユーザー名・パスワードが間違っている可能性あり
        // もう一度ログインフォームを表示
        header('Location: login.php');
        exit();
      }
    } catch(PDOException $e) {
      die("エラー：" . $e->getMessage());
    }
  } else {
    // ログインしていない場合はログインフォームを表示する
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
    <form action="" method="post" class="row">
      <div class="col-sm-8 offset-sm-2">
        <p>ログインしてください。</p>

        <div class="form-group">
          <label for="email">メールアドレス</label>
          <input type="email" id="email" name="email" class="form-control" placeholder="kadai@exmaple.org" required>
        </div>

        <div class="form-group">
          <label for="pass">パスワード</label>
          <input type="password" id="password" name="pass" class="form-control" placeholder="Password" required>
        </div>

        <?php if ($pass != '' && !preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/", $pass)): ?>
          <p class="alert">※半角英数字がそれぞれ1文字以上含む8文字以上32文字以下にする必要があります</p>
        <?php endif; ?>

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
<?php } ?>
