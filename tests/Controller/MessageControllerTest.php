<?php
declare(strict_types=1);

namespace Controller;

use App\Message\SendMessage;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Zenstruck\Messenger\Test\InteractsWithMessenger;

class MessageControllerTest extends WebTestCase
{
    use InteractsWithMessenger;

    // function test_list(): void
    // {
    //     $this->markTestIncomplete('the Controller-Action needs tests');
    // }

    function test_list(): void
    {
        $client = static::createClient();
        $client->request('GET', '/messages');
        $this->assertResponseIsSuccessful();
        $content = $client->getResponse()->getContent();
        // Ensure $content is a valid string
        $this->assertNotFalse($content, 'The response content should not be false.');
        $this->assertJson($content);
    }

    function test_that_it_sends_a_message(): void
    {
        $client = static::createClient();
        $client->request('GET', '/messages/send', [
            'text' => 'Hello World',
        ]);

        $this->assertResponseIsSuccessful();
        // This is using https://packagist.org/packages/zenstruck/messenger-test
        $this->transport('sync')
            ->queue()
            ->assertContains(SendMessage::class, 1);
    }
}