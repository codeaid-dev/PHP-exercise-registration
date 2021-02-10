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
      "SELECT * FROM users WHERE id=:id"
    );
    // パラメータを割り当て
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    // クエリの実行
    $stmt->execute();
  } catch(PDOException $e) {
    echo "エラー：" . $e->getMessage();
  }
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ユーザー情報</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <header>
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <h1>ユーザー情報</h1>
        </div>
      </div>
    </header>
  </div><!-- header col-sm-8 -->
    <hr>

  <div class="container">
    <div class="row uinfo">
      <div class="col-sm-8 offset-sm-2">
        <?php
          while ($row = $stmt->fetch()):
        ?>
        <table>
          <tbody>
            <tr>
              <th>メールアドレス：</th>
              <td><?php echo $row['mail'] ?></td>
            </tr>
            <tr>
              <th>氏名：</th>
              <td><?php echo $row['name'] ?></td>
            </tr>
            <tr>
              <th>生年月日：</th>
              <td><?php echo $row['birthday'] ?></td>
            </tr>
            <tr>
              <th>性別：</th>
              <td><?php echo $row['gender'] ?></td>
            </tr>
            <tr>
              <th>郵便番号：</th>
              <td><?php echo $row['zipcode'] ?></td>
            </tr>
            <tr>
              <th>都道府県：</th>
              <td><?php echo $row['pref'] ?></td>
            </tr>
            <tr>
              <th>郡市区：</th>
              <td><?php echo $row['city'] ?></td>
            </tr>
            <tr>
              <th>それ以降の住所：</th>
              <td><?php echo $row['street'] ?></td>
            </tr>
            <tr>
              <th>電話番号：</th>
              <td><?php echo $row['tel'] ?></td>
            </tr>
            <tr>
     
            <th>興味のあるカテゴリ：</th>
              <td><?php echo $row['category'] ?></td>
            </tr>
          </tbody>
        </table>
        <?php
          endwhile;
        ?>
      </div>
    </div><!-- user info -->

    <div class="row">
      <div class="col-sm-4 offset-sm-2 logout">
        <form action="logout.php" method="post">
          <button type="submit" class="btn btn-primary">ログアウト</button>
        </form><!-- logout -->
      </div>
      <div class="col-sm-4 delete">
        <form action="delete.php" method="post">
          <button type="submit" class="btn btn-primary">ユーザー削除</button>
        </form><!-- user delete -->
      </div>
    </div>

  </div><!-- contents -->
  <hr>

  <div class="container">
    <footer>
      <p>&copy; 総合演習 </p>
    </footer>
  </div><!-- footer -->

</body>
</html>