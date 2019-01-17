<?php


// 出力情報の設定
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=cpsSlackThreads.csv");
header("Content-Transfer-Encoding: binary");

// 変数の初期化
$csv = null;

$items = $_GET["items"];

// 1行目のラベルを作成
$csv = '"id","user_name","content","time","channel"' . "\n";

// 出力データ生成
foreach( $items as $item ) {
	$csv .= '"' . strval($item -> id) . '","' . strval($item -> user_name) . '", "' . strval($item -> content) . '","' . strval($item -> time) . '","' . strval($item -> channel).'"' . "\n";
}

// CSVファイル出力
echo $csv;
return;