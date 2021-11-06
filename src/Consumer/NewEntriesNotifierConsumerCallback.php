<?php

declare(strict_types=1);

namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class NewEntriesNotifierConsumerCallback implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
                $message = $msg->getBody();
                $subject = 'Important information';
                mail("stock@example.com", $subject, $message);

        return ConsumerInterface::MSG_ACK;
    }
}
