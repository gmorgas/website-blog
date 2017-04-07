<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WineController extends Controller
{
    public function main()
    {
        $month = array();
        $oldTemp = '';
        $action = action('WineController@main');

        if(!Cache::has('archiveWine')) {
            $created_at = Contents::select('created_at')
                ->where('category', 'winiarstwo')
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

        $contents = Contents::where('category', 'winiarstwo')->paginate(3);
        $archive = Cache::get('archiveWine');

        return view('wine.wine', compact('action', 'contents', 'archive'));
    }

    public function show($slug) {
        $action = action('WineController@main');
        $content = Contents::where('slug', $slug)
            ->where('category', 'winiarstwo')->first();
//        $tags = Tag::select('tags')
//            ->where('contents_id', $content->id)
//            ->get();
        $archive = Cache::get('archiveWine');
        $comments = Comments::select()
            ->where('contents_id', $content->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wine.show', compact('action', 'content', 'archive', 'comments'));
    }


    public function wineSearch(Request $request) {
        $action = action('WineController@main');
        $archive = Cache::get('archiveWine');
        $keywords = $request->q;
//        dd($keywords);
        $contents = Contents::where('subject', 'like', '%'.$keywords.'%')
            ->orWhere('tags', 'like', '%'.$keywords.'%')
            ->where('category', 'winiarstwo')->get();

        return view('wine.search', compact('contents', 'action', 'archive', 'keywords'));
    }

    public function wineMonth($mont) {
        $action = action('WineController@main');
        $month = $mont;
        $created_at = $this->changeMonthToInt($mont);
        $contents = Contents::whereMonth('created_at', $created_at)
            ->where('category', 'winiarstwo')->get();
//        dd($contents);
        $archive = Cache::get('archiveWine');

        return view('wine.month', compact('contents', 'month', 'action', 'archive'));
    }

//    static public function getTag($id) {
//        $tags = Tag::select('tags')
//            ->where('contents_id', $id)
//            ->get();
//
//        return $tags;
//    }

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

    public function changeMonthToInt($month) {
        switch ($month)
        {
            case "Styczeń":
                $month = 1;
                break;
            case "Luty":
                $month = 2;
                break;
            case "Marzec":
                $month = 3;
                break;
            case "Kwiecień":
                $month = 4;
                break;
            case "Maj":
                $month = 5;
                break;
            case "Czerwiec":
                $month = 6;
                break;
            case "Lipiec":
                $month = 7;
                break;
            case "Sierpień":
                $month = 8;
                break;
            case "Wrzesień":
                $month = 9;
                break;
            case "Październik":
                $month = 10;
                break;
            case "Listopad":
                $month = 11;
                break;
            case "Grudzień":
                $month = 12;
                break;

        }
        return $month;
    }
}
