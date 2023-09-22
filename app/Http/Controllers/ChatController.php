<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function chat(Request $request)
    {
        $message = $request->input('message');

        $client = new Client();
        $response = $client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer ' . env('CHATGPT'),
            ],
            'json' => [
                "model" => "gpt-3.5-turbo",
                "messages" => json_decode('[{"role": "user", "content": "' . $message . '"}]', true),
                "temperature" => 0.7
            ],
        ]);
        $result = json_decode($response->getBody()->getContents(), true);
        return response()->json($result['choices'][0]['message']['content']);
    }

    function ask(){
        return 'aaa';
    }


}
