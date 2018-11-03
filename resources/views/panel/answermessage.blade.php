@extends('layout')

@section('title')
    <title>پاسخ به کاربر</title>
@endsection
@section('content')

    @if($message = session('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif

    <h3 class="page-header">
        پاسخ به کاربر
    </h3>

    @include('layouts.errors')
    @foreach($contactuss as $contactus)
    <form action="{{ route('panel.sendemail', ['contactus' => $contactus->id ]) }}" method="post" enctype="multipart/form-data">
        {!! csrf_field() !!}
        {{ method_field('PATCH') }}

        <div class="form-group">
            <label for="title">ایمیل : </label>
            <input type="email" name="email" class="form-control" id="email" value="{{ $contactus->email }}" placeholder="لطفا ایمیل را وارد کنید ...">
        </div>

        <div class="form-group">
            <label for="body">متن :</label>
            <textarea class="form-control" name="body" id="body" placeholder="متن ایمیل را وارد کنید" rows="7"></textarea>
        </div>
        <button type="submit" class="btn btn-default">ارسال ایمیل</button>
    </form>
    @endforeach
@endsection