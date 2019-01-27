@extends('layouts.app')

@section('content')
<div class="container-fluid bg-dark">
    @include('layouts.topbar')
</div>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <h1 class="text-center">Gallery</h1>
            </div>
            @foreach ($images as $image)
            <div class="col-4 mb-2">
                <div class="card">
                    <img class="card-img-top img-thumbnail" src="{{ asset('storage/gallery/'. $image->image_name) }}" alt="{{ $image->caption }}">
                    <div class="card-body">
                        <p class="card-text text-center">{{$image->caption}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
