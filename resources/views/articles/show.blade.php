@extends('layout')

@section('content')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{ $article->title }}</h1>

    <!-- Author -->
    <p class="lead">
        ارسال شده توسط <a href="index.php">{{ $article->user->name }}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> ارسال شده در تاریخ  {{  jdate($article->created_at)->format('%B %d، %Y') }}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="http://placehold.it/900x300" alt="">

    <hr>

    <!-- Post Content -->
    {!! $article->body !!}
    <hr>

    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        @include('layouts.errors')
        @if(auth()->check())
        <h4>ارسال کامنت :</h4>
        <hr>
        <form role="form" method="post" action="{{ route('comment.store' , ['article' => $article->slug ]) }}">
            {!! csrf_field() !!}

            <div class="form-group">
                <label for="title">متن: </label>
                <textarea class="form-control" name="body" rows="3"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">ارسال</button>
        </form>
        @else
            <a href="/register">برای ارسال کامنت ابتدا عضو شوید</a>
        @endif
    </div>

    <hr>

    <!-- Posted Comments -->

    <!-- Comment -->
    @foreach($comments as $comment)
    <div class="media">
        <div class="media-body">
            <h4 class="media-heading">{{ $comment->user->name }}
                <small>ارسال شده در تاریخ  {{  jdate($article->created_at)->format('%B %d، %Y') }}</small>
            </h4>
            {{ $comment->body }}
        </div>
    </div>
    @endforeach

@endsection