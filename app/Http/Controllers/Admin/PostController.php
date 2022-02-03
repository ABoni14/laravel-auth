<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Composer;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy("id", "desc")->paginate(5);
        return view("admin.posts.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.posts.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                "title" => "required|max:255|min:2",
                "content" => "required",
            ],
            [
                "title.require" => "Il titolo è un campo obbligatorio",
                "title.max" => "Il numero massimo è di :max caratteri",
                "title.min" => "Il numero minimo è di :max caratteri",
                "content.require" => "Il contenuto è un campo obbligatorio",
            ]
        );
        $data = $request->all();
        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();
        return redirect()->route("admin.posts.show", $new_post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        if($post){
            return view("admin.posts.show", compact("post"));
        }
        abort(404, "Errore nella ricerca della pagina");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        if($post){
            return view("admin.posts.edit", compact("post"));
        }
        abort(404, "Post non trovato nel database");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $request->validate(
            [
                "title" => "required|max:255|min:2",
                "content" => "required",
            ],
            [
                "title.require" => "Il titolo è un campo obbligatorio",
                "title.max" => "Il numero massimo è di :max caratteri",
                "title.min" => "Il numero minimo è di :max caratteri",
                "content.require" => "Il contenuto è un campo obbligatorio",
            ]
        );
        $form_data = $request->all();

        if($form_data["title"] != $post->title){
            $form_data["slug"] = Post::generateSlug($form_data["title"]);
        }

        $post->update($form_data);
        return redirect()->route("admin.posts.show", $post);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route("admin.posts.index")->with("deleted", "Post eliminato");
    }
}
