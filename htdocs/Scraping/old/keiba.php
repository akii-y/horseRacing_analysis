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
$race_at3 = "c";

echo PHP_EOL."レース開催地を入力：".PHP_EOL;
$race_at = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得

// 東京-土曜日
// $url_content1 = "https://race.netkeiba.com/race/result.html?race_id=2022060308";
// 東京-日曜日
$url_content = "https://race.netkeiba.com/race/result.html?race_id=2022060308";
// 阪神-土曜日
// $url_content = "https://race.netkeiba.com/race/result.html?race_id=2022090208";
// 阪神-日曜日
$url_content2 = "https://race.netkeiba.com/race/result.html?race_id=2022090208";
// 小倉-土曜日
// $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2021070605";
// 小倉-日曜日
// $url_content = "https://race.netkeiba.com\/race/result.html?race_id=202107060";

// for ($result_race_id = 1; $result_race_id < 13; $result_race_id++ ){
//      if($result_race_id < 10){
//           if($race_at === $race_at1 ){
//                // 東京
//                $url1= $url_content1.$race_id_head.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url1);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//           elseif($race_at === $race_at2){
//                // 阪神
//                $url2= $url_content2.$race_id_head.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url2);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//           elseif($race_at === $race_at3){
//                // 新潟
//                $url3= $url_content2.$race_id_head.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url3);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//      }
//      elseif($result_race_id >= 10){
//           if($race_at === $race_at1 ){
//                // 東京
//                $url1= $url_content1.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url1);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//           elseif($race_at === $race_at2){
//                // 阪神
//                $url2= $url_content2.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url2);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//           elseif($race_at === $race_at3){
//                // 新潟
//                $url3= $url_content2.$result_race_id;
//                // URLを指定してオブジェクト化します
//                $html = file_get_html($url3);
//                extract_tfjockeys($html);
//                // sleep(3);
//           }
//      }
//      else{
//           echo "レース開催地の入力が適切ではありません。";
//           exit;     
//      }
// }

// 中央競馬
// 出馬表
// ※$race_at, $race_at1・2はレース結果のものを使いまわし

if($race_at === $race_at1 ){
     // 東京-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022050101";
     // 東京-日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022060308";
     // 東京-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2021060405";
}
elseif($race_at === $race_at2){
     // 阪神-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022070109";
     // 阪神-日曜日
     $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022090208";
     // 中京-月曜
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2021070505";
}
elseif($race_at === $race_at3){
     // 小倉-土曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022100105";
     // 小倉-日曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2022100106";
     // 小倉-月曜日
     // $url_content = "https://race.netkeiba.com/race/shutuba.html?race_id=2021030202";
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
     echo $race_id.PHP_EOL;
}
// URLを指定してオブジェクト化します
// 中央競馬
$html = file_get_html($url);

// 全てのタグのうち「class=Jockey」である要素を配列として取得
$Jockey_arr_shutuba = $html->find("td[class=Jockey]");
//配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
foreach($Jockey_arr_shutuba as $value){
    echo trim(($value -> plaintext)).PHP_EOL;
    $fc_shutuba[] = trim(($value -> plaintext)).PHP_EOL; 
   }


// ファイル出力
// $fc_all_content =  array_merge($fc_shutuba, $fc_result);
// $file = 'C:\Apache24\htdocs\Scraping\result_data.txt';
// echo $fc_all_content;
// var_dump(file_put_contents($file, $fc_all_content) );
// var_dump(file_put_contents($file, $fc_shutuba) );

exit;
?>