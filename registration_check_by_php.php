<?php
  session_start();

  if (isset($_POST['password'])) {
    // 必須項目チェック（パスワードは半角英数字がそれぞれ1文字以上含む8文字以上32文字以下）
    if (!preg_match("/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/i", $_POST['password'])) {
      $err['mail'] = "keyword";
    }
    if (empty($err)) {
      $_SESSION['regist'] = $_POST;
      header('Location: write.php');
      exit();
    }
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
      <form action="" method="post" class="row">
      <!-- for no check password <form action="write.php" method="post" class="row">-->
        <div class="col-sm-8 offset-sm-2">
          <p>以下のフォームにご記入頂き、ユーザー登録してください。</p>

          <div class="form-group">
            <label for="mail">メールアドレス<span class="badge badge-danger">必須</span></label>
            <input type="email" id="mail" name="mail" class="form-control" placeholder="kadai@exmaple.org" required>
          </div>

          <div class="form-group">
            <label for="password">パスワード<span class="badge badge-danger">必須</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          </div>

          <?php if (isset($err['mail']) && $err['mail'] == "keyword"): ?>
            <p class="alert">※半角英数字がそれぞれ1文字以上含む8文字以上32文字以下にする必要があります</p>
          <?php endif; ?>

          <div class="form-group">
            <label for="name">氏名<span class="badge badge-danger">必須</span></label>
            <input type="text" id="name" name="name" class="form-control" placeholder="山田太郎" required>
          </div>

          <div class="form-group">
            <label for="birthday">生年月日</label>
            <input type="date" id="birthday" name="birthday" class="form-control">
          </div>

          <label>性別</label>
          <div class="form-group">
            <div class="form-check form-check-inline radio-inline">
              <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked>
              <lavel class="form-check-label" for="male">男性</lavel>
            </div>
            <div class="form-check form-check-inline radio-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="female">
              <lavel class="form-check-label" for="female">女性</lavel>
            </div>
          </div>

          <div class="form-group">
            <label for="zipcode">郵便番号</label>
            <input type="text" id="zipcode" name="zipcode" class="form-control" placeholder="123-0067">
          </div>

          <div class="form-group">
            <label for="pref">都道府県</label>
            <input type="text" id="pref" name="pref" class="form-control" placeholder="東京都">
          </div>

          <div class="form-group">
            <label for="city">郡市区</label>
            <input type="text" id="city" name="city" class="form-control" placeholder="千代田区">
          </div>

          <div class="form-group">
            <label for="street">それ以降の住所</label>
            <input type="text" id="street" name="street" class="form-control">
          </div>

          <div class="form-group">
            <label for="tel">電話番号("-"なしの数字を入力してください)</label>
            <input type="tel" id="tel" name="tel" class="form-control" placeholder="09012345678">
          </div>

          <label>興味のあるカテゴリ</label>
          <div class="form-group">
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_1" value="fashion" checked>
                <label class="form-check-label" for="cat_1">ファッション</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_2" value="digital" checked>
                <label class="form-check-label" for="cat_2">エンタメ・デジタル家電</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_3" value="gourmet" checked>
                <label class="form-check-label" for="cat_3">グルメ</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_4" value="living" checked>
                <label class="form-check-label" for="cat_4">住まい・暮らし</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_5" value="health" checked>
                <label class="form-check-label" for="cat_5">美容・健康</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category" id="cat_6" value="sports" checked>
                <label class="form-check-label" for="cat_6">車・スポーツ</label>
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