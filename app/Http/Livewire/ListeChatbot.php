<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ChatBot;

class ListeChatbot extends Component
{
    public function render()
    {
        $chatbot = ChatBot::all();

        return view('livewire.liste-chatbot',compact('chatbot'));
    }
}
