@extends('layout')

@section('content')
    <h1 class="page-header">
        ارسال مقاله
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

    <form action="{{route('article.store')}}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">عنوان مقاله : </label>
            <input type="text" name="title" class="form-control" id="title" value="{{ old('title') }}" placeholder="لطفا عنوان را وارد کنید ...">
        </div>
        <div class="form-group">
            <label for="category">دسته بندی ها : </label>
            <select name="category[]" class="form-control" id="category" title=" دسته بندی مورد نظر خود را انتخاب کنید..." multiple>
                @foreach( $categories as $id => $name )
                    <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="body">متن مقاله :</label>
            <textarea class="form-control" name="body" id="body" placeholder="متن را وارد کنید" rows="7">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">ارسال مقاله</button>
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