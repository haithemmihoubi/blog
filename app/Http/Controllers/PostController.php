<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{

    public function index()
    {

        $post = Post::all();
        return view('posts.index')->with('post', $post);
    }


    public function postsTrashed()
    {
        $post = Post::onlyTrashed()->get();
        return view('posts.trashed')->with('post', $post);
    }


    public function create()
    {

        return view('posts.create');
    }


    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'title' => 'required',
                'content' => 'required',
                'photo' => 'required|image'
            ]
        );
        $photo = $request->photo;

        $newPhoto = time() . $photo;
        $photo->move('uploads/posts' . $newPhoto);
        $post = Post::create(
            [
                'user_id' => Auth::id(),
                'title' => $request->title,
                'content' => $request->content,
                'photo' => 'uploads/posts' . $newPhoto,
                'slug' => Str::slug($request->slug)
            ]
        );
        return redirect()->back();
    }





    public function show($slug)
    {
        $post = Post::where('slug', $slug)->first();
        return view('posts.show')->with('post', $post);
    }





    public function edit($id)
    {
        $post = Post::find($id);
        return view('posts.edit')->with('post', $post);
    }






    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $this->validate($request, [
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required|image'
        ]);

        if ($request->has('photo')) {
            $photo = $request->photo;
            $newPhoto = time() . $photo;
            $photo->move('uploads/posts' . $newPhoto);
            $post->photo = 'uploads/posts' . $newPhoto;
        }
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save();
        return redirect()->back();
    }





    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->back();
    }



    public function hdestroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->forceDelete();
        return redirect()->back() ;
    }






    public function restore($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        $post->restore();
        return redirect()->back() ;
    }
}
