<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchBar;
use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function SearchBar(Request $request){

         $result =   User::search($request->q)->paginate(50);
        $result=   SearchBar::collection($result);
         return response()->json($result,200);
    }
}
