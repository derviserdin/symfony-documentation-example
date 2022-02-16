<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 16.02.2022 - 12:56
 * File Name: SiteUpdateManager.php
 */


namespace App\Service;

use App\Service\MessageGenerator;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class SiteUpdateManager
{
    private $messageGenerator;
    private $mailer;
    //Service Yaml $adminEmail
    private $adminEmail;
    public function __construct(MessageGenerator $messageGenerator, MailerInterface $mailer,string $adminEmail)
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function notifyOfSiteUpdate(): bool
    {
        // Random mesajı çağırdık
        $happyMessage = $this->messageGenerator->getHappyMessage();

        $email=(new Email())
            ->from('admin@example.com')
            ->to($this->adminEmail)
            ->subject('Site update just happened!')
            ->text('Someone just updated the site. We told them: '.$happyMessage);

        $this->mailer->send($email);

        return true;
    }
}