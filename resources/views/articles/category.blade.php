@extends('layout')

@section('title')
    <title>درج دسته</title>
@endsection

@section('content')
    <h1 class="page-header">
        درج دسته
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

    <form action="{{route('category.store')}}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">عنوان دسته : </label>
            <input type="text" name="category" class="form-control" id="category" value="{{ old('category') }}" placeholder="لطفا عنوان دسته را وارد کنید ...">
        </div>
        <button type="submit" class="btn btn-default">درج دسته</button>
    </form>
@endsection

