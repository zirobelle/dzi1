<?php
02.
$access_token = 'P9FfTcel7HVhdADoq7F3uExmCFaIguyGUW0oy5l/DFUTXx0NTFjbm6C2LPaiE274Sa5BIdTAi17Gz1QC/BpYB939lTFCmp+sJH+E38BUPaQtyfZiVCjhDAQcwSwQ+TjsbEK08ykS1RJ1PtQOftGsZwdB04t89/1O/w1cDnyilFU=';
03.
 
04.
// Get POST body content
05.
$content = file_get_contents('php://input');
06.
// Parse JSON
07.
$events = json_decode($content, true);
08.
// Validate parsed JSON data
09.
if (!is_null($events['events'])) {
10.
// Loop through each event
11.
foreach ($events['events'] as $event) {
12.
// Reply only when message sent is in 'text' format
13.
if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
14.
// Get text sent
15.
$text = $event['message']['text'];
16.
// Get replyToken
17.
$replyToken = $event['replyToken'];
18.
$userId = $event['source']['userId'];
19.
$id = $event['message']['id'];
20.
// Build message to reply back
21.
$messages = [
22.
'type' => 'text',
23.
'text' => $id,
24.
];
25.
 
26.
// Make a POST Request to Messaging API to reply to sender
27.
$url = 'https://api.line.me/v2/bot/message/reply';
28.
$data = [
29.
'replyToken' => $replyToken,
30.
'messages' => [$messages],
31.
];
32.
$post = json_encode($data);
33.
$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);
34.
 
35.
$ch = curl_init($url);
36.
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
37.
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
38.
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
39.
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
40.
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
41.
$result = curl_exec($ch);
42.
curl_close($ch);
43.
 
44.
echo $result . "\r\n";
45.
}
46.
}
47.
}
48.
echo "OK";
49.
?>
