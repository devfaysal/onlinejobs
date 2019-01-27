@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @foreach ($images as $image)
                    <img style="max-width:200px;" src="{{ asset('storage/gallery/'. $image->image_name) }}" alt="{{ $image->caption }}">
                @endforeach
            </div><!--/.col-md-12-->
        </div><!--/.row-->
    </div><!--/.container-->
@endsection
