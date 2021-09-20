<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str; //per far funzionare lo slug
use App\Post; //importo il model di post
use App\Category;
use App\Tag;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.create',compact('categories','tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $request->validate([
          'title' => 'required|max:255',
          'content' => 'required'
        ]);
        //prendo i dati
        $data = $request->all();
        //li salvo in un istanza di post usando le fillable (definite nel model)
        $newPost = new Post();
        //salvo lo slug in una variabile
        $slug = Str::slug($data['title'], '-');
        //salvo lo slug in una variabile di appoggio
        $slug_base = $slug;
        //controllo se già esiste lo slug
        $slug_presente = Post::where('slug' , $slug)->first();
        $counter = 1;

        while ($slug_presente) {

          $slug = $slug_base . '-' . $counter;
          $slug_presente = Post::where('slug' , $slug)->first();
          $counter++;
        }


        $newPost->slug = $slug;
        $newPost->fill($data);
        //salvo nel db
        $newPost->save();
        
        if (array_key_exists('tags',$data)) { // se in data c'è un array tags  
          $newPost->tags()->attach($data['tags']);
        }



        return redirect()->route('admin.posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug',$slug)->first();
        $tags = Tag::all();
        return view('admin.posts.show', compact('post','tags'));
    } 

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('admin.posts.edit',compact('post','categories','tags'));
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
      // surprise : senza questo le validation non funzionano
      $request->validate([
        'title' => 'required|max:255',
        'content' => 'required',
        'category_id' => 'nullable|exists:categories,id'
      ]);
      $data = $request->all();
      if($data['title'] != $post->title){
        $slug = Str::slug($data['title'], '-'); 
        $slug_base = $slug;
        $slug_presente = Post::where('slug', $slug)->first();
        $counter = 1;

        while($slug_presente){
          $slug = $slug_base . '-' . $counter;

          $slug_presente = Post::where('slug', $slug)->first();
            $counter++;
        }

        $data['slug'] = $slug;

      }
      $post->update($data);

      if(array_key_exists('tags',$data)){
        $post->tags()->sync($data['tags']);
      }
      return redirect()->route('admin.posts.index');
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
        $post->tags()->detach();
        return redirect()->route('admin.posts.index');
    }
}
