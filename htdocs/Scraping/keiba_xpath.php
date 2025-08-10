<?php

// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";



//レース結果騎手取得
// 地方競馬
//出馬表(※出馬表ではなく、馬柱のURLを選ぶこと
$race_at1 = "u";
// $race_at2 = "koti";
$race_at2 = "k";

echo PHP_EOL."見たい出馬表レース開催地を入力：".PHP_EOL;
$race_at_shutuba = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得
// ※$race_at1・2はレース結果のものを使いまわし
if($race_at_shutuba === $race_at1 ){
     // 大井
     // $url_content_tiho = "https://nar.netkeiba.com/race/shutuba_past.html?race_id=2021441103";
     // 浦和
     // $url_content_tiho = "https://nar.netkeiba.com/race/shutuba_past.html?race_id=2021421123";
}
elseif($race_at_shutuba === $race_at2){
     // 高知
     $url_content_tiho = "https://nar.netkeiba.com/race/shutuba_past.html?race_id=2022541106";
     // 園田
     // $url_content_tiho = "https://nar.netkeiba.com/race/shutuba_past.html?race_id=2021501123";
     // 川崎
     // $url_content_tiho = "https://nar.netkeiba.com/race/shutuba_past.html?race_id=2021451215";

}
else{
     echo "レース開催地の入力が適切ではありません。";
     exit;     
}



echo PHP_EOL."何レース目の出馬表か入力：".PHP_EOL;
$race_id = trim(fgets(STDIN, 4096));//何レース目か入力し、その値を取得
if((strlen($race_id)) !== 2 ){
     echo "2桁で入力してください";
     $race_id = trim(fgets(STDIN, 4096));
     // 地方競馬
     $url_tiho= $url_content_tiho.$race_id;
}
else{
      // 地方競馬
     $url_tiho= $url_content_tiho.$race_id;
}
// URLを指定してオブジェクト化します
// 地方競馬
$html_tiho = file_get_html($url_tiho);

//Xpath読み込み
$dom = new DOMDocument;
// $html = mb_convert_encoding($html_tiho);
$dom->loadHTML($html);
$xpath = new DOMXPath($dom);
// $xpath->registerNamespace("php", "http://php.net/xpath");
// $xpath->registerPHPFunctions();
//ここにスクレイピングした値が入る。
$x = $xpath->query('//div[@class="Jockey"]/text()');
foreach ($xpath->query('//div[@class="Jockey"]/text()') as $node) {
    if (strlen(trim($node->nodeValue)) > 0)
        echo($node->nodeValue);
}

?>