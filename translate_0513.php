<?php
ini_set("user_agent", "Mozilla/5.0 (Windows;+U; Windows+NT+5.2; zh-CN; rv:1.9.0.10) Gecko/2009042316 Firefox/3.0.10");

function c2e($source){
  $source = str_ireplace(" ","%20",$source);
  $source = iconv("UTF-8","big5",$source);
  $url = "http://translate.google.com.tw/translate_a/t?client=t&text=".$source."&hl=zh-TW&sl=zh-CN&tl=en&multires=1&otf=2&ssel=0&tsel=0&sc=1";
  $result = get($url);
  return $result;
}
function e2c($source){
  $source = str_ireplace(" ","%20",$source);
  $source = iconv("UTF-8","big5",$source);
  $url = "http://translate.google.com.tw/translate_a/t?client=t&text=".$source."&hl=zh-TW&sl=en&tl=zh-TW&multires=1&prev=conf&psl=auto&ptl=zh-CN&otf=1&rom=1&it=sel.5439%2Ctgtd.1587&ssel=4&tsel=4&uptl=zh-TW&sc=1";
  $result = get($url);
  return $result;
}
function get($url){
  $result = file_get_contents($url);
  $result = str_replace(",,,,",",",$result);
  $result = str_replace(",,,",",",$result);
  $result = str_replace(",,",",",$result);
  $result = json_decode($result);
  $result = $result[0][0][0];
  return $result;
}

$source = trim($argv[1]);

$r_ch = e2c($source);
$r_en = c2e($source);

echo "CH: {$r_ch}\r\n";
echo "EN: {$r_en}";


?>