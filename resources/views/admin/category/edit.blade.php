@extends('admin.layouts.app')
@section('content')
    <div class="col-4">
        <form method="POST" action="{{ route('category#update',$updateData->category_id) }}">
            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Category Name</label>
                <input type="text" class="form-control" name="categoryName" value="{{ old('categoryName',$updateData->title) }}" placeholder="Enter name">
                @error('categoryName')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Description</label>
                <textarea name="categoryDescription" id="" class="form-control" cols="30" rows="10" placeholder="Enter description">{{ old('categoryDescription',$updateData->description) }}</textarea>
                @error('categoryDescription')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <button class="btn btn-dark text-white" type="submit">Update</button>
            <a href="{{ route('category') }}"><button type="button" class="btn btn-primary">Create</button></a>
        </form>
    </div>

    <div class="offset-1 col-7 ">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Category List Page</h3>
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
                            <th>Category ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $c)
                            <tr>
                                <td>{{ $c->category_id }}</td>
                                <td>{{ $c->title }}</td>
                                <td>{{ $c->description }}</td>
                                <td>
                                    <a href="{{ route('category#edit',$c->category_id) }}"><button class="btn btn-sm bg-dark text-white"><i class="fas fa-edit"></i></button></a>
                                    <a href="{{ route('category#delete', $c->category_id) }}">
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
        {{-- alert  --}}
        @if (session('delete'))
            <div class="alert alert-dismissible fade show close" role="alert" aria-label="Close">
                {{ session('delete') }}
            </div>
        @endif
        {{-- alert end  --}}
        <!-- /.card -->
    </div>
@endsection
