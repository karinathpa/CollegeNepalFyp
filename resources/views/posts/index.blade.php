@extends('layouts.backend.master')
@section('content')
<style>
    .col-md-6{
        margin-bottom: 5px;
    }
</style>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Posts</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Starter Page</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right">
                            Add Posts
                        </button>
                    </div>
                    <div class="card-body">
                        <table id="table_id" class="display">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($posts as $p)
                            <tr>
                               <td>{{$p->name}}</td>
                               <td>{{$p->category->name}}</td>
                               <td>{{$p->location}}</td>
                               <td><img src="{{url('images/posts/'.$p->images)}}" height="30px" width="40px"></td>
                                <td style="display: flex">
                                    <a href="{{route('post.edit',$p->id)}}" class="btn btn-warning" style="margin-right: 5px">Edit</a>
                                    <form action="{{route('post.destroy',$p->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button  class="btn btn-danger">Delete</button>
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="width: 700px;">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Posts</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
                    @csrf
                <div class="modal-body">
                         <div class="row">
                             <div class="col-md-6">
                                 <label>Name</label>
                                 <input type="text" name="name" class="form-control">
                             </div>
                             <div class="col-md-6">
                                 <label>category</label>
                                 <select class="form-control" name="category_id">
                                     <option>select</option>
                                     @foreach($category as $c)
                                         <option value="{{$c->id}}">{{$c->name}}</option>
                                     @endforeach
                                 </select>
                             </div>
                             <div class="col-md-6">
                                 <label>Location</label>
                                 <input type="text" name="location" class="form-control">
                             </div>
                             <div class="col-md-6">
                                 <label>Website</label>
                                 <input type="text" name="website" class="form-control">
                             </div>
                             <div class="col-md-6">
                                 <div class="form-group">
                                     <label>Select Course</label>
                                     <select class="form-control select2" multiple="multiple" style="width: 100%;" name="courses[]">
                                         @foreach($course as$c)
                                          <option value="{{$c->name}}">{{$c->name}}</option>
                                        @endforeach
                                     </select>
                                 </div>
                             </div>
                             <div class="col-md-6">
                                 <label for="image">Image</label>
                                 <input type="file" name="images" class="form-control">
                             </div>
                             <div class="col-md-12">
                                 <label>Description</label>
                                 <textarea class="form-control" name="description" ></textarea>
                             </div>
                         </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button  class="btn btn-primary">Save changes</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.content -->


@endsection
@section('scripts')
    <script>
        $(document).ready( function () {
            $('#table_id').DataTable();
        } );
    </script>
@endsection