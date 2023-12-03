@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <form method="POST" action="{{ route('post#update',$postUpdate->post_id) }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Post Name</label>
                <input type="text" class="form-control" name="postName" placeholder="Enter name" value="{{ old('postName',$postUpdate->title) }}">
                @error('postName')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Post Description</label>
                <textarea name="postDescription" id="exampleInputPassword1" class="form-control" cols="30" rows="10"
                    placeholder="Enter description">{{ old('postDescription',$postUpdate->description) }}</textarea>
                @error('postDescription')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label for="formFileMultiple" class="form-label">Post Image</label><br>
                    @if($postUpdate->image == null)
                        <img width="100%" class="shadow-sm rounded"  src="{{ asset('dafaultphotos/default-image.jpg') }}">
                    @else
                        <img width="100%" class="shadow-sm rounded"  src="{{ asset('storage/'.$postUpdate->image) }}">
                    @endif
                  </div>
                  <div class="">
                    <input class="form-control" id="formFileLg" type="file" name="postImage">
                  </div>
                @error('postImage')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="">Category Name</label>
                <select name="postCategory" id="" class="form-control">
                    <option value="">Choose Category</option>
                    @foreach ($category as $item)
                        <option value="{{ $item->category_id }}" @if($item->category_id == $postUpdate->category_id) selected @endif>{{ $item->title }}</option>
                    @endforeach
                </select>
                @error('postCategory')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <div class="offset-1 col-7 ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Post List Page</h3>
                <div class="card-tools">
                    <form action="{{ route('category#search') }}" method="POST">
                        @csrf
                        <div class="input-group input-group-sm" style="width: 150px;">
                            <input type="text" name="categorySearch" class="form-control float-right"placeholder="Search">

                            <div class="input-group-append">
                                <button type="submit" class="btn btn-default">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap text-center">
                    <thead>
                        <tr>
                            <th>Post ID</th>
                            <th>Title</th>
                            <th>Image</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($post as $p )
                            <tr>
                                <td>{{ $p->post_id }}</td>
                            <td>{{ $p->title }}</td>
                            <td >
                                @if($p->image == null)
                                <img src="{{ asset('dafaultphotoes/default-image.jpg') }}" style="width: 80px;height: 50px" class="round shadow-sm">
                                @else
                                <img src="{{ asset('storage/'.$p->image) }}" style="width: 80px;height: 50px" class="round shadow-sm">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('post#updatepage',$p->post_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                <a href="{{ route('post#delete',$p->post_id) }}">
                                    <button class="btn btn-sm bg-danger text-white" title="Delete"><i
                                            class="fas fa-trash-alt"></i></button>
                                </a>
                            </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
@endsection
