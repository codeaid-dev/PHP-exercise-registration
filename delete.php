<?php
  include 'includes/login.php';

  // セッションは継続されているのでidを取得
  $id = intval($_SESSION['id']);

  // データベースに接続
  //$dsn = 'mysql:host=localhost;dbname=shopping;charset=utf8'; // XAMPP/MAMP/VM
  $dsn = 'mysql:host=mysql;dbname=shopping;charset=utf8'; // Dockerの場合はhostにコンテナ名を設定
  $user = 'shopowner'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
  $password = 'password'; // shopownerに設定したパスワード

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアドステートメントを作成
    $stmt = $db->prepare(
      "DELETE FROM users WHERE id=:id"
    );
    // パラメータを割り当て
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    // クエリの実行
    $stmt->execute();
  } catch (PDOException $e) {
    echo "エラー：" . $e->getMessage();
  }
  header("Location: logout.php");
  exit();
?>
