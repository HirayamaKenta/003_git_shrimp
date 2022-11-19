<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewVerifyEmail extends VerifyEmail
{
  protected function buildMailMessage($url)
  {
    return (new MailMessage)
      ->subject('メールアドレスの確認')
      ->line('ご登録ありがとうございます。')
      ->action('このボタンをクリック', $url)
      ->line('上記ボタンをクリックすると、ご登録が完了します！');
  }
}