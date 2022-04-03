<?php

namespace Src\Http\Controllers;

use TelegramBot\Api\BotApi;
use TelegramBot\Api\Client;
use TelegramBot\Api\Exception;
use TelegramBot\Api\InvalidArgumentException;
use TelegramBot\Api\InvalidJsonException;
use TelegramBot\Api\Types\Update;

class BotController extends BaseController
{
    /**
     * @throws Exception
     * @throws InvalidArgumentException
     */
    public function test()
    {
        $token = '5229450435:AAFz06kxC0U5Ti8OBNFTtbczXi78O3KoioU';

        $mess = new BotApi($token);
        $bot = new Client($token);

        $bot->command('start', function ($message) use ($mess) {
            $answer = 'Добро пожаловать!';
            $mess->sendMessage($message->getChat()->getId(), $answer);
        });
    }

    /**
     * @throws InvalidJsonException
     * @throws Exception
     */
    public function testClient()
    {
        $token = '5229450435:AAFz06kxC0U5Ti8OBNFTtbczXi78O3KoioU';

        $bot = new Client($token);

        //Handle /ping command
        $bot->command('ping', function ($message) use ($bot) {
            $bot->sendMessage($message->getChat()->getId(), 'pong!');
        });

        //Handle text messages
        $bot->on(function (Update $update) use ($bot) {
            $message = $update->getMessage();
            $id = $message->getChat()->getId();
            $bot->sendMessage($id, 'Your message: ' . $message->getText());
        }, function () {
            return true;
        });

        $bot->run();
    }
}
