@extends('layouts.backend.master')
@section('content')

    <h1>Edit Posts</h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form method="post"  action="{{route('post.update',$posts->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$posts->name}}">
                                </div>
                                <div class="col-md-6">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                         @foreach($category as $c)
                                            <option value="{{$c->id}}" {{$c->id == $posts->category->id ? 'selected' : ''}}>{{$c->name}}</option>
                                         @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Location</label>
                                    <input type="text" name="location" class="form-control" value="{{$posts->location}}">
                                </div>
                                <div class="col-md-6">
                                    <label>Website</label>
                                    <input type="text" name="website" class="form-control" value="{{$posts->website}}">
                                </div>
                                <div class="col-md-6">
                                    <label>Course</label>
                                    <select class="form-control select2" multiple="multiple" style="width: 100%;" name="courses[]">
                                        @foreach($course as $c)
                                            <option value="{{$c->name}}"
                                             @if(in_array($c->name, $course_data))
                                                  style="color: red"
                                             @endif
                                          >{{$c->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="image">Image</label>
                                    <input type="file" name="images" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label>Website</label>
                                    <textarea name="description" class="form-control">
                                        {{$posts->description}}
                                    </textarea>
                                </div>

                                <div class="col-md-12 mt-4">
                                    <button  class="btn btn-primary col-md-12">Save changes</button>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    @endsection