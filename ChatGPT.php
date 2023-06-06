<?php

require __DIR__ . '/vendor/autoload.php';

use Discord\Discord;
use Discord\Parts\Embed\Embed;
use Orhanerday\OpenAi\OpenAi;

try {
    $discord = new Discord([
        'token' => 'your token',
    ]);

    $discord->on('ready', function ($discord) {
        echo "Bot Active" . PHP_EOL;

        $discord->on('message', function ($message, $discord) {
            if ($message->author->id != $discord->id) {
                $content = $message->content;
                if (str_starts_with($content, "!ai")) {
                    $response = request_chat_gpt_api($content);
                    $embed = new Embed($discord);
                    $embed->setTitle('ChatGPT Bot');
                    $embed->setDescription($response);
                    $embed->setColor("#7289DA");
                    $message->channel->sendMessage('', false, $embed);
                }
            }
        });
    });

    function request_chat_gpt_api($message)
    {
        $open_ai_key = "your key";
        $open_ai = new OpenAi($open_ai_key);

        $chat = $open_ai->chat([
            'model' => 'gpt-3.5-turbo-0301',
            'messages' => [
                [
                    "role" => "user",
                    "content" => $message
                ],
            ],
            'temperature' => 1.0,
            'max_tokens' => 4000,
            'frequency_penalty' => 0,
            'presence_penalty' => 0,
        ]);
        $response = json_decode($chat, true);
        return $response["choices"][0]["message"]["content"] ?? "null response";
    }

    $discord->run();
} catch (Throwable $th) {
    echo $th->getMessage();
}