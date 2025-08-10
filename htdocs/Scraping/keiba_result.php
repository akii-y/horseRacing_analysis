<?php
// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";

//レース結果4位以内騎手取得
//中央競馬
function extract_tfjockeys($html) {
     $Jockey_arr = $html->find("td[class=Jockey] a");
     // 配列$tiho_Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
          $add_jockey_arr = [];
          // 全てのタグのうち「class=Jockey」である要素を配列として取得
          $Jockey_arr = $html->find("[class=Jockey]");
          //配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
          foreach($Jockey_arr as $value){
          $add_jockey_arr[] = trim($value -> plaintext);
          // print_r ($add_jockey_arr); 
          }
         // ファイル書き込み用配列<レース結果>
          //↓の23・29・30行目は未実装につきコメントアウト
          // $fc_result = array();
          for ($arr_count = 0; $arr_count < 4; $arr_count++ ){
               //上位4位の騎手出力
               echo $add_jockey_arr[$arr_count].PHP_EOL;
               //ファイルに書き込むデータとして格納
               // array_push($fc_result, $add_jockey_arr[$arr_count].PHP_EOL);
               // return $fc_result;
          }
}

// 中央競馬
$race_id_head = 0;
$race_at1 = "n";
$race_at2 = "h";
$race_at3 = "k";

echo PHP_EOL."レース開催地を入力：".PHP_EOL;
$race_at = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得

if($race_at === $race_at1 ){
// 中山-土曜日
// $url_content = "https://race.netkeiba.com/race/result.html?race_id=2023060201";
// 中山-日曜日
$url_content = "https://race.netkeiba.com/race/result.html?race_id=2023060202";
}
elseif($race_at === $race_at2){
// 阪神-土曜日
// $url_content = "https://race.netkeiba.com/race/result.html?race_id=2023090105";
// 阪神-日曜日
$url_content = "https://race.netkeiba.com/race/result.html?race_id=2023090106";
}
elseif($race_at === $race_at3){
// 小倉-土曜日
// $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2023100205";
// 小倉-日曜日
$url_content = "https://race.netkeiba.com\/race/result.html?race_id=2023100106";
}

for ($result_race_id = 1; $result_race_id < 13; $result_race_id++ ){
     if($result_race_id < 10){
          if($race_at === $race_at1 ){
               // 東京
               $url1= $url_content.$race_id_head.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url1);
               extract_tfjockeys($html);
               // sleep(3);
          }
          elseif($race_at === $race_at2){
               // 阪神
               $url2= $url_content.$race_id_head.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url2);
               extract_tfjockeys($html);
               // sleep(3);
          }
          elseif($race_at === $race_at3){
               // 新潟
               $url3= $url_content.$race_id_head.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url3);
               extract_tfjockeys($html);
               // sleep(3);
          }
     }
     elseif($result_race_id >= 10){
          if($race_at === $race_at1 ){
               // 東京
               $url1= $url_content.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url1);
               extract_tfjockeys($html);
               // sleep(3);
          }
          elseif($race_at === $race_at2){
               // 阪神
               $url2= $url_content.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url2);
               extract_tfjockeys($html);
               // sleep(3);
          }
          elseif($race_at === $race_at3){
               // 新潟
               $url3= $url_content.$result_race_id;
               // URLを指定してオブジェクト化します
               $html = file_get_html($url3);
               extract_tfjockeys($html);
               // sleep(3);
          }
     }
     else{
          echo "レース開催地の入力が適切ではありません。";
          exit;     
     }
}
exit;
?>