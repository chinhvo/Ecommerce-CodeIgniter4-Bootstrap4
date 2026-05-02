<?php

namespace App\Libraries;

use Config\Email;
use PHPMailer\PHPMailer\Exception as PHPMailerException;
use PHPMailer\PHPMailer\PHPMailer;

class SendMail
{

    public $mail;
    private Email $emailConfig;

    public function __construct()
    {
        $this->emailConfig = config('Email');
        $this->mail = new PHPMailer(true);
        $this->mail->CharSet = $this->emailConfig->charset;
        $this->mail->SMTPDebug = (int) env('email.SMTPDebug', 0);
        $this->mail->Debugoutput = 'html';

        if ($this->emailConfig->protocol === 'smtp') {
            $this->mail->isSMTP();
            $this->mail->Host = $this->emailConfig->SMTPHost;
            $this->mail->Port = $this->emailConfig->SMTPPort;
            $this->mail->SMTPSecure = $this->emailConfig->SMTPCrypto;
            $this->mail->SMTPAuth = $this->emailConfig->SMTPUser !== '';
            $this->mail->Username = $this->emailConfig->SMTPUser;
            $this->mail->Password = $this->emailConfig->SMTPPass;
            $this->mail->Timeout = $this->emailConfig->SMTPTimeout;
        }
    }

    public function clearAddresses()
    {
        if (method_exists($this->mail, 'clearAddresses')) {
            $this->mail->clearAddresses();
        }
    }

    public function sendTo($toEmail, $recipientName, $subject, $msg)
    {
        try {
            $this->mail->setFrom($this->emailConfig->fromEmail, $this->emailConfig->fromName);
            $this->mail->addAddress($toEmail, $recipientName);
            $this->mail->isHTML(true);
            $this->mail->Subject = $subject;
            $this->mail->Body = $msg;

            if (!$this->mail->send()) {
                log_message('error', 'Mailer Error: ' . $this->mail->ErrorInfo . ' | to: ' . (string) $toEmail . ' | subject: ' . (string) $subject);
                return false;
            }

            return true;
        } catch (PHPMailerException $e) {
            log_message('error', 'Mailer Exception: ' . $e->getMessage() . ' | to: ' . (string) $toEmail . ' | subject: ' . (string) $subject);
            return false;
        } catch (\Throwable $e) {
            log_message('error', 'Mail Throwable: ' . $e->getMessage() . ' | to: ' . (string) $toEmail . ' | subject: ' . (string) $subject);
            return false;
        }
    }
}
