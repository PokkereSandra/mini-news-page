@extends('layouts.news-page')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <form method="POST" action="{{asset('add-article')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        @error('title')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                        <label class="form-label" for="title">
                            Title:
                        </label>
                        <input class="form-control" type="text" id="title" name="title"/>
                    </div>
                    <div class="mb-3">
                        @error('content')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                        <label class="form-label" for="article">
                            Content:
                        </label>
                        <textarea class="form-control" id="article" name="article"></textarea>
                    </div>
                    <div>
                        <label for="image"></label>
                        <input type="file" name="image"/>
                    </div>
                    <button class="btn btn-dark form-control" type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
