<?php

namespace Mailing\Consumers;

use Kdyby\RabbitMq\Producer;
use Nette\Utils\Json;

class MailProducer
{
    /** @var Producer */
    protected $producer;

    protected function produce()
    {
        $message = Json::encode(['userId' => 1]);

        $this->producer->publish($message);
    }
}