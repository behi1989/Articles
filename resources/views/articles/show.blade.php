@extends('layout')

@section('title')
    <title>اطلاعات مقاله</title>
@endsection

@section('content')
    <!-- Blog Post -->

    <div class="panel panel-default">
        <!-- Title -->
        <div class="panel-heading">
            <h2 class="panel-title">
                <span class="glyphicon glyphicon-paperclip" style="color: #007bff"></span>
                {{ $article->title }}
            </h2>
        </div>

        <div class="panel-body">
            <!-- Author -->
            <h4>
                <small><span class="glyphicon glyphicon-user" style="color: #bf5329"></span> نویسنده: <a href="#">{{ $article->user->name }}</a></small>
                <small> | <span class="glyphicon glyphicon-eye-open" style="color: #20c997"></span> تعداد بازدید: <a href="#">{{ $article->viewCount }}</a></small>
                <small> | <span class="glyphicon glyphicon-stats" style="color: #bf5329"></span> تعداد نظرات: <a href="#">
                        {{ count($article->comments->where('approved', 1)) }}
                    </a></small>
            </h4>
            <!-- Date/Time -->
            <p><span class="glyphicon glyphicon-time" style="color: #34ce57"></span> تاریخ انتشار: {{  jdate($article->created_at)->format('%d %B %Y') }}</p>

            <hr style="border: 1px dashed #17a2b8"><span class="glyphicon glyphicon-pushpin" style="color: #f0ad4e"></span> دسته بندی مقاله:
            <ul>
                @foreach($article->categories()->pluck('name') as $category)
                    <li><a href="/article/category/{{$category}}">{{$category}}</a></li>
                @endforeach
            </ul>

            <!-- Preview Image -->
            <img class="img-responsive" src="{{ asset('images/'.$article->file) }}" alt="">

            <hr>

            <!-- Post Content -->
            {!! $article->body !!}
            <hr>

            <!-- Blog Comments -->

            <!-- Comments Form -->

            <div class="well">
                @include('layouts.errors')
                @if(auth()->check())
                    <span class="glyphicon glyphicon-send"></span> ارسال کامنت
                    <hr style="border: 1px dashed #0c5460">
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

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <span class="glyphicon glyphicon-comment"></span>
                        کامنت ها
                    </h4>
                </div>

            <!-- Posted Comments -->

            <!-- Comment -->
                <div class="panel-body" style="background-color: #f5f5f5">
                @foreach($comments as $comment)
                    <div class="media">
                        <div class="media-body">
                            @if($comment->approved == 1)
                                <h5 class="media-heading"><span class="glyphicon glyphicon-user" style="color: #0c5460"></span> <span style="color: #0c5460">نام کاربر: </span> {{ $comment->user->name }}
                                    <small>&nbsp;&nbsp;<span class="glyphicon glyphicon-time" style="color: #0c5460"></span> <span style="color: #0c5460">تاریخ ارسال: </span>{{  jdate($article->created_at)->format('%d %B %Y') }}</small>
                                </h5>
                                  <span style="color: #0c5460">متن کامنت:</span> {{ $comment->body }}
                            @endif
                        </div>
                    </div>

                    @if(! $loop->last )
                    <hr>
                    @endif
                @endforeach
                </div>
            </div>
        </div>
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