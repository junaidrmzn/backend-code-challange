<?php

declare(strict_types=1);

namespace App\Tests\Message;

use App\Entity\Message;
use App\Message\SendMessage;
use App\Message\SendMessageHandler;
use Doctrine\ORM\EntityManagerInterface;
use PHPUnit\Framework\TestCase;

class SendMessageHandlerTest extends TestCase
{
    public function testHandleSendMessage(): void
    {
        // Mock the EntityManager
        $entityManager = $this->createMock(EntityManagerInterface::class);

        // Expect the EntityManager to persist and flush a Message entity
        $entityManager
            ->expects($this->once())
            ->method('persist')
            ->with($this->callback(function (Message $message) {
                return $message->getText() === 'Test message'
                    && $message->getStatus() === 'sent'
                    && $message->getUuid() !== null
                    && $message->getCreatedAt() instanceof \DateTime;
            }));

        $entityManager
            ->expects($this->once())
            ->method('flush');

        // Instantiate the handler
        $handler = new SendMessageHandler($entityManager);

        // Create a SendMessage instance with the required text parameter
        $sendMessage = new SendMessage('Test message');

        // Invoke the handler
        $handler($sendMessage);
    }
}
