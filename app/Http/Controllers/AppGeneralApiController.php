<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppGeneralApiController extends Controller
{
    public function  Getcountries()
    {
        $url = public_path('data/geo.json');
        $datos = file_get_contents($url);
        $data = json_decode($datos, true);
       return $contryies =   array_keys($data);
     
    }
    public function Getcities($namequery)
    {
        $url = public_path('data/geo.json');
        $datos = file_get_contents($url);
        $data = json_decode($datos, true);
        $data = array_filter($data);
        return $data = collect($data)->get($namequery);
    }
}
