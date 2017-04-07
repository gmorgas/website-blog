@extends('layouts.main')
@section('description')
    @lang('contact.description')
@endsection
@section('tag')
    @lang('contact.keywords')
@endsection
@section('title')
    @lang('contact.title')
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>@lang('contact.contact_me')</h1>
            <hr>
            @if (Session::has('success'))
                <div class="alert alert-success">{{ Session::get('success') }}</div>
            @endif
            <form action="{{ url(Lang::get('route.contact')) }}" method="post">
                <div class="form-group">
                    <label name="email">@lang('contact.email')</label>
                    <input id="email" name="email" class="form-control" placeholder="@lang('contact.example_mail')" value="{{ old('email') }}">
                    @if($errors->has('email')) <p class="error">{{ $errors->first('email') }}</p> @endif
                </div>
                <div class="form-group">
                    <label name="subject">@lang('contact.subject')</label>
                    <input id="subject" name="subject" class="form-control" placeholder="@lang('contact.example_subject')" value="{{ old('subject') }}">
                    @if($errors->has('subject')) <p class="error">{{ $errors->first('subject') }}</p> @endif
                </div>
                <div class="form-group">
                    <label name="message">@lang('contact.message')</label>
                    <textarea id="message" name="message" class="form-control" placeholder="@lang('contact.message_text')">{{ old('message') }}</textarea>
                    @if($errors->has('message')) <p class="error">{{ $errors->first('message') }}</p> @endif
                </div>
                <input type="submit" value="@lang('contact.submit_send')" class="btn btn-success">
                {{ csrf_field() }}
            </form>
        </div>
    </div>

@endsection
