<?php
  // データの受け取り
  $mail = trim($_POST['mail'] ?? '');
  $pass = trim($_POST['password'] ?? '');
  $name = trim($_POST['name'] ?? '');
  $birthday = trim($_POST['birthday'] ?? '');
  $gender = trim($_POST['gender'] ?? '');
  $zipcode = trim($_POST['zipcode'] ?? '');
  $pref = trim($_POST['pref'] ?? '');
  $city = trim($_POST['city'] ?? '');
  $street = trim($_POST['street'] ?? '');
  $tel = trim($_POST['tel'] ?? '');
  $category = isset($_POST['category']) && is_array($_POST['category'])? $_POST['category'] : [];
  $category = implode(",", $category);

// データベースに接続
  //$dsn = 'mysql:host=localhost;dbname=shopping;charset=utf8'; // XAMPP/MAMP/VM
  $dsn = 'mysql:host=mysql;dbname=shopping;charset=utf8'; // Dockerの場合はhostにコンテナ名を設定
  $user = 'shopowner'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
  $password = 'password'; // shopownerに設定したパスワード

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch(PDOException $e) {
    echo "エラー：" . $e->getMessage();
  }

  $error = false;
  $stmt = $db->prepare('SELECT mail FROM users WHERE mail = ?');
  $stmt->execute(array($mail));
  $already = $stmt->fetch();
  if ($already) {
    // メルアドはすでに登録されている
    $error = true;
  } else {
    // プリペアドステートメントを作成
    $stmt = $db->prepare(
      "INSERT INTO users (mail, password, name, birthday, gender, zipcode, pref, city, street, tel, category) VALUES (:mail, :pass, :name, :birthday, :gender, :zipcode, :pref, :city, :street, :tel, :category)"
    );
    // パラメータを割り当て
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    //$passcode = sha1($pass); // sha1でハッシュ化
    $passcode = password_hash($pass, PASSWORD_DEFAULT); // password_hashでハッシュ化
    $stmt->bindParam(':pass', $passcode, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    if (empty($birthday)) {
      $stmt->bindValue(':birthday', null, PDO::PARAM_NULL);
    } else {
      $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
    }
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':zipcode', $zipcode, PDO::PARAM_STR);
    $stmt->bindParam(':pref', $pref, PDO::PARAM_STR);
    $stmt->bindParam(':city', $city, PDO::PARAM_STR);
    $stmt->bindParam(':street', $street, PDO::PARAM_STR);
    $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindParam(':category', $category, PDO::PARAM_STR);

    // クエリの実行
    $stmt->execute();

  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
  <?php if ($error) { ?>
    <title>登録エラー</title>
  <?php } else { ?>
    <title>登録完了</title>
  <?php } ?>
</head>
<body>
  <div class="container">
    <header>
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
        <?php if ($error) { ?>
          <h1>登録エラー</h1>
        <?php } else { ?>
          <h1>登録完了</h1>
        <?php } ?>
        </div>
      </div>
    </header>
  </div><!-- header col-sm-8 -->
    <hr>

  <div class="container">
    <div class="signup">
      <div class="col-sm-8 offset-sm-2">
        <?php if ($error) { ?>
          <p style="color: red;">メールアドレスはすでに登録されています。</p>
        <?php } else { ?>
          <p>登録完了しました。</p>
        <?php } ?>
        <p><a href="registration.php" style="margin-right: 20px;">新規登録へ戻る</a><a href="index.php">トップへ戻る</a></p>
      </div><!-- contents col-sm-8 -->
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
