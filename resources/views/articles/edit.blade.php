@extends('layout')

@section('title')
    <title>ویرایش مقاله</title>
@endsection

@section('content')
    <h1 class="page-header">
        ویرایش مقاله
    </h1>

    @if(count($errors))
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('article.update', ['article' => $article->slug]) }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="title">عنوان مقاله : </label>
            <input type="text" name="title" class="form-control" id="title" value="{{ $article->title }}" placeholder="لطفا عنوان را وارد کنید ...">
        </div>
        <div class="form-group">
            <label for="category">دسته بندی ها : </label>
            <select name="category[]" class="form-control" id="category" title=" دسته بندی مورد نظر خود را انتخاب کنید..." multiple>
                @foreach( $categories as $id => $name )
                    <option value="{{ $id }}" {{ in_array($id, $article->categories()->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for=""upload>تصویر فعلی :</label>
            @if('images/'.$article->file)
                <img src="{{ asset('images/'.$article->file) }}" alt="">
            @else
                <p>تصویری یافت نشد.</p>
            @endif
            <br>
        </div>
        <div class="form-group">
            <label for="upload">انتخاب تصویر</label>
            <input type="file" name="file" value="{{ $article->file }}">
        </div>
        <div class="form-group">
            <label for="body">متن مقاله :</label>
            <textarea class="form-control" name="body" id="body" placeholder="متن را وارد کنید" rows="7">{{ $article->body }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">ویرایش مقاله</button>
    </form>
@endsection

@section('styles')
    <link href="/css/bootstrap-select.min.css" rel="stylesheet">
@endsection

@section('scripts')
    <script src="/js/bootstrap-select.min.js"></script>

    <script>
        $('#category').selectpicker();
    </script>
@endsection