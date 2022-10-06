@extends('layouts.news-page');
@section('content')
    <div class="container article-page">
        <div class="row">
            @auth
                <!-- Button trigger editArticleModal -->
                <div class="col-lg-2">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal"
                            data-bs-target="#editArticle{{$article->id}}">
                        EDIT ARTICLE
                    </button>
                </div>
                <!-- editArticleModal -->
                <div class="modal fade" id="editArticle{{$article->id}}" tabindex="-1"
                     aria-labelledby="editArticleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editArticleModalLabel">Edit article</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{asset('/articles-update/'. $article->id)}}"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div>
                                        <label for="title">Edit title</label>
                                        <input id="title" name="title" value="{{$article->title}}">
                                    </div>
                                    <div>
                                        <label for="articleContent">Edit content</label>
                                        <input id="articleContent" name="articleContent" value="{{$article->content}}">
                                    </div>
                                    <div>
                                        <label for="image">Add image here: </label>
                                        <input type="file" name="image"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2">
                    <form method="post" action="{{asset('/articles-delete')}}">
                        @csrf
                        <input type="hidden" name="id" value="{{$article->id}}"/>
                        <button class="btn btn-danger" type="submit">
                            DELETE
                        </button>
                    </form>
                </div>
            @endauth
        </div>
        <div class="row articles">
            <h1>{{$article->title}}</h1>
            <small>{{$article->created_at}}</small>
            <br>
            <small>Author: {{$article->user->username}}</small>
            <br>
            <span class="underline"></span>
            @if(isset($article->image))
                <img class="article-attachment" src="{{asset('storage/'.$article->image)}}" alt="no-image">
            @endif
            <p>{{$article->content}}</p>
        </div>
        <div class="row comments">
            <h5>Comments: </h5>
            @foreach($article->comments as $comment)
                <div class="row">
                    <div>
                        <h6 class="nickname">{{$comment->nickname}} says: </h6>
                    </div>
                    <div class="col-md-8">
                        <p><i>{{$comment->content}}</i></p>
                    </div>
                    @auth
                        <!-- Button trigger editCommentModal -->
                        <div class="col-md-2">
                            <button type="button" class="btn nickname" data-bs-toggle="modal"
                                    data-bs-target="#editCommentModal{{$comment->id}}">
                                Edit
                            </button>
                        </div>
                        <div class="col-md-2">
                            <form method="post" action="{{asset('/comment-delete')}}">
                                @csrf
                                <input type="hidden" name="id" value="{{$comment->id}}"/>
                                <button class="btn nickname" type="submit">Delete</button>
                            </form>
                        </div>
                </div>

                <!-- editCommentModal -->
                <div class="modal fade" id="editCommentModal{{$comment->id}}" tabindex="-1"
                     aria-labelledby="editCommentModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editCommentModalLabel">Edit comment</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <form method="post" action="{{asset('/comment-update/'.$comment->id)}}">
                                <div class="modal-body">
                                    @csrf
                                    <div class="form-group">
                                        <label>Nickname: </label>
                                        <input type="text" name="nickname" class="form-control"
                                               value="{{$comment->nickname}}"/>
                                    </div>
                                    <div class="form-group">
                                        <label>Comment: </label>
                                        <input type="text" name="comment" class="form-control"
                                               value="{{$comment->content}}"/>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        Close
                                    </button>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                @endauth
            @endforeach
        </div>
    </div>
    <div class="container">
        <div class="">
            <form method="POST" action="{{asset('article/' . $article->id)}}">
                <div class="mb-3">
                    @csrf
                    <label for="nickname" class="form-label">
                        Enter your nickname:
                    </label>
                    @error('nickname')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form mb-3">
                        <input type="text" id="nickname" name="nickname"/>
                    </div>
                    <label for="comment" class="form-label">
                        Your comment:
                    </label>
                    @error('comment')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
                    <div class="form mb-3">
                        <textarea id="comment" name="comment"></textarea>
                    </div>
                    <div class=" form mb-3">
                    <span id="captcha_img">
                       {!! captcha_img() !!}
                    </span>
                        <button id="reload_button" type="button">Reload</button>
                    </div>
                    <div class="form mb-3">
                        @error('captcha')
                        <div style="color: red">{{ $message }}</div>
                        @enderror
                        <label for="captcha"></label>
                        <input type="text" id="captcha" name="captcha" placeholder="Enter value here..."/>
                    </div>
                    <input class="btn btn-dark" type="submit" value="submit"/>
                </div>
            </form>
        </div>
    </div>

@endsection
