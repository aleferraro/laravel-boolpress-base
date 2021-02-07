<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Post;
use App\PostInformation;
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
        $posts = Post::paginate(20);


        return view('post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $categories = Category::all();
        $tags = Tag::paginate(10);

        return view('post.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   

        $newPost = new Post;

        $newPost->title = $request->title;
        $newPost->author = $request->author;
        $newPost->category_id = $request->category;

        $newPost->save();

        $postId = $newPost->id;


        $newPostInformation = new PostInformation();

        $newPostInformation->description = $request->description;
        $newPostInformation->slug = Str::slug($newPost->title, '-');
        $newPostInformation->post_id = $postId;

        $newPostInformation->save();

        foreach ($request->tags as $tag){

            DB::table('post_tag')->insert([
                'post_id' => $postId,
                'tag_id' => $tag
            ]);

        };

        return view('post.store');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $categories = Category::all();
        $tags = Tag::paginate(10);
        
        return view('post.edit', compact('post', 'categories', 'tags'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        $postTagsId = [];
        foreach ($post->tags as $postTag){
            array_push($postTagsId, $postTag->id);
        }


        foreach ($request->tags as $tag){
            
            if(!in_array($tag, $postTagsId)){
                DB::table('post_tag')->insert([
                    'post_id' => $post->id,
                    'tag_id' => $tag
                ]);
            };
        }

        foreach ($postTagsId as $postTag){
            if(!in_array($postTag, $request->tags)){
                DB::table('post_tag')->where('post_id', $post->id)->where('tag_id', $postTag)->delete();
            };
        }
        
            
        $postData =[
            'title' => $request->title,
            'author' => $request->author,
            'category_id' => $request->category,
        ];

        $post->update($postData);

        $postInformation = PostInformation::where('post_id', '=', $id);

        $postinfoData = [
            'description' => $request->description,
        ];

        $postInformation->update($postinfoData);

        return view('post.update');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postTags = DB::table('post_tag')->where('post_id', '=', $id)->delete();
        
        PostInformation::where('post_id', '=', $id)->delete();
        
        Post::destroy($id);
        

        return view('post.destroy');
    }
}
