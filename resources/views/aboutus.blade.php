@extends('layout')

@section('title')
    <title>درباره ما</title>
@endsection

@section('content')

    @if($message = session('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <h3 class="page-header">
        درباره ما
    </h3>

    <p>طراحی و توسعه سایت توسط شرکت رش بیت انجام شده است.</p>

    @include('layouts.errors')



@endsection