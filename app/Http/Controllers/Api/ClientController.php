<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Models\ClientProduct;
use App\Models\ChatBot;
use App\Http\Controllers\Controller;
use App\Models\Formulaire;


class ClientController extends Controller
{

    public function chatbot()
    {
        $chatbot = ChatBot::all();

        return response()->json($chatbot, 200);
    }

    public function products()
    {
       if(!auth()->check()) return abort(403);

       $products = ClientProduct::withOnly('ProductDetails')->where('id_user','=',auth('sanctum')->user()->id_user)->get();

       $listProducts = [];


       foreach($products as $product)
       {
            $element = $product['ProductDetails'];


            if(sizeof($listProducts) > 0) $listProducts[] = $element;

            else $listProducts[0] = $element;
       }

       if($products)
            return response()->json($listProducts,200);
        else
            return response()->json(['status'=>'error'],500);

    }


    public function send_form(Request $request)
    {

        if(!auth('sanctum')->check()) return abort(403);

        $data = $request->all();

        if($request->has('photo_probleme'))
        {
            $filename = time().$request->file('photo_probleme')->getClientOriginalName();

            $path = $request->file->move('problems', $filename);

            $data['photo_probleme'] = $path;


        }

        $data['id_client'] = auth('sanctum')->user()->id_user;

        $create = Formulaire::create($data);

        if($create)
            return response()->json(['status'=>'success','message' => $data],200);
        else
            return response()->json(['status'=>'error'],500);
    }


    public function forms()
    {
        if(!auth('api')->check()) return abort(403);

        $forms = Formulaire::where('id_user','=',auth('api')->user()->id);

        if($forms)
            return response()->json(['status'=>'success','formulaire'=>$forms],200);
        else
            return response()->json(['status'=>'error'],500);

    }







}
