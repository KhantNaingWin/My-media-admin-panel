@extends('admin.layouts.app')
@section('content')
<div class="col-3 offset-4 mt-4">
    <div class="my-4">
        <a href="{{ route('trend#post') }}" class="btn btn-dark text-white">Back</a>
    </div>
    <div class="card text-center">
        <div class="card-header">
            @if($post->image == null)
            <img class="rounded img-thumbnail shadow-sm" src="{{ asset('dafaultphotoes/default-image.jpg') }}">
    @else
        <img class="rounded img-thumbnail shadow-sm" src="{{ asset('storage/'.$post->image) }}">
    @endif
        </div>
        <div class="card-body">
            <h2>{{ $post->title }}</h2>
            <hr>
            <h6>{{ $post->description }}</h6>
        </div>
    </div>
</div>
@endsection
