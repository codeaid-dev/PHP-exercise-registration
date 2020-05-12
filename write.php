<?php
  // データの受け取り
  $mail = isset($_POST['mail']) ? $_POST['mail'] : '';
  $pass = isset($_POST['password']) ? $_POST['password'] : '';
  $name = isset($_POST['name']) ? $_POST['name'] : '';
  $birthday = isset($_POST['birthday']) ? $_POST['birthday'] : '';
  $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
  $zipcode = isset($_POST['zipcode']) ? $_POST['zipcode'] : '';
  $pref = isset($_POST['pref']) ? $_POST['pref'] : '';
  $city = isset($_POST['city']) ? $_POST['city'] : '';
  $street = isset($_POST['street']) ? $_POST['street'] : '';
  $tel = isset($_POST['tel']) ? $_POST['tel'] : '';
  $category = isset($_POST['category']) && is_array($_POST['category'])? $_POST['category'] : [];
  $category = implode(",", $category);

// データベースに接続
  //$dsn = 'mysql:host=localhost;dbname=shopping;charset=utf8'; // XAMPPなどの場合
  $dsn = 'mysql:host=mysql;dbname=shopping;charset=utf8'; // Dockerの場合はhostにサービス名を設定
  $user = 'shopowner'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
  $password = 'password'; // shopownerに設定したパスワード

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアドステートメントを作成
    $stmt = $db->prepare(
      "INSERT INTO users (mail, password, name, birthday, gender, zipcode, pref, city, street, tel, category) VALUES (:mail, :pass, :name, :birthday, :gender, :zipcode, :pref, :city, :street, :tel, :category)"
    );
    // パラメータを割り当て
    $stmt->bindParam(':mail', $mail, PDO::PARAM_STR);
    $passcode = sha1($pass);
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
    header('Location: login.php');
    exit();
  } catch(PDOException $e) {
    echo "エラー：" . $e->getMessage();
  }
?>
