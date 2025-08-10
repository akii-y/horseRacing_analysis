<?php
// echo mb_internal_encoding() . PHP_EOL;
ob_clean();
// PHP Simple HTML DOM Parser の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\simple_html_dom.php";
// PHPQuery の読み込み
require_once "C:\Apache24\htdocs\Scraping\libs\phpQuery-onefile.php";


// 地方競馬
$array_race_at_tiho = [
     "kouti" => "54", //高知
     "urawa" => "42", //浦和
     "nagoya" => "48", //名古屋
     "himezi" => "51", //姫路
     "sonoda" => "", //園田
     "obihiro" => "64", //帯広
     "monbetu" => "", //門別
     "morioka" => "", //盛岡
     "mizusawa" => "", //水沢
     "船橋" => "", //船橋
     "大井" => "", //大井
     "川崎" => "", //川崎
     "金沢" => "", //金沢
     "笠松" => "", //笠松
     "佐賀" => "", //佐賀
];
$encodings = ["ASCII",];
//出馬表
echo "レース開催地を入力：" . PHP_EOL;

$file_path = "php://stdin";

$fp = fopen("C:\Users\a0k02\Desktop\競馬メモ2.txt", "w");

mb_internal_encoding('UTF-8');
$input = fgets(STDIN, 1024);
// $input = mb_convert_encoding($input, 'UTF-8', 'uto');
echo "入力バイト列: ";
for ($i = 0; $i < strlen($input); $i++) {
    printf("%02X ", ord($input[$i]));
}
echo PHP_EOL;
echo bin2hex($input) . PHP_EOL;


echo "入力文字列: " . $input;

// $fo = fopen('php://stdout', 'w');
// $fe = fopen("C:\Users\a0k02\Desktop\STDINの内容.txt", "w");
// $fp = fopen("C:\Users\a0k02\Desktop\競馬メモ2.txt", "w");


// stream_filter_prepend($fp, 'convert.iconv.cp932/utf-8', STREAM_FILTER_READ);
// $race_at = fgets($fp);  STDIN から 1 行読み込む
// fclose($fp);

// 以下は入力後に改行し,Ctrl+ZでEOFを入力すると入力待ちから抜けられる
// $race_at = file_get_contents("php://stdin");
// fclose($file_path);
// $stdin = fopen('php://stdin', 'r');
// stream_filter_prepend($stdin, 'convert.iconv.ASCII/utf-8', STREAM_FILTER_READ);
// stream_copy_to_stream($stdin, STDOUT);
// 追記したい文字を定義
$addText = '浦和';
// $addText = trim(fgets($fi));

// 書き込み実行
// fwrite($fp, $addText);
// fwrite($fi, $addText);
// stream_copy_to_stream($fp, $fe);

// fclose($fp);
// fclose($fi);
// fclose($fo);
// fclose($fe);

$fp = fopen("C:\Users\a0k02\Desktop\競馬メモ2.txt", "r");
$fi = fopen('php://stdin', 'rb');
$fe = fopen("C:\Users\a0k02\Desktop\STDINの内容.txt", "w");
stream_filter_prepend($fi, 'convert.iconv.utf-8/utf-8', STREAM_FILTER_READ);
stream_filter_prepend($fe, 'convert.iconv.utf-8/utf-8', STREAM_FILTER_READ);


// $fo = fopen('php://stdout', 'w');

// while (!feof($fi)) {
//      // $line = trim(fgets($fp, 999999));
//      $expect = fgets($fp);
//      // stream_copy_to_stream($fp, $fi);
//      // $line = fgets($fi);

//      $a = bin2hex($line);
//      echo $a.PHP_EOL;

//      $detect_code = mb_detect_encoding_php80($line, $encodings);
//      // $endcode_line = mb_convert_encoding($line, "UTF-8", "ASCII");
//      $endcode_line = mb_convert_encoding($line, "UTF-8", $detect_code);
//      echo $endcode_line.PHP_EOL;
//      $b = bin2hex($endcode_line);
//      echo $b.PHP_EOL;
// }

fclose($fp);
fclose($fi);
// fclose($fo);
fclose($fe);

function mb_detect_encoding_php80($string, $encodings)
{
     foreach ($encodings as $encoding) {
          $result = mb_detect_encoding($string, $encoding, true);
          if ($result !== false) {
               return $result;
          }
     }
}

// $race_at_sample = "浦和"; // STDIN から 1 行読み込む
// $race_at = trim(fgets(STDIN)); // STDIN から 1 行読み込む
// fclose($file_path);
// $str = @file_get_contents($file_path);
// $str = @file_get_contents("C:\Users\a0k02\Desktop\競馬メモ2.txt");
// echo $str;
// $stdin = fopen('php://stdin', 'r');

