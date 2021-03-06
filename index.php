﻿<?php
	require("input_form.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
<head>
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta http-equiv="Content-Script-Type" content="text/javascript" />
<meta http-equiv="Content-Type" content="text/html; charset=shift_jis" />
<title>音声文字起こしＷＥＢ</title>
<meta name="description" content="" />
<meta name="keywords" content="" />
<link rel="stylesheet" href="base.css" type="text/css" media="screen" />
<script src="./jquery-3.2.1.min.js"></script>
<script>
    function file_upload()
    {
        // フォームデータを取得
        var formdata = new FormData($('#my_form').get(0));

        // POSTでアップロード
        $.ajax({
            url  : "upload.php",
            type : "POST",
            data : formdata,
            cache       : false,
            contentType : false,
            processData : false,
            dataType    : "html"
        })
        .done(function(data, textStatus, jqXHR){
            var filename = data;
            if(filename =="NULL"){
                alert("アップロード失敗、ファイル名を変えてもう１度試してみてください。");
            }else{
                alert("アップロード成功");
                $("#file_id").append("<option value='"+filename+"'>"+filename+"</option>");
                
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            alert("アップロードエラー");
        });
    }
</script>
<script>
    function wave()
    {
        // フォームデータを取得
        var JSONdata = {
            selectname: $("#file_id").val() 
        };
        alert(JSON.stringify(JSONdata));
        // POSTでアップロード
        $.ajax({
            url  : "action.php",
            type : "POST",
            data : JSON.stringify(JSONdata),
            cache       : false,
            contentType : 'application/JSON',
            processData : false,
            dataType    : "html"
        })
        .done(function(data, textStatus, jqXHR){
            var filename = data;
            if(filename =="NULL"){
                alert("変換失敗。");
            }else{
                alert("変換しました。");
                const textarea2= document.getElementById("txt");
                textarea2.value = data;
                //document.getElementById("span2").textContent = textarea2.value; 
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            alert("変換エラー");
        });
        
    }
</script>
<!-- base layout css.design sample -->
</head>
<body>
<div id="wrapper">
<div id="header">
<div id="header-inner">
<!-- キーワード -->
<h1>音声文字起こしＷＥＢ</h1>
<!-- ページの概要 -->
<p class="description">ＩＣレコーダーで録音した音声ファイルをアップロード</br>すると文字に変換して表示します。</br>アップロードできる音声ファイルは以下の通りです。</br>・Wav</br>文字に起こす際に音声を９分ごとに分割します。</p>
<!-- 企業名｜ショップ名｜タイトル -->
<p class="logo"><a href="index.html">大崎コンピュータエンヂニアリング</a></p>
</div></div>
<!-- // header end -->

<div id="container">
<div id="contents">
<!-- コンテンツここから -->

<h2>アップローダー</h2>
    <form id="my_form">
        <input type="file" name="file_1" accept='audio/wav'>
        <button type="button" onclick="file_upload()">アップロード</button>
    </form>
<p>WAVファイルを選択してアップロードボタンを押してください。</p>
<p></p>

<h2>変換ファイルの選択</h2>
    <form id ="filename">
      <select id="file_id" name="file_id">
        <option value="NULL">--- どのファイルを選択しますか? ---</option>
      </select>
      <button type="button" onclick="wave()">変換</button>
    </form>
<p>アップロードした音声ファイルが一覧で表示されます。</p>
<p>その中で変換したいファイルを選択して変換ボタンを押してください</p>

<h3>変換結果</h3>
<p>変換結果が表示されます</p>
<form name="result">
    <span id="span2"></span>
    <textarea id="txt" rows="10" cols="50" readonly></textarea>
</form>

<!-- コンテンツここまで -->
</div><!-- // contents end -->

<div id="left-sidebar">
<!-- 左サイドバーここから -->

<p class="side-title">*** タイトル ***</p>
<ul class="localnavi">
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
</ul>
<p class="side-title">*** タイトル ***</p>
<ul class="localnavi">
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
<li><a href="#">*** リンク ***</a></li>
</ul>

<!-- 左サイドバーここまで -->
</div>
<!-- // left-sidebar end -->
</div>

<div id="right-sidebar">
<!-- 右サイドバーここから -->

<p class="side-title">*** タイトル ***</p>
<p>テキスト</p>
<p>テキスト</p>
<p>テキスト</p>
<p>テキスト</p>

<!-- 右サイドバーここまで -->
</div>
<!-- // right-sidebar end -->
<!-- CSSデザインサンプル著作権表示 削除不可-->
<p id="cds">Designed by <a href="http://www.css-designsample.com/">CSS.Design Sample</a></p>
<div id="footer">
<!-- コピーライト / 著作権表示 -->
<p>Copyright &copy; *** 大崎コンピュータエンヂニアリング ***. All Rights Reserved.</p>
</div>
</div>
</body>
</html>
