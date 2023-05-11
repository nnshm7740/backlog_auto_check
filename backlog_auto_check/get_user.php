<?php
include __DIR__.'/config.php';
$config = new config();

$ch = curl_init();
$headers  = array(
  'Content-Type: application/json',
);

$getData = [
  'apiKey'=> $config->apiKey,
];

curl_setopt($ch, CURLOPT_URL, 'https://'.$config->workspaceID.'.backlog.com/api/v2/projects/'.$config->workspaceID.'/users?'.http_build_query($getData));
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec($ch);
$result_json = json_decode($result, true);


 ?>
<!doctype html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="https://raw.githubusercontent.com/filipelinhares/ress/master/dist/ress.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
<table class="container">
  <tr class="row">
    <th class="col-md-5 border border-dark">ユーザー名</th>
    <th class="col-md-5 border border-dark">ID</th>
  </tr>
  <?php foreach ($result_json as $user) { ?>
    <tr class="row">
      <td class="col-md-5 border border-dark"><?= $user['name'] ?></td>
      <td class="col-md-5 border border-dark"><?= $user['id'] ?></td>
    </tr>
  <?php } ?>
</table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
