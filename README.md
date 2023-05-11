# backlog_auto_check

## 仕様
指定したワークスペース、プロジェクト、ユーザーの情報を元に指定のアドレスに課題の一覧をメールに送信するシステムです。

## 使用方法
1. ```./backlog_auto_check/.htpasswd```にベーシック認証のIDとパスワードを設定して下さい。<br>
下記のサイトなどで文字列を生成しそのまま貼り付けて下さい。<br>
その後```./backlog_auto_check/.htaccess```の「AuthUserFile」に.htpasswdまでのフルパスを入力して下さい。
[https://tech-unlimited.com/makehtpasswd.html](https://tech-unlimited.com/makehtpasswd.html)
   <br><br>
2. ```./backlog_auto_check/config.php```に各種を入力して下さい。<br>
ユーザーIDは「APIキー」、「ワークスペースのID」、「プロジェクトのID」```./backlog_auto_check/get_user.php```にアクセスすることでも確認できます。<br>
**※デフォルトではセキュリティのためファイルには直接アクセスできないようになっています。アクセスする場合は```./backlog_auto_check/.htaccess```の最終行の「deny from all」を削除して下さい。**
   <br><br>
3. ```./backlog_auto_check```をサーバーにアップし通知を送信したい頻度でクーロンで```check_and_alert.php```を実行して下さい
[Xserevr](https://www.xserver.ne.jp/manual/man_program_cron.php)
[さくらサーバー](https://help.sakura.ad.jp/rs/2242/)
[ロリポップ](https://lolipop.jp/manual/user/cron/)
※ 推奨:php7.4以上
※ php上でcURLが実行できる必要があります。

## 追加予定機能
- 祝日の除外
- 設定のUI作成