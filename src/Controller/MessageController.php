<?php
declare(strict_types=1);

namespace App\Controller;

use App\Message\SendMessage;
use App\Repository\MessageRepository;
use Controller\MessageControllerTest;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Attribute\Route;

/**
 * @see MessageControllerTest
 * TODO: review both methods and also the `openapi.yaml` specification
 *       Add Comments for your Code-Review, so that the developer can understand why changes are needed.
 */
class MessageController extends AbstractController
{
    /**
     * TODO: cover this method with tests, and refactor the code (including other files that need to be refactored)
     */
    #[Route('/messages')]
    public function list(Request $request, MessageRepository $messages): Response
    {
        $messages = $messages->by($request);
        /** Code-Review: Use array_map (a dedicated method to transform the data) for better readability and efficiency */

        $messages = array_map(static function ($message) {
            return [
                'uuid' => $message->getUuid(),
                'text' => $message->getText(),
                'status' => $message->getStatus(),
            ];
        }, $messages);
        /** Code-Review: Use JsonResponse for better handling of JSON responses. e.g JsonResponse(['messages' => $messages]); */

        return new Response(json_encode([
            'messages' => $messages,
        ], JSON_THROW_ON_ERROR), headers: ['Content-Type' => 'application/json']);
    }

    /** Code-Review: [GET] method is intended for retrieval.Change the HTTP method to [POST] */
    #[Route('/messages/send', methods: ['GET'])]
    public function send(Request $request, MessageBusInterface $bus): Response
    {
        /** Code-Review: use post request data after changing method to [POST]. e.g request->request->get */
        $text = (string) $request->query->get('text');
        
        if (!$text) {
            return new Response('Text is required', 400);
        }

        /** Code-Review: No exception handling here. The dispatch call assumes everything will succeed. use try, catch */
        $bus->dispatch(new SendMessage($text));
        
        /** Code-Review: 204 is used for "No Content". Use 200 for success responses that has content. */
        return new Response('Successfully sent', 204);
    }
}