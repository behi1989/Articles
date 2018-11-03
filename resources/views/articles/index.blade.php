@extends('layout')

@section('csrf')
    <meta name="_token" content="{{ csrf_token() }}">
@endsection

@section('title')
    <title>صفحه اصلی سایت</title>
@endsection

@section('content')

    @if($message = session('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    @include('layouts.errors')

    <!-- First Blog Post -->
    @foreach( $articles as $article )

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <span class="glyphicon glyphicon-paperclip" style="color: #007bff"></span>
                    <a href="{{ route('article.show', ['article' => $article->slug]) }}">{{ $article->title }}</a>
                </h3>
            </div>
            <div class="panel-body">
                <h4>
                    <small><span class="glyphicon glyphicon-user" style="color: #bf5329"></span> نویسنده: <a href="#">{{ $article->user->name }}</a></small>
                    <small> | <span class="glyphicon glyphicon-eye-open" style="color: #20c997"></span> تعداد بازدید: <a href="#">{{ $article->viewCount }}</a></small>
                    <small> | <span class="glyphicon glyphicon-stats" style="color: #bf5329"></span> تعداد نظرات: <a href="#">
                            {{ count($article->comments->where('approved', 1)) }}
                        </a></small>
                </h4>
                <p><span class="glyphicon glyphicon-time" style="color: #34ce57"></span> تاریخ انتشار: {{ jdate($article->created_at)->format('%d %B %Y') }}</p>
                <hr style="border: 1px dashed #17a2b8">
                <span class="glyphicon glyphicon-pushpin" style="color: #f0ad4e"></span> دسته بندی مقاله:
                <ul>
                    @foreach($article->categories()->pluck('name') as $category)
                        <li><a href="/article/category/{{$category}}">{{$category}}</a></li>
                    @endforeach
                </ul>

                <img class="img-responsive" src="{{ asset('images/'.$article->file) }}" alt="">
                <hr>
                <p>{!! $article->body !!}</p>
                <hr style="border: 1px dashed #17a2b8">
                <a class="btn btn-primary" href="{{ route('article.show', ['article' => $article->slug]) }}">ادامه  مطلب <span class="glyphicon glyphicon-chevron-left"></span></a>
            </div>
        </div>

    @endforeach


    <!-- Pager -->
    <div style="text-align:center;">
        {!! $articles->render() !!}
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $('#search').on('keyup',function(){

            $value=$(this).val();

            $.ajax({

                type : 'get',

                url : '{{URL::to('search')}}',

                data:{'search':$value},

                success:function(data){

                    $('tbody').html(data);

                }
            });

        })

    </script>

    <script type="text/javascript">
        $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
    </script>
@endsection