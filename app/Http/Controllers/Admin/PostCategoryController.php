<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostCategoryRequest;
use App\Http\Requests\UpdatePostCategoryRequest;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::has('PostCategory')->get();

        $posts_categories = PostCategory::with(['User'])
            ->whenSelected($request)
            ->latest()
            ->get();

        return view('admin.posts-categories.index', [
            'posts_categories' => $posts_categories,
            'users' => $users
        ]);
    } //-- end index()

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts-categories.create');
    } //-- end create

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostCategoryRequest $request)
    {
        //validated
        $validated = $request->validated();

        // create new postCategory
        PostCategory::create([
            'name' => $validated['name'],
            'description'   => $validated['description'],
            'activation' => $validated['activation'],
            'user_id' => auth()->user()->id,
        ]);

        // return
        return redirect()->back()->with('success', 'Create category post successfully');
    } //-- end store()


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostCategory $postCategory)
    {
        return view('admin.posts-categories.edit', ['category' => $postCategory]);
    } //-- end edit()

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostCategoryRequest $request, PostCategory $postCategory)
    {
        //validated
        $validated = $request->validated();

        // update category
        $postCategory->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'activation' => $request['activation'],
        ]);

        // redirect
        return redirect()->route('admins.posts-categories.edit', $postCategory)->with('success', 'Update category post successfully');
    } //-- end update()

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostCategory  $postCategory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostCategory $postCategory)
    {
        // delete the teacher
        $del = $postCategory->delete();

        return $del ? response()->json(['status' => 'success', 'msg' => 'The category was successfully deleted!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end destroy()

    // delete the selected teachers
    public function destroySelected(Request $request)
    {
        // explode the ids
        $ids = explode(',', $request->ids);

        // get the questions
        $categories = PostCategory::whereIn('id', $ids)->get();

        //delete the questions
        $categories->each->delete();

        // return the json response
        return response()->json(['status' => 'success', 'msg' => 'The selected Category was successfully deleted!']);
    } //-- end destroySelected()

    // make the admin active or not active
    public function activation(PostCategory $postCategory)
    {
        $response = $postCategory->activation ? $postCategory->update(['activation' => 0]) : $postCategory->update(['activation' => 1]);

        return $response ? response()->json(['status' => 'success', 'msg' => 'Successfully changed activation for category!'])
            : response()->json(['status' => 'error', 'msg' => 'There is error, try again!']);
    } //-- end activate()
}//-- end PostCategoryController
