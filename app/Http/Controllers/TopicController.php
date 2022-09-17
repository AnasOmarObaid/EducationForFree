<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;

class TopicController extends Controller
{
    /**
     * all
     *
     * @return void
     */
    public function all()
    {
        $topics = Topic
            ::withCount('series')
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.all', [
            'topics' => $topics
        ]);
    } //-- end of all


    /**
     * framework
     *
     * @return void
     */
    public function framework()
    {
        $topics = Topic
            ::withCount('series')
            ->whereHas('category', function ($category) {
                return $category->where('name', 'frameworks');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.framework', [
            'topics' => $topics
        ]);
    } //-- end of framework


    /**
     * testing
     *
     * @return void
     */
    public function testing()
    {
        $topics = Topic
            ::withCount('series')
            ->whereHas('category', function ($category) {
                return $category->where('name', 'Testing');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.testing', [
            'topics' => $topics
        ]);
    } //-- end of test

    /**
     * languages
     *
     * @return void
     */
    public function languages()
    {
        $topics = Topic
            ::withCount('series')
            ->whereHas('category', function ($category) {
                return $category->where('name', 'Languages');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.languages', [
            'topics' => $topics
        ]);
    } //-- end of languages


    /**
     * tooling
     *
     * @return void
     */
    public function tooling()
    {

        $topics = Topic
            ::withCount('series')
            ->whereHas('category', function ($category) {
                return $category->where('name', 'tooling');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.tooling', [
            'topics' => $topics
        ]);
    } //-- end of tooling


    public function techniques()
    {

        $topics = Topic
            ::withCount('series')
            ->whereHas('category', function ($category) {
                return $category->where('name', 'techniques');
            })
            ->orderBy('id', 'desc')
            ->get();

        return view('pages.topics.techniques', [
            'topics' => $topics
        ]);
    } //-- end of techniques
}//-- END Controller
