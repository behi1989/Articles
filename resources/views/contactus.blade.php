@extends('layout')

@section('title')
    <title>تماس با ما</title>
@endsection
@section('content')

    @if($message = session('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <h3 class="page-header">
        تماس با ما
    </h3>

    @include('layouts.errors')

    <form action="{{ route('contactus.send') }}" method="post">
        {!! csrf_field() !!}
        <div class="form-group">
            <label for="title">نام : </label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" placeholder="لطفا نام را وارد کنید ...">
        </div>

        <div class="form-group">
            <label for="title">ایمیل : </label>
            <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" placeholder="لطفا ایمیل را وارد کنید ...">
        </div>

        <div class="form-group">
            <label for="title">موبایل : </label>
            <input type="text" name="mobile" class="form-control" id="mobile" value="{{ old('mobile') }}" placeholder="لطفا شماره موبایل را وارد کنید ...">
        </div>

        <div class="form-group">
            <label for="body">متن :</label>
            <textarea class="form-control" name="body" id="body" placeholder="متن را وارد کنید" rows="7">{{ old('body') }}</textarea>
        </div>
        <button type="submit" class="btn btn-default">ارسال</button>
    </form>

@endsection