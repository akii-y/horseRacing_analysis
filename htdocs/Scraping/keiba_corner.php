<?php
// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";

/* 置換：
 \n
*/

//出馬表(※出馬表ではなく、馬柱のURLを選ぶこと
$race_at1 = "n";
$race_at2 = "h";
$race_at3 = "c";

// 中央競馬
echo "レース開催地を入力：".PHP_EOL;
$race_at_shutuba = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得
// ※$race_at1・2はレース結果のものを使いまわし
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
     // -日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2024070102";
     // 中京-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba_past.html?race_id=2021070505";
}
else{
     echo "レース開催地の入力が適切ではありません。";
     exit;     
}

echo PHP_EOL."何レース目の出馬表か入力：".PHP_EOL;
$race_id = trim(fgets(STDIN, 4096));//何レース目か入力し、その値を取得
if((strlen($race_id)) !== 2 ){
     echo "2桁で入力してください".PHP_EOL;
     $race_id = trim(fgets(STDIN, 4096));
     // 中央競馬
     $url = $url_content.$race_id;
}
else{
    // 中央競馬
    $url = $url_content.$race_id;
}
// URLを指定してオブジェクト化します
// 中央競馬
$html = file_get_html($url);

// 全てのタグのうち「class=Data06」である要素を配列として取得
$Jockey_arr_shutuba = $html->find("div[class=Data06]");
// 空要素を削除
$Jockey_arr_shutuba = array_filter($Jockey_arr_shutuba);

// データ数カウント用変数
$count_data = 1;
//配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
foreach($Jockey_arr_shutuba as $value){
    // 余計な文字列「&nbsp;」を空白スペースに置き換える
    $data = str_replace("&nbsp;","　",(trim($value -> plaintext)));
    // 文字列（$data）から「馬体重」を抜き出し、キャスト（型変換）して格納
    $isolate_horse_item1 = (int)substr($data, -7,3);
    // 「馬体重変化量」については桁数が3通り(ex.「0」,「-4」,「+12」)あるので分岐処理
    // 2桁※桁数は符号も含めている
    $isolate_horse_item2 = substr($data, -3,2);
    //「0」の場合
    if (is_numeric($isolate_horse_item2) !== true){
          $isolate_horse_item2 = substr($data, -2,1);
          //馬体重変化量の桁数が減ること（2桁→1桁）に伴って馬体重の修正
          $isolate_horse_item1 = (int)substr($data, -6,3);
     }
     //2桁の場合
    elseif (is_numeric(substr($isolate_horse_item2,0,1)) == true){
          $isolate_horse_item2 = substr($data, -4,3);
          //馬体重変化量の桁数が増えること（2桁→3桁）に伴って馬体重の修正
          $isolate_horse_item1 = (int)substr($data, -8,3);
    }
    // 意図通り抜き出した後、キャストする。
    $isolate_horse_item2 = (int)$isolate_horse_item2;

    // 配列型変数hs_weight（定義は省略）に添番を$count_dataとして、「馬体重」を代入。
    $hs_weight[$count_data] = $isolate_horse_item1;
    // 配列型変数hs_weight（定義は省略）に添番を$count_dataとして、「馬体重変化量」を代入。
    $hs_weight_diff[$count_data] = $isolate_horse_item2;
    //要素一つ目出力
    //     馬体重と一つ前の要素（添番で言うと「-1」）とが異なる場合、改行する。
    if ($count_data >= 2){
          if(($hs_weight[$count_data-1] - $hs_weight[$count_data]) !== $hs_weight_diff[$count_data-1]){
               echo PHP_EOL;
          }
     }
     ;
     echo $data;
     echo " /";
   // 全頭成績に空欄がない場合、5走で区切る
   // if($count_data % 5 === 0){
   //      echo PHP_EOL;
   //  }

    $count_data += 1;
    // ↓試行錯誤中
    // $fc_shutuba = trim(($value -> plaintext));
    // var_dump($fc_shutuba[1]);
}
//二次元配列にする
// $corner_arr[] = array();
// $corner_arr[] = 





// 位置取り取得(未完成)
// URL取得
// $corner_url = "https://race.netkeiba.com/race/result.html?race_id=202110040107"; 
// // URLを指定してオブジェクト化します
// $corner_html = file_get_html($corner_url);
// var_dump($corner_html->find("[class=RaceCommon_Table Corner_Num td]",5));

// ファイル出力
// $file = 'C:\Apache24\htdocs\Scraping\result_corner.txt';
// echo $fc_all_content;
// var_dump(file_put_contents($file, $fc_all_content) );
// file_put_contents($file, $fc_shutuba) ;

exit;
?>