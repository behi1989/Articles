@extends('layout')

@section('title')
    <title>جستجوی مقاله</title>
@endsection

@section('content')

    @if($message = session('message'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @endif
    <h3 class="page-header">
        نتیجه جستجو
    </h3>

    @include('layouts.errors')



@endsection