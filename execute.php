<?php
$content = file_get_contents("php://input");
$update = json_decode($content, true);

if(!$update)
{
  exit;
}

$message = isset($update['message']) ? $update['message'] : "";
$messageId = isset($message['message_id']) ? $message['message_id'] : "";
$chatId = isset($message['chat']['id']) ? $message['chat']['id'] : "";
$firstname = isset($message['chat']['first_name']) ? $message['chat']['first_name'] : "";
$lastname = isset($message['chat']['last_name']) ? $message['chat']['last_name'] : "";
$username = isset($message['chat']['username']) ? $message['chat']['username'] : "";
$date = isset($message['date']) ? $message['date'] : "";
$text = isset($message['text']) ? $message['text'] : "";

$text = trim($text);
$text = strtolower($text);

$response = "";

date_default_timezone_set('Europe/Rome');

$time = (string)date('H:i');
$date = (string)date("d/m/y");

if(strpos($text, "/orario") === 0)
{
	$response = " Sono le ore $time" ;
}
elseif(strpos($text, "/data") === 0)
{
	$response = " Sono le ore $date" ;
}
elseif(strpos($text, "/infogruppo") === 0)
{
	$response = "Questo messaggio è per chi si  sta approcciando o si è appena approcciato a HA, ecco alcuni link che vi saranno utili:\nhttps://www.home-assistant.io/\nhttps://www.itchsblog.it/\nhttps://www.vincenzocaputo.com/\nhttps://www.youtube.com/channel/UC-_QPzJhqFr1p5oNljRPRDA\nhttps://www.topdigamma.it/\nhttps://community.home-assistant.io/\nhttps://www.reddit.com/r/homeassistant/\nQuesto è il gruppo facebook: https://www.facebook.com/groups/950587105117248/\nSe volete potete usare questa sintassi così non dovete scrivere tutta la parola ogni volta\nGHM= Google Home Mini\nGH= Google Home\nGA= Google Assistant\nHA= Home Assistant\nhttps://docs.google.com/spreadsheets/d/1Uz4qpKliFS8H8Nj0jADZlwHesEdbLQLfbuKmcTGmjpE/edit?usp=drivesdk" ;
}

header("Content-Type: application/json");
$parameters = array('chat_id' => $chatId, "text" => $response);
$parameters["method"] = "sendMessage";
echo json_encode($parameters);
?>
