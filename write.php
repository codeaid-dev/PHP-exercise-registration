<?php
  // データの受け取り（php側でパスワードのエラーチェックをしないとき）
  $mail = $_POST['mail'];
  $pass = $_POST['password'];
  $name = $_POST['name'];
  $birthday = $_POST['birthday'];
  $gender = $_POST['gender'];
  $zipcode = $_POST['zipcode'];
  $pref = $_POST['pref'];
  $city = $_POST['city'];
  $street = $_POST['street'];
  $tel = $_POST['tel'];
  $category = $_POST['category'];

// データベースに接続
  //$dsn = 'mysql:host=localhost;dbname=shopping;charset=utf8';
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