@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="row">
        @foreach ($articles as $article)
            <div class="col-md-7 col-lg-4">
                <div class="card mb-4" style="width: 18rem;">
                    <a href="{{ '/articles/show/' . $article->id }}"><img src="{{ asset('image/'.$article->image) }}" class="card-img-top" alt="..."></a>
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <?php 
                            $con = $article->content;
                            $content = Str::substr($con, 0, 100)
                        ?>
                        <p class="card-text ">{{ $content }}<a href="{{ '/articles/show/' . $article->id }}"> <i> Read more...</i></a></p>
                        <a href="{{ '/articles/edit/' . $article->id }}" class="btn btn-warning btn-sm">Update</a>
                        <a href="{{ '/articles/delete/' . $article->id }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?')">Delete</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
           
        </div>
        <div class="col-md-2">
                    <a href="articles/add" class="btn btn-secondary">Add Article</a>
        </div>
    </div>
</div>
@endsection
