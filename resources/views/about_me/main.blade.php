@extends('layouts.main')
@section('description')
    @lang('main.description')
@endsection
@section('tag')
    @lang('main.tag')
@endsection
@section('title')
    @lang('main.title')
@endsection

@section('content')
    <div>
        <img class="me" src="img/about_me/zdj_biometryczne.jpg" alt="GM">
        @lang('main.first_me')
        <img class="me" style="float:right;" src="img/about_me/o_mnie1.jpg" alt="GM">
        @lang('main.second_me')
    </div>

@endsection
