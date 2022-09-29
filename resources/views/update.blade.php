@extends('layouts.app')
@section('content')
<section class="section container">
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Details</h5>

                    <!-- General Form Elements -->
                    <form action="{{ '/articles/update/' . $article->id}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Title</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control " name="title" required="" value="{{ $article->title }}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Content</label>
                            <div class="col-sm-10">
                                <textarea class="form-control " style="height: 100px" name="content" required="">{{ $article->content}}</textarea>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Image</label>
                            <div class="col-sm-10">
                                <input disabled type="img" class="form-control " name="image"  value="{{ $article->image}}">
                                {{-- <input type="file" class="form-control " name="image" value="{{ $article->image}}"> --}}
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Category</label>
                            <div class="col-sm-10">
                                <select class="form-select " aria-label="Default select example" name="category_id" required="">
                                    <option disabled="" value="">Choose...</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $loop->iteration }}" {{ $category->id === $article->category_id ? 'selected' : ''}}>{{ $category->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-auto ">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                            <div class="col-2">
                                <a href="{{ route('home') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection