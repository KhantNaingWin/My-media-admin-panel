@extends('admin.layouts.app')
@section('content')
<div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">Trend Posts List Page</h3>

        <div class="card-tools">
          <div class="input-group input-group-sm" style="width: 150px;">
            <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

            <div class="input-group-append">
              <button type="submit" class="btn btn-default">
                <i class="fas fa-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- /.card-header -->
      <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap text-center">
          <thead>
            <tr>
              <th>ID</th>
              <th>Post Title</th>
              <th>Image</th>
              <th>View Count</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($items as $item)
            <tr>
                <td>{{ $item->post_id }}</td>
                <td>{{ $item->title }}</td>
                <td>
                    @if($item->image == null)
                            <img class=" col-2 rounded img-thumbnail shadow-sm" src="{{ asset('dafaultphotoes/default-image.jpg') }}">
                    @else
                        <img class=" col-2 rounded img-thumbnail shadow-sm" src="{{ asset('storage/'.$item->image) }}">
                    @endif
                </td>
                <td><i class="fa-regular fa-eye mr-1"></i>{{ $item->post_count }}</td>
                <td><a href="{{ route('trend#postDeails',$item->post_id) }}"><i class="fa-solid fa-circle-info" title="Details"></i></a></td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
      <!-- /.card-body -->
      <div class=" my-3">
      </div>
    </div>
    <!-- /.card -->
  </div>
@endsection
