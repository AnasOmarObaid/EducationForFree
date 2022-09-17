<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Episode;
use App\Models\PlaylistCategory;
use App\Models\Section;
use App\Models\Series;
use App\Models\Topic;
use App\Models\User;
use App\Notifications\SendEducBitNotification;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SeriesController extends Controller
{
    use ImageTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // delete the series that don't exist'
        Series::where('user_id', null)->delete();
        $series = Series::with(['user', 'poster', 'topic', 'sections'])
        ->whenSelected($request)
        ->orderBy('id', 'desc')
        ->withCount('sections')
        ->get();

        $users = User::whereHas('series')->get();

        $topics = Topic::whereHas('series')->get();

        return view('admin.series.index', [
            'serieses' => $series,
            'users' => $users,
            'topics' => $topics
        ]);
    }//-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $series = Series::create();

        $topics = Topic::all();

        return view('admin.series.create', [
            'topics' => $topics,
            'series' => $series
        ]);
    } //-- end of create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // get the id for this series by using section id
        $section = Section::where('id', $request->section_id)->firstOrFail();
        $series = Series::where('id', $section->series_id)->firstOrFail();

        // create image
        $image_id = $this->storeImage($request->poster, 'series-poster');

        // create series
        $series = $series->update([
            'name' => $request->series_name,
            'description'   => $request->series_description,
            'user_id' => auth()->user()->id,
            'topic_id' => $request->topic_id,
            'image_id' => $image_id,
        ]);

        // send notification
        $users = User::where('id', '!=', auth()->id())->get();

        // return
        return redirect()->back()->with('success', 'Create series successfully');
    } //-- end store()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Series  $series
     * @return \Illuminate\Http\Response
     */
    public function destroy(Series $series)
    {
          // delete the poster
          $this->checkAndDelete($series->poster->path, 'series-poster/default.png', $series->poster);

          // delete the post
          $response = $series->delete();

          return $response ? response()->json(['status' => 'success', 'msg' => 'The series was successfully deleted!'])
              : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    }//-- end destroy()

    /**
     * storeEpisode
     *
     * @param  mixed $request
     * @param  mixed $section
     * @return void
     */
    public function storeEpisode(Request $request, Section $section)
    {

        return Episode::create([
            'title' => $request->name,
            'description' => $request->description,
            'learns' => $request->learns,
            'type' => get_class(new Section),
            'parent_id' => $section->id
        ])->id;
    } //-- end storeEpisode

      // make the admin active or not active
      /**
       * activation
       *
       * @param  mixed $bit
       * @return void
       */
      public function activation(Series $series)
      {
          $response = $series->activation ? $series->update(['activation' => 0]) : $series->update(['activation' => 1]);

          return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for this series!'])
              : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
      } //-- end activate()
}
