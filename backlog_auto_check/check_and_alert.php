<?php
include __DIR__.'/config.php';
$config = new config();

$ch = curl_init();
$headers  = array(
  'Content-Type: application/json',
);

$getData = [
  'apiKey'=> $config->apiKey,
  'count'=> 100,
  'assigneeId' => $config->alert_users
];

curl_setopt($ch, CURLOPT_URL, 'https://'.$config->workspaceID.'.backlog.com/api/v2/issues?'.http_build_query($getData));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result_json = json_decode($result, true);

$to = $config->mail_to;
$subject = 'バックログ 自動通知システム';
$message = '';
$additional_headers = 'From:' .mb_encode_mimeheader('バックログ 自動通知システム') .'<'.$config->mail_from.'>';
$additional_headers .= "\r\n";
$additional_headers .= "Content-type: text/html; charset=UTF-8";
$notCompatible_count = 0;

// 本文にメッセージをセット
foreach ($result_json as $item){
  if ($item['status']['name'] === '完了')continue;

  $url = 'https://hkh.backlog.com/view/'.$item['issueKey'];
  $message .= '課題番号：'.$item['issueKey']."<br>";
  $message .= 'URL：<a href="'.$url.'">'.$url.'</a>'."<br>";
  $message .= '対応状況：'.$item['status']['name']."<br>";
  $message .= '担当者：'.$item['assignee']['name']."<br>";
  $message .= "<br>";

  if ($item['status']['name'] === '未対応') ++$notCompatible_count;
}

// 課題数に応じて件名・本文を変更
if ( $notCompatible_count === 0){
  $message = '現在、担当課題はありません';
}
else {
  $subject .= $notCompatible_count.'件の未対応課題があります';
}

// 普通にアクセスしたときはメール送信内容をecho
echo 'to：'.$to."<br>";
echo 'subject：'.$subject."<br>";
echo 'message：'.$message."<br>";
echo 'additional_headers：'.$additional_headers."<br>" ;

// メール送信
mb_send_mail($to, $subject, $message, $additional_headers);



