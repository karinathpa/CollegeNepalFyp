@extends('layouts.master')
@section('content')


    <div class="container" style="margin-top: 15px">
        <div class="row ">
            <div class="col-md-12">
                <div class="blog-post">
                    <h2 class="blog-post-title">{{$post->name}}</h2>
                    <p class="blog-post-meta">{{$post->created_at->diffForHumans()}} <a href="#">{{Auth::user()->name}}</a></p>
                    <img src="{{url('images/posts/'.$post->images)}}" height="300px" width="400px">

                   <p style="margin-top: 15px;">{{$post->description}}</p>

                </div>
            </div>
        </div>
    </div>




@endsection