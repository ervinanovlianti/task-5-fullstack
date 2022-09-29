@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">{{ __('Read More') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h2>{{ $article->title }}</h2>
                    <p class="text-start"><b>Author By : </b> {{ $article->user->name }}</p>
                    <img src="{{ asset('image/'.$article->image) }}" class="card-img-top" \>
                    <p>{{ $article->content }}</p>
                    {{-- <p><b>Create at : </b>{{ $article->created_at }}</p> --}}
                        <a href="{{ '/home' }}" class="btn btn-secondary btn-sm">Back</a>
                        <a href="{{ '/articles/edit/' . $article->id }}" class="btn btn-warning btn-sm">Edit</a>
                        <a href="{{ '/articles/delete/' . $article->id }}" class="btn btn-danger btn-sm" onclick="Confirm('Yakin Ingin Menghapus data ini?')">Delete</a>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection