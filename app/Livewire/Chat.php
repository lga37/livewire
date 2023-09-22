<?php

namespace App\Livewire;

use Exception;
use GuzzleHttp\Client;
use Livewire\Component;
use Livewire\Attributes\Layout;

class Chat extends Component
{

    public $msg;

    public $resp;

    public function ask()
    {

        #dd($this->msg);
        #$message = $request->input('message');
        #$message = $request->input('message');


        $client = new Client();


        try{
            $response = $client->post('https://api.openai.com/v1/chat/completions', [
                'headers' => [
                    'Content-Type' => 'application/json',
                    'Authorization' => 'Bearer ' . env('CHATGPT'),
                ],
                'json' => [
                    "model" => "gpt-3.5-turbo",
                    "messages" => json_decode('[{"role": "user", "content": "' . $this->msg . '"}]', true),
                    "temperature" => 0.7
                ],
            ]);
            $result = json_decode($response->getBody()->getContents(), true);
            $resp = response()->json($result['choices'][0]['message']['content']);

        } catch(Exception $e){
            $resp = $e->getMessage();
        }

        $this->resp = $resp;

    }


    #[Layout('layouts.app')]
    public function render()
    {
        return view('livewire.chat');
    }
}
