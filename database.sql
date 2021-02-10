/* ネットショップのログインとユーザー登録を想定 */
/* shoppingデータベース作成 */
CREATE DATABASE shopping;

USE shopping;

/* shoppingデータベースのユーザ作成（shopowner） */
/* GRANT ALL ON shopping.* to 'shopowner'@'localhost' IDENTIFIED BY 'password'; */
GRANT ALL ON shopping.* to 'shopowner'@'%' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

/* shopownerユーザでログイン */
mysql -u shopowner -p

USE shopping;

/* usersテーブル作成 */
CREATE TABLE users (
  id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  mail VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  birthday DATE,
  gender VARCHAR(10),
  zipcode VARCHAR(10),
  pref VARCHAR(10),
  city VARCHAR(255),
  street VARCHAR(255),
  tel VARCHAR(15),
  category VARCHAR(50)
) DEFAULT CHARACTER SET=utf8;

/* テーブル確認 */
DESC users;
