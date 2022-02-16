<?php
/**
 * Created by Dervish
 * Project Name: symfony-documentation-example
 * Date: 16.02.2022 - 12:20
 * File Name: MessageGenerator.php
 */

namespace App\Service;
use Psr\Log\LoggerInterface;

class MessageGenerator
{

    private $logger;
    private $mailer;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getHappyMessage(): string
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];

        $index = array_rand($messages);
        $this->logger->info("deneme");
        return $messages[$index];
    }


}