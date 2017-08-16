<?php
$access_token = "P9FfTcel7HVhdADoq7F3uExmCFaIguyGUW0oy5l/DFUTXx0NTFjbm6C2LPaiE274Sa5BIdTAi17Gz1QC/BpYB939lTFCmp+sJH+E38BUPaQtyfZiVCjhDAQcwSwQ+TjsbEK08ykS1RJ1PtQOftGsZwdB04t89/1O/w1cDnyilFU=";

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
  // Loop through each event
  foreach ($events['events'] as $event) {
    // Reply only when message sent is in 'text' format
    if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
      // Get text sent
      $text = $event['message']['text'];
      // Get replyToken
      $replyToken = $event['replyToken'];
      $userId = $event['source']['userId'];
      $id = $event['message']['id'];
      // Build message to reply back
      $messages = [
        'type' => 'text',
        'text' => $message,
      ];

      // Make a POST Request to Messaging API to reply to sender
      $url = 'https://api.line.me/v2/bot/message/reply';
      $data = [
        'replyToken' => $replyToken,
        'messages' => [$messages],
      ];




      
      $post = json_encode($data);
      $headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);


"type": "ເມນູ",
  "altText": "ລາຍການ",
  "template": {
      "type": "buttons",
      "thumbnailImageUrl": "http://i68.tinypic.com/358ui5g.png",
      "title": "ລາຍການທີ 1",
      "text": "ກະລຸນາເລືອກລາຍການ",
      "actions": [
          {
            "type": "postback",
            "label": "ຖ້ຽວບິນພາຍໃນ",
            "data": "action=buy&itemid=123"
          },
          {
            "type": "postback",
            "label": "ຖ້ຽວບິນຕ່າງປະເທດ",
            "data": "action=add&itemid=123"
          },
          {
            "type": "uri",
            "label": "View detail",
            "uri": "http://example.com/page/123"
          }
      ]
  }
}










      $ch = curl_init($url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      $result = curl_exec($ch);
      curl_close($ch);

      echo $result . "\r\n";
    }
  }
}
echo "OK";
?>

