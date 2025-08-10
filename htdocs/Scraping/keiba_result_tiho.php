<?php
// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";

//レース結果4位以内騎手取得
//地方競馬
function extract_tfjockeys($html) {
     // $result = ($html_tiho->find("a[target]",5)->plaintext);
     // $tiho_Jockey_arr = $html_tiho->find("td a[target=_blank]");
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

//直近レース結果のURL(フォント：メイリオ)指定は↓（文字化け回避）
// $race_idが10以下の場合、頭文字に0をつける

// //地方競馬
$race_id_head = 0;
$race_at1 = "o";
$race_at2 = "k";
$race_at3 = "f";

echo PHP_EOL."レース開催地を入力：".PHP_EOL;
 $race_at = trim(fgets(STDIN, 40969));//どこのレースか入力し、その値を取得
echo $race_id.PHP_EOL;
// $race_at1の入力⇒$url_content1の値を使用。
//  大井
$url_content1 = "https://nar.netkeiba.com/race/result.html?race_id=2021441103";
//  名古屋
// $url_content1 = "https://nar.netkeiba.com/race/result.html?race_id=2022481123";

// $race_at2の入力⇒$url_content2の値を使用。
// 高知
$url_content2 = "https://nar.netkeiba.com/race/result.html?race_id=2023540416";
// 園田
// $url_content2 = "https://nar.netkeiba.com/race/result.html?race_id=2021501123";

// $race_at3の入力⇒$url_content3の値を使用。
//　船橋
$url_content3 = "https://nar.netkeiba.com/race/result.html?race_id=2022431219";
// 川崎
// $url_content3 = "https://nar.netkeiba.com/race/result.html?race_id=2021451215";



 for ($result_race_id = 1; $result_race_id < 13; $result_race_id++ ){
      if($result_race_id < 10){
           if($race_at === $race_at1 ){
                // 大井
                $url1= $url_content1.$race_id_head.$result_race_id;
                // URLを指定してオブジェクト化します
                $html_tiho = file_get_html($url1);
                extract_tfjockeys($html_tiho);
                // sleep(3);
           }
           elseif($race_at === $race_at2){
                // 園田
                $url2= $url_content2.$race_id_head.$result_race_id;
                // URLを指定してオブジェクト化します
                $html_tiho = file_get_html($url2);
                extract_tfjockeys($html_tiho);
                // sleep(3);
           }
           elseif($race_at === $race_at3){
               // 船橋
               $url3= $url_content3.$race_id_head.$result_race_id;
               // URLを指定してオブジェクト化します
               $html_tiho = file_get_html($url3);
               extract_tfjockeys($html_tiho);
               // sleep(3);
          }
     }
      elseif($result_race_id >= 10){
           if($race_at === $race_at1 ){
                // 大井
                $url1= $url_content1.$result_race_id;
                // URLを指定してオブジェクト化します
                $html_tiho = file_get_html($url1);
                extract_tfjockeys($html_tiho);
                // sleep(3);
           }
           elseif($race_at === $race_at2){
                // 園田
                $url2= $url_content2.$result_race_id;
                // URLを指定してオブジェクト化します
                $html_tiho = file_get_html($url2);
                extract_tfjockeys($html_tiho);
                // sleep(3);
           }
           elseif($race_at === $race_at3){
               // 船橋
               $url3= $url_content3.$result_race_id;
               // URLを指定してオブジェクト化します
               $html_tiho = file_get_html($url3);
               extract_tfjockeys($html_tiho);
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