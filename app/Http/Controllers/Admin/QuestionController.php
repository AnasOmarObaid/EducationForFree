<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQuestionRequest;
use App\Http\Requests\UpdateQuestionRequest;
use App\Models\Question;
use App\Notifications\SendAnswerEmailNotify;
use Carbon\Carbon;
use Illuminate\Http\Request;

class QuestionController extends Controller
{


    public function __construct()
    {
        $this->middleware(['permission:questions_*'])->only('index');
        $this->middleware(['permission:questions_create'])->only(['create', 'store', 'replay', 'read']);
        $this->middleware(['permission:questions_update'])->only(['edit', 'update']);
        $this->middleware(['permission:questions_delete'])->only(['destroy', 'destroySelected']);
    } //-- end constructor

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $questions = Question::whereReadIs($request)
            ->latest()
            ->get();

        return view('admin.questions.index', [
            'questions' => $questions
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.questions.create');
    } //-- end create()

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuestionRequest $request)
    {
        // validated the data
        $validated = $request->validated();

        // store the data
        Question::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'question' => $validated['question']
        ]);

        // return
        return redirect()->route('admins.questions.create')->with('success', 'Create question successfully');
    } //-- end store()


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        return view('admin.questions.edit', [
            'question' => $question,
        ]);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuestionRequest $request, Question $question)
    {
        // validated the request
        $validated = $request->validated();

        // update question
        $question->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'question'   => $validated['question']
        ]);

        // redirect
        return redirect()->route('admins.questions.edit', $question)->with('success', 'Update question successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {
        // delete the teacher
        $del = $question->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The question was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end destroy()

    // delete the selected students
    public function destroySelected(Request $request)
    {

        // explode the ids
        $ids = explode(',', $request->ids);

        // get the questions
        $questions = Question::whereIn('id', $ids)->get();

        //delete the questions
        $questions->each->delete();

        // return the json response
        return response()->json(['status' => 'success', 'msg' => 'The selected questions was successfully deleted!']);
    } //--end destroySelected()

    // make the question as read
    public function read(Question $question)
    {
        $question->read_at = Carbon::now();
        $response = $question->save();

        return $response ? response()->json(['status' => 'success', 'msg' => 'update the read at date!', 'answer' => $question->answer, 'read_at' => $question->read_at->format('M d/y')])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end read()

    // replay for the question
    public function replay(Question $question, Request $request)
    {
        $validated = $request->validate([
            'answer' => 'required'
        ]);

        $response = $question->update([
            'answer' => $validated['answer']
        ]);

        // send email notification
        if (setting('system_notification'))
            $question->notify(new SendAnswerEmailNotify($question));

        return $response ? response()->json(['status' => 'success', 'msg' => 'Send answer successfully'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end replay()
}//-- end QuestionController
