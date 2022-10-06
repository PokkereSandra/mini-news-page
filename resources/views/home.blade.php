@extends('layouts.news-page')
@section('content')
    <div class="container">
        <div class="row article-page">
            @foreach($articles as $article)
                <div class="row articles">
                    <a href="{{asset('article/' . $article->id)}}" class="article-title-link">
                        <h3>{{$article->title}}</h3>
                    </a>
                    @if(isset($article->image))
                        <img class="article-attachment" src="{{asset('storage/'.$article->image)}}" alt="no-image">
                    @endif
                    <h6>Published at: {{$article->created_at}}</h6>
                    <p class="article-text">
                    {{ Str::limit(strip_tags($article->content), 300) }}
                    @if (strlen(strip_tags($article->content)) > 300)
                        <div>
                            <a href="{{asset('article/' . $article->id)}}" class="btn btn-secondary read-more">Read
                                More</a>
                        </div>
                        @endif
                        </p>
                        <p>
                            Comments: {{count($article->comments)}}
                        </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
