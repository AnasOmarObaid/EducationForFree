<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Section;
use App\Models\Series;
use Illuminate\Http\Request;

class SectionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return Section::create([
            'name' => $request->name,
            'series_id' => $request->id
        ]);
    }//-- end store()

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(Series $series)
    {
        $sections =  Section::where('series_id', $series->id)
        ->orderBy('id', 'desc')
        ->get();

        return view('admin.sections._options', [
            'sections' => $sections,
        ]);
    }//-- end of show

}
