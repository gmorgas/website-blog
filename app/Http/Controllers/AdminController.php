<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Contents;
use App\Tag;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function main() {

        $posts = Contents::paginate(10);

        return view('admin.admin', compact('posts'));
    }

    public function create() {

        return view('admin.create');
    }

    public function store(Request $request) {
        // validate the data
        $this->validate($request, array(
            'title'         => 'required|max:255',
            'slug'          => 'required|min:5|max:255',
            'category'      => 'required',
            'body'          => 'required'
        ));
//         store in the database
        $post = new Contents;
        $post->subject = $request->title;
        $post->slug = $request->slug;
        $post->content = serialize($request->body);
        $post->category = $request->category;
        $post->tags = $request->tags;

        $post->save();

//        $tagsArray = explode(',', $request->tags);
//
//        $tags = new Tag;
//        foreach($tagsArray as $t) {
//            $tags->contents_id = $post->id;
//            $tags->tags = $t;
//            DB::table('tag')->insert(
//                array(
//                    'contents_id' => $post->id,
//                    'tags'         => $t
//                )
//            );
//        }

        if('pszczelarstwo' == $request->category) {
            if(Cache::has('archiveBee')){ Cache::forget('archiveBee'); }
            $oldTemp = '';
            $month = array();
            $created_at = Contents::select('created_at')
                ->where('category', 'pszczelarstwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveBee', $month);
        } else {
            if(Cache::has('archiveWine')){ Cache::forget('archiveWine'); }
            $oldTemp = '';
            $month = array();
            $created_at = Contents::select('created_at')
                ->where('category', 'winiastwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveWine', $month);
        }


        Session::flash('success', 'The blog post was successfully save!');

        return Redirect::to(Lang::get('route.adminPanel'));
    }

    public function show($id) {
        $post = Contents::find($id);
        $tag = explode(',', $post->tags);
//        dd(explode(',', $tag));
//        $tag = Tag::select('tags')
//                        ->where('contents_id', $id)
//                        ->get();
        return view('admin.show', compact('post', 'tag'));
    }

    public function edit($id) {
        $post = Contents::find($id);
//        $tags = Tag::select('tags')
//            ->where('contents_id', $id)
//            ->get();
//        foreach($tags as $t){
//            $tag[] = $t->tags;
//        }
        return view('admin.edit', compact('post'));
    }

    public function update(Request $request, $id)
    {

        // Save the data to the database
        $post = Contents::find($id);
        $post->subject = $request->title;
        $post->slug = $request->slug;
        $post->content = serialize($request->body);
        $post->category = $request->category;
        $post->tags = $request->tags;

        $post->save();

//        $tagsArray = explode(',', $request->tags);
//
//        $tags = new Tag;
//        foreach($tagsArray as $t) {
//            $tags->contents_id = $id;
//            $tags->tags = $t;
//            DB::table('tag')->insert(
//                array(
//                    'contents_id' => $id,
//                    'tags'         => $t
//                )
//            );
//    }
        if('pszczelarstwo' == $request->category) {
            if(Cache::has('archiveBee')){ Cache::forget('archiveBee'); }
            $oldTemp = '';
            $created_at = Contents::select('created_at')
                ->where('category', 'pszczelarstwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveBee', $month);
        } else {
            if(Cache::has('archiveWine')){ Cache::forget('archiveWine'); }
            $oldTemp = '';
            $created_at = Contents::select('created_at')
                ->where('category', 'winiastwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveWine', $month);
        }

        // set flash data with success message
        Session::flash('success', 'This post was successfully saved.');
        // redirect with flash data to posts.show
        return redirect()->route('show', $post->id);
    }

    public function destroy($id)
    {
        $post = Contents::find($id);
        $post->delete();
//        $tags = Tag::where('contents_id',$id);
//        $tags->delete();
        $comments = Comments::where('contents_is', $id);
        $comments->delete();

        if('pszczelarstwo' == $request->category) {
            if(Cache::has('archiveBee')){ Cache::forget('archiveBee'); }
            $oldTemp = '';
            $created_at = Contents::select('created_at')
                ->where('category', 'pszczelarstwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveBee', $month);
        } else {
            if(Cache::has('archiveWine')){ Cache::forget('archiveWine'); }
            $oldTemp = '';
            $created_at = Contents::select('created_at')
                ->where('category', 'winiastwo')
                ->orderBy('created_at', 'desc')
                ->get();
            foreach($created_at as $mon) {
                $temp = $this->changeMonth($mon->created_at->month).' '.$mon->created_at->year;
                if($temp != $oldTemp) {
                    $month[] = $temp;
                }
                $oldTemp = $temp;
            }
            Cache::forever('archiveWine', $month);
        }
        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('admin');
    }

    public function changeMonth($month) {
        switch ($month)
        {
            case 1:
                $month = "Styczeń";
                break;
            case 2:
                $month = "Luty";
                break;
            case 3:
                $month = "Marzec";
                break;
            case 4:
                $month = "Kwiecień";
                break;
            case 5:
                $month = "Maj";
                break;
            case 6:
                $month = "Czerwiec";
                break;
            case 7:
                $month = "Lipiec";
                break;
            case 8:
                $month = "Sierpień";
                break;
            case 9:
                $month = "Wrzesień";
                break;
            case 10:
                $month = "Październik";
                break;
            case 11:
                $month = "Listopad";
                break;
            case 12:
                $month = "Grudzień";
                break;

        }
        return $month;
    }
}
