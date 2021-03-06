<?php
  session_start();

  if (isset($_SESSION['regist'])) {
    // データの受け取り
    $mail = isset($_SESSION['regist']['mail']) ? $_SESSION['regist']['mail'] : '';
    $pass = isset($_SESSION['regist']['password']) ? $_SESSION['regist']['password'] : '';
    $name = isset($_SESSION['regist']['name']) ? $_SESSION['regist']['name'] : '';
    $birthday = isset($_SESSION['regist']['birthday']) ? $_SESSION['regist']['birthday'] : '';
    $gender = isset($_SESSION['regist']['gender']) ? $_SESSION['regist']['gender'] : '';
    $zipcode = isset($_SESSION['regist']['zipcode']) ? $_SESSION['regist']['zipcode'] : '';
    $pref = isset($_SESSION['regist']['pref']) ? $_SESSION['regist']['pref'] : '';
    $city = isset($_SESSION['regist']['city']) ? $_SESSION['regist']['city'] : '';
    $street = isset($_SESSION['regist']['street']) ? $_SESSION['regist']['street'] : '';
    $tel = isset($_SESSION['regist']['tel']) ? $_SESSION['regist']['tel'] : '';
    $category = isset($_SESSION['regist']['category']) && is_array($_SESSION['regist']['category']) ? $_SESSION['regist']['category'] : [];
    $category = implode(",", $category);

    unset($_SESSION['regist']);
  }

  // エラー表示はしないが、ここでパスワードをチェックすることもできる
/*  if (!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/i", $pass)) {
    echo "パスワードエラー";
    // ログインページをエラー表示とともに再表示
    header('Location: registration.php');
    exit(); // 終了
  }*/
  
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
    $stmt->bindParam(':pass', sha1($pass), PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    //$date = new DateTime($birthday);
    //$stmt->bindParam(':birthday', $date->format('Y-m-d'), PDO::PARAM_STR);
    $stmt->bindParam(':birthday', $birthday, PDO::PARAM_STR);
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
