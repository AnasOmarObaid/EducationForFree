<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Series;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    public function index()
    {
        Series::where('user_id', null)->delete();

        $main_series = Series::with(['user', 'poster', 'topic', 'sections'])
        ->orderBy('id', 'desc')
        ->withCount('sections')
        ->first();

        $news = Series::with(['user', 'poster', 'topic', 'sections'])
        ->orderBy('id', 'desc')
        ->withCount('sections')
        ->limit(2)
        ->orderBy('id', 'desc')
        ->get();

        $tools = Series::whereHas('topic', function($topic){
            return $topic->where('playlist_category_id', 5);
        })
        ->orderBy('id', 'desc')
        ->get();

        $testings = Series::whereHas('topic', function($topic){
            return $topic->where('playlist_category_id', 4);
        })
        ->orderBy('id', 'desc')
        ->get();

        $languages = Series::whereHas('topic', function($topic){
            return $topic->where('playlist_category_id', 2);
        })
        ->orderBy('id', 'desc')
        ->get();

        $frameworks = Series::whereHas('topic', function($topic){
            return $topic->where('playlist_category_id', 1);
        })
        ->orderBy('id', 'desc')
        ->get();

        $trends = Series::
        orderBy('id', 'desc')
        ->limit(12)
        ->get();

        return view('pages.series.index', [
            'main_series' => $main_series,
            'news' => $news,
            'tools' => $tools,
            'testings' => $testings,
            'languages' => $languages,
            'frameworks' => $frameworks,
            'trends' => $trends
        ]);


    } //-- end index


    /**
     * info
     *
     * @param  mixed $series
     * @return void
     */
    public function info(Series $series){
        return view('pages.series.info',[
            'series' => $series
        ]);
    }//-- end info


    public function show(Series $series, Episode $episode){
        return view('pages.series.show',[
            'series' => $series,
            'episode' => $episode
        ]);
    }//-- end show
}//- end of class SeriesController
