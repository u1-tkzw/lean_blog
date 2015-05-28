## ブログアプリ
### 機能
- 投稿済み記事一覧表示: 実装済み(仮)
- 新規記事投稿: 実装済み
- 記事編集: 未実装
- コメント投稿: 実装済み
- UI の日本語化: 済
- エラーメッセージの日本語化: 済

### ToDo (優先度順)
- 記事に改行を含める(入力時、出力時)
- プロフィール設定画面作成
- 記事DB設計 -> いいね数、コメント数
- 記事一覧ページで記事のコメント数を表示する
- 記事画面でいいねができるようにする
- 記事一覧画面をかっこよくする
- 投稿画面の datepicker を動くようにする
- 記事一覧ページで表示順を指定できるようにする(ドロップダウンで"投稿日時昇順,降順")

### 既知の問題
- datetimepicker が動かない

### DB 設計
##### Users
- id
- name
- email
- password
- token
- [new] profile (option)
- [new] image_id (option)

##### Posts
- id
- user_id
- title
- body
- date

##### Comments
- id
- post_id
- name
- body
- user_id 持たせたほうがいいか・・？  
ログイン時は自動挿入、ゲスト時は null

##### Images
- id
- user_id (アップロード者)
- filename (URL生成用自動採番)
- type (1:プロフ、2:タイトル、3:記事内)
