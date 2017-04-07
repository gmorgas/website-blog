<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Contents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BeeController extends Controller
{
    public function main()
    {
        $month = array();
        $oldTemp = '';
        $action = action('BeeController@main');

        if(!Cache::has('archiveBee')) {
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
        }

        $contents = Contents::where('category', 'pszczelarstwo')->paginate(3);
        $archive = Cache::get('archiveBee');


        return view('bee.bee', compact('action', 'contents', 'archive'));
    }

    public function show($slug) {
        $action = action('BeeController@main');
        $content = Contents::where('slug', $slug)->first();
//        $tags = Tag::select('tags')
//            ->where('contents_id', $content->id)
//            ->get();
        $archive = Cache::get('archiveBee');
        $comments = Comments::select()
                            ->where('contents_id', $content->id)
                            ->orderBy('created_at', 'desc')
                            ->get();

        return view('bee.show', compact('action', 'content', 'archive', 'comments'));
    }


    public function beeSearch(Request $request) {
        $action = action('BeeController@main');
        $archive = Cache::get('archiveBee');
        $keywords = $request->q;
//        dd($keywords);
        $contents = Contents::where('subject', 'like', '%'.$keywords.'%')
            ->orWhere('tags', 'like', '%'.$keywords.'%')->get();

        return view('bee.search', compact('contents', 'action', 'archive', 'keywords'));
    }

    public function beeMonth($mont) {
        $action = action('BeeController@main');
        $month = $mont;
        $created_at = $this->changeMonthToInt($mont);
        $contents = Contents::whereMonth('created_at', $created_at)->get();
//        dd($contents);
        $archive = Cache::get('archiveBee');

        return view('bee.month',compact('contents', 'month', 'action', 'archive'));
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

static function truncate($text, $length = 100, $ending = '...', $exact = false, $considerHtml = true) {
    if ($considerHtml) {
        // if the plain text is shorter than the maximum length, return the whole text
        if (strlen(preg_replace('/<.*?>/', '', $text)) <= $length) {
            return $text;
        }
        // splits all html-tags to scanable lines
        preg_match_all('/(<.+?>)?([^<>]*)/s', $text, $lines, PREG_SET_ORDER);
        $total_length = strlen($ending);
        $open_tags = array();
        $truncate = '';
        foreach ($lines as $line_matchings) {
            // if there is any html-tag in this line, handle it and add it (uncounted) to the output
            if (!empty($line_matchings[1])) {
                // if it's an "empty element" with or without xhtml-conform closing slash
                if (preg_match('/^<(\s*.+?\/\s*|\s*(img|br|input|hr|area|base|basefont|col|frame|isindex|link|meta|param)(\s.+?)?)>$/is', $line_matchings[1])) {
                    // do nothing
                    // if tag is a closing tag
                } else if (preg_match('/^<\s*\/([^\s]+?)\s*>$/s', $line_matchings[1], $tag_matchings)) {
                    // delete tag from $open_tags list
                    $pos = array_search($tag_matchings[1], $open_tags);
                    if ($pos !== false) {
                        unset($open_tags[$pos]);
                    }
                    // if tag is an opening tag
                } else if (preg_match('/^<\s*([^\s>!]+).*?>$/s', $line_matchings[1], $tag_matchings)) {
                    // add tag to the beginning of $open_tags list
                    array_unshift($open_tags, strtolower($tag_matchings[1]));
                }
                // add html-tag to $truncate'd text
                $truncate .= $line_matchings[1];
            }
            // calculate the length of the plain text part of the line; handle entities as one character
            $content_length = strlen(preg_replace('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', ' ', $line_matchings[2]));
            if ($total_length+$content_length> $length) {
                // the number of characters which are left
                $left = $length - $total_length;
                $entities_length = 0;
                // search for html entities
                if (preg_match_all('/&[0-9a-z]{2,8};|&#[0-9]{1,7};|[0-9a-f]{1,6};/i', $line_matchings[2], $entities, PREG_OFFSET_CAPTURE)) {
                    // calculate the real length of all entities in the legal range
                    foreach ($entities[0] as $entity) {
                        if ($entity[1]+1-$entities_length <= $left) {
                            $left--;
                            $entities_length += strlen($entity[0]);
                        } else {
                            // no more characters left
                            break;
                        }
                    }
                }
                $truncate .= substr($line_matchings[2], 0, $left+$entities_length);
                // maximum lenght is reached, so get off the loop
                break;
            } else {
                $truncate .= $line_matchings[2];
                $total_length += $content_length;
            }
            // if the maximum length is reached, get off the loop
            if($total_length>= $length) {
                break;
            }
        }
    } else {
        if (strlen($text) <= $length) {
            return $text;
        } else {
            $truncate = substr($text, 0, $length - strlen($ending));
        }
    }
    // if the words shouldn't be cut in the middle...
    if (!$exact) {
        // ...search the last occurance of a space...
        $spacepos = strrpos($truncate, ' ');
        if (isset($spacepos)) {
            // ...and cut the text in this position
            $truncate = substr($truncate, 0, $spacepos);
        }
    }
    // add the defined ending to the text
    $truncate .= $ending;
    if($considerHtml) {
        // close all unclosed html-tags
        foreach ($open_tags as $tag) {
            $truncate .= '</' . $tag . '>';
        }
    }
    return $truncate;
}

}
