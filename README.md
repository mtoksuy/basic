![ViewComponent logo](https://basic.dance/app/assets/img/ogp/basic_ogp_1.png)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.2-8892BF.svg?style=flat-square)](https://php.net/)
[![GitHub release](https://img.shields.io/github/v/release/mtoksuy/basic)](https://github.com/mtoksuy/basic)
[![GitHub forks](https://img.shields.io/github/forks/mtoksuy/basic)](https://github.com/mtoksuy/basic/network)
[![GitHub stars](https://img.shields.io/github/stars/mtoksuy/basic)](https://github.com/mtoksuy/basic/stargazers)

# Basicセットアップ
## 0.事前準備
- 開発環境(ローカル) or サーバーを用意する
- DBを準備する
## 1.サーバーからダウンロード
rootでsshログインしている前提でセットアップ方法を記述しています。
```
## 移動
cd var/www/html
## ダウンロード
wget https://github.com/mtoksuy/basic/archive/refs/tags/v0.9.13.zip
## zip解凍
unzip v0.9.13.zip
## zip削除
rm -r -f v0.9.13.zip
## 移動
cd /var/www/html/basic-0.9.13/
## basicファイル群移動
mv * .* /var/www/html/
"."と".."をどうするか求められますが、スルーしてエンターを押してください。
## 移動
cd /var/www/html/
## 空のディレクトリ削除
rmdir /var/www/html/basic-0.9.13/
## 権限変更
chown -R apache:apache /var/www/html
```
## 2.ローカルからアップロード
### 2-1.Download ZIP
https://github.com/mtoksuy/basic/archive/refs/tags/v0.9.13.zip

でローカルにダウンロードして開発している前提でセットアップ方法を記述してます。
#### 2-1-1.FTPなどでアップロード
アップロードする際の注意点ですが、ユーザー：apache でアップロードして下さい。

難しい場合はサーバーにsshにてrootでログイン後
```
chown -R apache:apache /var/www/html
```
でroot配下の所有者・グループを apache に変更をします。

## 3.うまく表示できない場合、確認するポイント
- 所有者・グループが apache なっているか確認
- ローカルからアップ後DB接続できない場合は setting/db_config.php の設定を確認
- 設定しているDBがあるか確認
- サーバーにDB(mysql, MariaDBなど)がインストールされてるか確認
- サーバーにPHPがインストールされてるか確認
- パケットフィルタリングなどで80 or 443のポートが通ってるか確認

# 世界で最もSEOに効くCMS
世界で公開されているウェブの67% がCMSで構築されています。それらのCMSですが、私たちの目線からは大雑把だったり足りない機能が多いのが現状です。複雑なCMS、カスタマイズ、表示スピード、UX、最新画像フォーマットなどを解決するためにBasicを立ち上げました。

# パーパス：インターネットを作る、全ての人たちが抱える悩みを解放する。
私たちは、インターネットが大好きです。そんなインターネットを作り続ける人たちに向けてBasicを作りました。サービスを作る人にもECサイトを運営する人にもブログを書く人にもどんな些細なメリットでも届けたいんです。その答えとしてコンテンツを作る「CMS」の悩みを解決しようと考えました。近年、ページの表示スピードに対する評価は高まりつつあります。その表示スピードを遅くしている要因として「CMS」が挙げられます。他にも複雑なCMS、カスタマイズ、UX、最新画像フォーマットと問題は山積みです。それらを最適化しBasicを通じてインターネットを作る全てを人たちの問題を解決していきます。

# ミッション：世界で公開されているウェブの50% 以上のCMSをBasicに塗り替える

## Basic 9つの特徴
- スピードに特化したCMS
- 世界で一番シンプルなCMS
- 完全無料のCMS
- デベロッパー・ファースト
- ノーコードでも楽々構築
- webPに完全対応
- 超軽量化で超高速配信
- SEOにつよつよ
- 管理が簡単


## 課題解決
### 複雑なCMSをシンプルに
直感的に誰しもがシームレスに運営が可能に
無駄を取り払った管理画面
機能を足す事より重要ではない機能を削ぎ落とた事により直感で操作が容易になりました

### CMSのカスタマイズ
テーマ別に切り分け可能
MVCモデル概念導入でカスタマイズが容易
テーマ別に切り分けも可能、かつ普遍的なMVCモデル概念が導入されているので複数人でカスタマイズを行う事も可能です

### Webサイトの表示速度
自動でページ容量70%以上の軽量化を
圧縮化されたページ読み込みで一瞬で表示が可能
デフォルトで高速配信が行われますのでユーザーはコンテンツ作成に集中できます

### ユーザーのUXを底上げ
一瞬で表示されるページでユーザー満足度を上げて
コンバージョンを最大化
軽くなったページを高速で配信されますのでユーザー体験を最大限まで引き上げます

### SEOで順位を上げたい
ページの圧縮化を行い高速配信する事によって70%以上のページ超軽量化
相対的にライバルサイトより優位に立てる
Googleが指標としている表示スピードのウェイトは年々重くなっています。どんなCMSより高速表示ができるBasicを選ぶだけでライバルサイトより評価されます

### 画像をwebPに自動変換
今まで通りのjpg・pngをアップロードするだけで
自動でwebPが表示されます
最新の画像フォーマットを追い続けています。変換するにしても最適な方法でwebPに変換しています


[Basic - サイトを楽して、直感的に、より良いCMSで。](https://basic.dance)
