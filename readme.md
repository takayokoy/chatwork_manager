## Chatwork Manager

Chatworkでメンバーを複数チャットルームに一括追加します。
※メンバーの一括権限変更や削除機能はまだ未実装です

# Install

```
git clone https://github.com/takayokoy/chatwork_manager.git
cd chatwork_manager

composer install

cp .env.example .env
php argisan key:generate
php artisan migrate
php artisan serve
```
http://127.0.0.1:8000 にアクセスして以下の手順でAPIキーを登録します。
- ログイン画面でユーザー情報を登録→ログイン
- http://developer.chatwork.com/ja/index.htmlに従ってAPIキーを取得する
- http://127.0.0.1:8000/homeの「ChatworkAPIトークン設定」に取得したAPIキーを設定

「メンバーを複数チャットルームに一括追加する」リンクからメンバー追加ページに遷移して、
対象アカウントIDと追加対象チャットルームを選択してメンバー追加できます。
（※アカウントID＝チャットで「引用」したときの"[引用 aid=xxxxxx]"←xxx部分）

※Chatwork APIの利用テスト用プロジェクトのため、本アプリケーションの利用は自己責任でお願いします。