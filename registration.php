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
      <form action="write.php" method="post" class="row">
        <div class="col-sm-8 offset-sm-2">
          <p>以下のフォームにご記入頂き、ユーザー登録してください。</p>

          <div class="form-group">
            <label for="mail">メールアドレス<span class="badge badge-danger">必須</span></label>
            <input type="email" id="mail" name="mail" class="form-control" placeholder="kadai@exmaple.org" required>
          </div>

          <div class="form-group pass">
            <label for="password">パスワード<span class="badge badge-danger">必須</span></label>
            <input type="password" id="password" name="password" class="form-control" placeholder="Password" required>
          </div>

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
              <input class="form-check-input" type="radio" name="gender" id="male" value="男性" checked>
              <lavel class="form-check-label" for="male">男性</lavel>
            </div>
            <div class="form-check form-check-inline radio-inline">
              <input class="form-check-input" type="radio" name="gender" id="female" value="女性">
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
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_1" value="ファッション" checked>
                <label class="form-check-label" for="cat_1">ファッション</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_2" value="エンタメ・デジタル家電" checked>
                <label class="form-check-label" for="cat_2">エンタメ・デジタル家電</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_3" value="グルメ" checked>
                <label class="form-check-label" for="cat_3">グルメ</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_4" value="住まい・暮らし" checked>
                <label class="form-check-label" for="cat_4">住まい・暮らし</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_5" value="美容・健康" checked>
                <label class="form-check-label" for="cat_5">美容・健康</label>
            </div>
            <div class="form-check form-check-inline check-inline">
                <input class="form-check-input" type="checkbox" name="category[]" id="cat_6" value="車・スポーツ" checked>
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
      <p>&copy; 総合演習 </p>
    </footer>
  </div><!-- footer -->

  <script>
    document.querySelector('form').addEventListener('submit', (e)=>{
      let pass = document.getElementById('password').value;
      if (!pass.match(/^(?=.*?[a-z])(?=.*?\d)[a-z\d]{8,32}$/i)) {
        let elem = document.createElement("div");
        elem.textContent = "※半角英数字がそれぞれ1文字以上含む8文字以上32文字以下にする必要があります";
        elem.classList.add("alert");
        document.getElementById('password').insertAdjacentElement('afterend', elem);
        e.preventDefault();
      }
    });
  </script>
</body>
</html>