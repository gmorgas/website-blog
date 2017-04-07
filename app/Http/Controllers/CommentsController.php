<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CommentsController extends Controller
{
    public function store(Request $request, $id) {
        $this->validate($request, array(
            'name'      =>  'required|max:255',
            'email'     =>  'required|email|max:255',
            'comment'   =>  'required|min:5|max:5000'
        ));

        $content = Contents::find($id);

        $comment = new Comments();
        $comment->contents_id = $id;
        $comment->nick = $request->name;
        $comment->email = $request->email;
        $comment->comment = $request->comment;

        $comment->save();

        Session::flash('success', 'Komentarz został dodany');
        return redirect()->route('beeShow', [$content->slug]);
    }
}
