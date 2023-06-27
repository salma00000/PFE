<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChatBot;

class ChatbotController extends Controller
{

    public function index()
    {
        return view('ChatBot.liste_chatbot_main');

    }

    public function ouvrir_cree()
    {
        return view('ChatBot.create_chatbot');
    }

    public function create(Request $request)
    {
        $create = ChatBot::create($request->all());

        if($create) return redirect('/liste-chatbot');
        else return redirect('/liste-chatbot');
    }


    public function update(Request $request, int $id)
    {
        $chatbot = ChatBot::find($id);

        $update = $chatbot->update($request->all());

        return redirect('/liste-chatbot');
    }


    public function edit(int $id)
    {
        $chatbot = ChatBot::find($id);

        return  view('ChatBot.edit_chatbot',compact('chatbot'));
    }


    public function delete(int $id)
    {
        $chatbot = ChatBot::find($id);

        $delete = $chatbot->delete();

        return redirect()->back();
    }
}
