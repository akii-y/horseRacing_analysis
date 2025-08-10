<?php
echo "日本語で何か入力してEnterしてや\n";

// 入力の生データを取得（STDIN = 標準入力）
$input = stream_get_contents(STDIN);

// 入力された生データをバイナリ16進数で表示（デバッグ用）
$hex = unpack('H*', $input)[1];
echo "【Raw Hex】：$hex\n";

// 入力文字列も表示（文字化けしてるかどうか確認）
echo "【そのまま表示】：$input\n";
?>
