<?php

class config{
  // APIキーを取得し設定
  public string $apiKey = 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx';

  // 取得したいワークスペースのIDを設定
  //https://xxx.backlog.com/projects/〇〇〇
  //urlのxxxの部分
  public string $workspaceID = 'xxx';

  // 取得したいプロジェクトのIDを設定
  //https://xxx.backlog.com/projects/〇〇〇
  //urlの〇〇〇の部分
  public string $projectID = '〇〇〇';

  // 通知するユーザーのID
  public array $alert_users = [
    000000,// カンマ区切りで通知したいユーザーのIDを設定
  ];

  // 通知先アドレス
  public string $mail_to = 'test@redkirin.co.jp';

  // 送信元先アドレス
  public string $mail_from = 'test@redkirin.co.jp';
}