<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslateController extends Controller
{


    public function  TranslateText(Request $request){

        $tr = new GoogleTranslate('ar');
        $text = $tr->translate($request->text);
        return response()->json($text,200);
//        $data =  $tr->getResponse('Hello world');
//        dd( $data[2]); /*get lang name*/
    }
}
