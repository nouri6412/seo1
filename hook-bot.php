<?php
$str=file_get_contents("php://input");
$myfile = fopen("hook-bot.txt", "w") or die("Unable to open file!");
fwrite($myfile, $str);
fclose($myfile);

$update = json_decode($str, TRUE,512,JSON_UNESCAPED_UNICODE);

$obj = new MyTmpTelegramBot();

$obj->message($update);