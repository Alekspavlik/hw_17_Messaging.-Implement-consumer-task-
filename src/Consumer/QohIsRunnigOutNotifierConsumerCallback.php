<?php

declare(strict_types=1);

namespace App\Consumer;

use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class QohIsRunnigOutNotifierConsumerCallback implements ConsumerInterface
{
    public function execute(AMQPMessage $msg)
    {
        $data = json_decode($msg->getBody(), true);
        $qoh = implode($data['values']);
        if ($qoh < 5) {
            $message = $msg->getBody();
            $subject = 'Important information';
            mail("stock@example.com", $subject, $message);
        }
        return ConsumerInterface::MSG_ACK;
    }
}
