<?php
namespace App\Service;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class Mail
{

    private $mailer;
    public function __construct(MailerInterface $mailer)
    {
        $this->mailer=$mailer;
    }

    public function sendEmail(string $from, string $to, string $subject, string $text,string $token): void
    {
        $email = (new TemplatedEmail())
            ->from($from)
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
            ->text($text)
            ->htmlTemplate('mailer/index.html.twig')
            ->context([
                'expiration_date' =>new \DateTime('+7 days'),
                'token' => $token
            ]);
            

        $this->mailer->send($email);

        // ...
    }
}
