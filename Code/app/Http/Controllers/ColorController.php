<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ColorController
{

    public function store(Request $request)
    {
        $color1 = $request->input('color1');
        $color2 = $request->input('color2');
        session(['color1'=>"#".$color1]);
        session(['color2'=>"#".$color2]);
    }
}
