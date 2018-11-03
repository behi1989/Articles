@extends('layout')

@section('title')
    <title>ویرایش دسته بندی</title>
@endsection

@section('content')
    <h1 class="page-header">
        ویرایش دسته بندی
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

    <form action="{{route('category.update', ['category' => $category->name])}}" method="post">
        {!! csrf_field() !!}
        {{ method_field('PATCH') }}
        <div class="form-group">
            <label for="title">عنوان دسته : </label>
            <input type="text" name="name" class="form-control" id="name" value="{{ $category->name }}" placeholder="لطفا عنوان دسته را وارد کنید ...">
        </div>
        <button type="submit" class="btn btn-default">ویرایش دسته</button>
    </form>
@endsection