<?php
  // データベースに接続
  //$dsn = 'mysql:host=localhost;dbname=tennis;charset=utf8';
  $dsn = 'mysql:host=mysql;dbname=shopping;charset=utf8'; // Dockerの場合はhostにサービス名を設定
  $user = 'shopowner'; // Dockerの場合はDBのuser hostは%もしくはIPを指定
  $password = 'password'; // shopownerに設定したパスワード

  try {
    $db = new PDO($dsn, $user, $password);
    $db->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    // プリペアドステートメントを作成
    $stmt = $db->prepare(
      "SELECT * FROM bbs ORDER BY date DESC LIMIT :page, :num"
    );
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
  <title>ユーザー登録</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <header>
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <h1>ユーザー登録</h1>
        </div>
      </div>
    </header>
  </div><!-- header col-sm-8 -->
    <hr>

    <div class="container">
      <form action="register.html" method="post" class="row">
        <div class="col-sm-8 offset-sm-2">
          <p>以下のフォームにご記入頂き、ユーザー登録してください。</p>

          <div class="form-group">
            <label for="name">メールアドレス<span class="badge badge-danger">必須</span></label>
            <input type="email" id="email" name="email" class="form-control" placeholder="kadai@exmaple.org" required>
          </div>

          <div class="form-group">
            <label for="name">パスワード<span class="badge badge-danger">必須</span></label>
            <input type="password" id="password" name="email" class="form-control" placeholder="Password" required>
          </div>

          <div class="form-group">
            <label for="name">氏名<span class="badge badge-danger">必須</span></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="山田太郎" required>
          </div>

          <div class="form-group">
            <label for="name">生年月日</label>
            <input type="date" id="birthday" name="birthday" class="form-control">
          </div>

          <label>性別</label>
          <div class="form-group">
            <div class="form-check form-check-inline radio-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="1" checked>
              <lavel class="form-check-label" for="male">男性</lavel>
            </div>
            <div class="form-check form-check-inline radio-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="2">
              <lavel class="form-check-label" for="female">女性</lavel>
            </div>
          </div>

          <div class="form-group">
            <label for="name">郵便番号("-"なしの数字を入力してください)</label>
            <input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="1230067">
          </div>

          <div class="form-group">
            <label for="name">都道府県</label>
            <input type="text" id="prefectures" name="prefectures" class="form-control" placeholder="東京都">
          </div>

          <div class="form-group">
            <label for="name">郡市区</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="千代田区">
          </div>

          <div class="form-group">
            <label for="name">それ以降の住所</label>
            <input type="text" id="address" name="address" class="form-control">
          </div>

          <div class="form-group">
            <label for="name">電話番号("-"なしの数字を入力してください)</label>
            <input type="tel" id="tel" name="tel" class="form-control" placeholder="09012345678">
          </div>

          <label>興味のあるカテゴリ</label>
          <div class="form-group">
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_1" value="fashion" checked>
                <label class="form-check-label" for="q1_1">ファッション</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_2" value="digital" checked>
                <label class="form-check-label" for="q1_2">エンタメ・デジタル家電</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_3" value="gourmet" checked>
                <label class="form-check-label" for="q1_3">グルメ</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_3" value="living" checked>
                <label class="form-check-label" for="q1_3">住まい・暮らし</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_3" value="health" checked>
                <label class="form-check-label" for="q1_3">美容・健康</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="q1" id="q1_3" value="sports" checked>
                <label class="form-check-label" for="q1_3">車・スポーツ</label>
            </div>
          </div>

          <button type="submit" class="btn btn-primary">登録</button>
        </div><!-- contents col-sm-8 -->
      </form>
    </div>

    <hr>
  <div class="container">
    <footer>
      <p>&copy; 制作課題 </p>
    </footer>
  </div><!-- footer -->
</body>
</html>