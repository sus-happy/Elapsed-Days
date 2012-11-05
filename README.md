# Elapsed-Days

投稿してから何日経ったのか表示するWordPressプラグイン

## インストール

wp-content -> pluginsフォルダにアップロード、有効化を行うだけです。

## 使い方

### 設定

有効化をすると、「設定」の中に「Elapsed Days」が追加され、各種パラメータの設定が可能となります。

* 表示ライン
    * ここで入力した日数を越えた時に「○日前」と表示します。
* 表示フォーマット
    * 「○日前」のフォーマットを変更できます。
* 当日
    * 投稿日当日の際に表示するテキストを変更できます。

### 表示

テーマファイルの表示させたい箇所に、下記の記述を行います。

    <?php the_elapsedDays() ?>

また、変数に代入したい場合は、下記のように記述します。

    <?php $elapsed_days = get_the_elapsedDays(); ?>