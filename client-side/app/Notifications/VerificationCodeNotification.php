<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class VerificationCodeNotification extends Notification
{
    use Queueable;
    protected $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function via($notifiable)
    {
        return ['mail']; //確保email是啟用的通道 ['sms'] 可以用簡訊
    }

    public function toMail($notifiable)
    {
      
        return (new MailMessage)
        ->subject('您的註冊驗證碼')
        ->view('emails.verification-code', ['code' => $this->verificationCode]); // ✅ 改用自訂模板
    }
}