// fscanf($stdin, '%s', $line);
// $detect_code = mb_detect_encoding($line, $encodings, true);
// echo $detect_code . PHP_EOL;
// echo $line . PHP_EOL;




// echo $race_at . PHP_EOL;
// $detect_code_sample = mb_detect_encoding($race_at_sample);
// $endcode_race_at1 = iconv($race_at, 'ISO-8859-1','UTF-8');
// $endcode_race_at2 = mb_convert_encoding($race_at, 'UTF-8', 'ISO-8859-7');
// $detect_code2 = mb_detect_encoding($race_at, $encodings, true);
// $endcode_race_at = mb_convert_encoding($race_at, 'UTF-8', 'ISO-8859-1');

exit;

echo $cf_code . PHP_EOL;


// SJISからUTF-8へのストリームフィルタを登録
// $stream_filter = stream_filter_prepend(fopen($file_path, 'r'), 'convert.iconv.SJIS/UTF-8');
// $content = stream_get_contents($stream_filter);
// $endcode_STDIN = mb_convert_encoding($fp, 'UTF-8', $cf_code);

echo $cf_code . PHP_EOL;
// $endcode_race_at = chr($race_at);
$endcode_race_at2 = iconv($race_at, 'UTF-8', $cf_code);
// $endcode_race_at = iconv($cf_code,'UTF-8',$race_at);
echo $endcode_race_at . PHP_EOL;

exit;

if (!in_array($race_at, array_keys($array_race_at_tiho))) {
     echo "競馬場名が該当するものがありません。" . PHP_EOL;
     exit;
}

echo "開催年(原則今年)を入力：" . PHP_EOL;
$year = trim(fgets(STDIN, 40969)); //どこのレースか入力し、その値を取得
if ((strlen($year)) !== 4) {
     echo "4桁で入力してください" . PHP_EOL;
     $race_id = trim(fgets(STDIN, 40969));
} else {
     // 地方競馬
     echo "入力された年:" . $year . PHP_EOL;
}
echo "月と日を入力：" . PHP_EOL;
$month_and_day = trim(fgets(STDIN, 40969)); //どこのレースか入力し、その値を取得
if ((strlen($month_and_day)) !== 4) {
     echo "4桁で入力してください" . PHP_EOL;
     $race_id = trim(fgets(STDIN, 40969));
} else {
     // 地方競馬
     echo "入力された日付:" . $month_and_day . PHP_EOL;
}

// $race_at1 = "u";
// $race_at2 = "k";
// $race_at3 = "n";

$base_url = "https://nar.netkeiba.com/race/shutuba.html?race_id=";

$url_content_tiho = $base_url . $year . $array_race_at_tiho[$race_at] . $month_and_day;

echo PHP_EOL . "何レース目の出馬表か入力：" . PHP_EOL;
$race_id = trim(fgets(STDIN, 4096));; //何レース目か入力し、その値を取得
if ((strlen($race_id)) !== 2) {
     echo "2桁で入力してください" . PHP_EOL;
     $race_id = trim(fgets(STDIN, 4096));
} else {
     // 地方競馬
     $url_tiho = $url_content_tiho . $race_id;
     $race_id = ltrim($race_id, 0);
     echo $race_id . "R" . PHP_EOL;
}
// URLを指定してオブジェクト化します
// 地方競馬
$html_tiho = file_get_html($url_tiho);

// 全てのタグのうち「class=RaceData01」である要素を配列として取得
$Courses_arr_shutuba = $html_tiho->find("div[class=RaceData01]");
//配列$Jockey_arrの各要素を$valueに代入し、テキスト部分を抽出。
foreach ($Courses_arr_shutuba as $value) {
     $Plaintext_Courses_arr = explode(" / ", (trim($value->plaintext)));
     $Plaintext_CDistance = $Plaintext_Courses_arr[1];
     echo $Plaintext_CDistance . PHP_EOL;
}

// 全てのタグのうち「class=Jockey」である要素を配列として取得
$Jockey_arr_shutuba = $html_tiho->find("td[class=Jockey]");

//配列$Jockey_arrの各要素からテキスト部分を抽出。
for ($counter = 0; $counter <= 15; $counter++) {
     // 末尾の「u」はpreg_match関数のパラメータ認識のオプション→取得した文字列の文字化けを防ぐ
     $pattern = '/[^\x01-\x7E]{3}/u';
     // $plainvalueという「配列」に正規表現にマッチした文字列が入り、インデックス[0]のバリューにループごとに上書きされる。
     preg_match($pattern, (trim($Jockey_arr_shutuba[$counter]->plaintext)), $plainvalue);
     // 上書きされた$plainvalue[0]を表示
     echo $plainvalue[0] . PHP_EOL;
     if ($counter == 15) {
          echo PHP_EOL . PHP_EOL;
     }
}

exit;
