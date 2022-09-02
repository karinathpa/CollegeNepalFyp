<?php

namespace App\Http\Controllers;

use App\Category;
use App\Course;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $course = Course::all();
        $posts = Post::all();
        return view('posts.index',['category'=>$category,'course'=>$course,'posts'=>$posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $explode_data = implode(',',$request->courses);
        $post = new Post();
        $post->name = $request->name;
        $post->category_id = $request->category_id;
        $post->location = $request->location;
        $post->website = $request->website;
        $post->courses = $request->courses;
        $post->description = $request->description;
        if ($request->hasFile('images')) {
            $image = $request->file('images');
            $feature_img = date('Ymdhis').'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/images/posts/');
            $image->move($destinationPath, $feature_img);
        }
        $post->images = $feature_img;
        $post->user_id = Auth::user()->id;
        $post->courses = $explode_data;
        $post->save();

        return redirect()->route('post.index');


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
        $posts = Post::find($id);
        $category = Category::all();
        $course = Course::all();
        $course_data = explode(',',$posts->courses);
        return view('posts.edit',['posts'=>$posts,'category'=>$category,'course'=>$course,'course_data'=>$course_data]);
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
        if($request->courses == ''){
            $explode_data = $post->courses;
        }
        else{
            $explode_data = implode(',',$request->courses);
        }
        $post->name = $request->name;
        $post->category_id = $request->category_id;
        $post->location = $request->location;
        $post->website = $request->website;
        $post->courses = $request->courses;
        $post->description = $request->description;
        if(empty($request->images)){
           $feature_img = $post->images;
        }
        else{
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $feature_img = date('Ymdhis').'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/images/posts/');
                $image->move($destinationPath, $feature_img);
            }
        }

        $post->images = $feature_img;
        $post->user_id = Auth::user()->id;
        $post->courses = $explode_data;
        $post->save();
        return redirect()->route('post.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('post.index');
    }
}
