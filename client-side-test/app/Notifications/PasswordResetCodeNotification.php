<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PasswordResetCodeNotification extends Notification
{
    use Queueable;
    protected $verificationCode;

    public function __construct($verificationCode)
    {
        $this->verificationCode = $verificationCode;
    }

    public function via($notifiable)
    {
        return ['mail']; // 使用 Email 來寄送通知
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->subject('您的密碼重設驗證碼')
        ->view('emails.password-reset', ['code' => $this->verificationCode]); // ✅ 使用自訂模板
    }
}