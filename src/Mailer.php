<?php

namespace Mikewazovzky\Simple;

class Mailer
{
    /**
     * Send message
     * @param string $to
     * @param string $subject
     * @param string $body
     */
    public function send($to, $subj, $body)
    {
        $transport = new \Swift_SmtpTransport(
            config('mail.host'),
            config('mail.port'),
            config('mail.encryption')
        );

        $transport->setUsername(config('mail.username'));
        $transport->setPassword(config('mail.password'));
        $mailer = new \Swift_Mailer($transport);

        $message = (new \Swift_Message())
            ->setSubject($subj)
            ->setFrom([config('mail.address') => config('mail.name')])
            ->setTo($to)
            ->setBody($body);

        return $mailer->send($message);
    }
}
