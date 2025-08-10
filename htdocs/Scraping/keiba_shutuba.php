<?php
// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";

// 中央競馬
// 出馬表
// ※$race_at, $race_at1・2はレース結果のものを使いまわし
$race_at1 = "n";
$race_at2 = "h";
$race_at3 = "c";

echo "レース開催地を入力：".PHP_EOL;
$race_at_shutuba = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得

if($race_at_shutuba === $race_at1 ){
     // 中山-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024060201";
     // 中山-日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024060206";
     // 中山-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2021060405";
}
elseif($race_at_shutuba === $race_at2){
     // 阪神-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024090101";
     // 阪神-日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024090106";
     // 阪神-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2021070505";
}
elseif($race_at_shutuba === $race_at3){
     // 中京-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024100205";
     // 中京-日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024070102";
     // 中京-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2021070505";
}
else{
     echo "レース開催地の入力が適切ではありません。";
     exit;     
}


// ファイル書き込み用配列<出馬表>
$fc_shutuba = array();

echo PHP_EOL."何レース目の出馬表か入力：".PHP_EOL;
$race_id = trim(fgets(STDIN, 4096));;//何レース目か入力し、その値を取得
if((strlen($race_id)) !== 2 ){
     echo "2桁で入力してください";
     $race_id = trim(fgets(STDIN, 4096));
     // 中央競馬
     $url = $url_content.$race_id;
     echo $race_id.PHP_EOL;
}
else{
     // 中央競馬
     $url = $url_content.$race_id;
     // レース番号(ID)出力
     $race_id =  ltrim($race_id,0);
     echo $race_id."R".PHP_EOL;
}
// URLを指定してオブジェクト化します
// 中央競馬
$html = file_get_html($url);

// 全てのタグのうち「class=RaceData01」である要素を配列として取得
$Courses_arr_shutuba = $html->find("div[class=RaceData01]");
//配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
foreach($Courses_arr_shutuba as $value){
    $Plaintext_Courses_arr = explode(" / ",(trim($value -> plaintext)));
    $Plaintext_C_Distance = $Plaintext_Courses_arr[1];
    echo $Plaintext_C_Distance.PHP_EOL;
    //     $Arr_C_Distance[] = $Plaintext_C_Distance;
}
// 全てのタグのうち「class=Jockey」である要素を配列として取得
$Jockey_arr_shutuba = $html->find("td[class=Jockey] a");
//配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
// foreach($Jockey_arr_shutuba as $value){
//      $Plaintext_Jockey = trim(($value -> plaintext)).PHP_EOL;
//      echo $Plaintext_Jockey;
//      // $Arr_Jockey[] = $Plaintext_Jockey; 
// }

for($counter = 0; $counter <=17; $counter++){
     $Plaintext_Jockey = trim(($Jockey_arr_shutuba[$counter] -> plaintext));
     echo $Plaintext_Jockey.PHP_EOL;
     if ($counter == 17){echo PHP_EOL;}
}

exit;
?>