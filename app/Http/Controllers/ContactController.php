<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Mail\Contact;
use Illuminate\Support\Facades\Session;


class ContactController extends Controller
{
    public function main() {
        $action = action('ContactController@main');
        return view('contact.contact', compact('action'));
    }

}
