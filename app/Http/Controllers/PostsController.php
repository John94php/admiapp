<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use Inertia\Inertia;
use App\Models\Posts;
use Illuminate\Support\Facades\Validator;
class PostsController extends Controller
{
    //
    public function index(Posts $posts) {
            return Inertia::render(
                'Posts',
                [
                    'data' => $posts->latest()->get()
                ]
            );
    }

    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'title' => ['required'],
        ])->validate();

        Posts::create($request->all());

        return redirect()->back()
            ->with('message', 'News Created Successfully.');
    }
    public function update(Request $request) {
        Validator::make($request->all(),[
            'title' =>['required'],
        ])->validate();

        if($request->has('id')) {
            Posts::find($request->input('id'))->update($request->all());
            return redirect()->back()->with('message','News updated successfully');
        }
    }
    public function delete(Request $request)
    {

        $request->has('id') ?
            Posts::find($request->input('id'))->delete() :
            redirect()->back()
                ->with('errors', 'Somethings goes wrong.');

        return redirect()->back()
            ->with('message', 'Post deleted successfully.');
    }



}
