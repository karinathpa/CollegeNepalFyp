@extends('layouts.backend.master')
@section('content')

    <div class="container">
        '
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <form method="post"  action="{{route('course.update',$course->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" value="{{$course->name}}">
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