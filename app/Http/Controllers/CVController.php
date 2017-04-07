<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CVController extends Controller
{
    public function main() {
        $action = action('CVController@main');
        $file="./cv.pdf";
        $headers = array(
            'Content-Type' => 'application/pdf',
        );
        return response()->file($file, $headers);
    }
}
