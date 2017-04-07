@extends('layouts.main')
@section('description')
    @lang('wine.description')
@endsection
@section('tag')
    @lang('wine.keywords')
@endsection
@section('title')
    @lang('wine.title')
@endsection
@section('content')

    <div class="contentWidth">
        <div class="navUp">
            <a href="/">start</a> >> <a href="{{ env('APP_URL').'/'.Lang::get('route.wine') }}">@lang('main.wine')</a>
            <form action="{{ route('wineSearch') }}" method="post">
                <input class="searchBox" type="search" id="search-input" name="q" placeholder="Wpisz szukaną frazę…" required>
                <input class="search" type="submit" value="">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="contentFlex">
            <div class="mainContent">
                <b>@lang('bee.search') "{{ $keywords }}" @lang('bee.searchRezult') {{ count($contents) }}</b>
                @foreach($contents as $content)
                    <div class="contentText">
                        <h1><a href="{{ env('APP_URL').'/'.Lang::get('route.wine').'/'.$content->slug }}">{{ $content->subject }}</a></h1>
                        <div class="wrapContent">
                            <p>{!! \App\Http\Controllers\BeeController::truncate(unserialize($content->content), 1000) !!} </p>
                        </div>
                        <form action="{{ route('wineSearch') }}" method="post">
                            {{ csrf_field() }}
                            <b>@lang('bee.tag')</b>
                            @foreach(explode(',', $content->tags) as $tag)
                                <input type="submit" name="q" class="label-default" value="{{ $tag }}">
                            @endforeach
                            <a href="{{ route('wineShow', $content->slug) }}" class="btn btn-md btn-info more">@lang('bee.more')</a>
                        </form>
                        <p class="date">@lang('bee.add') {{ $content->created_at }}</p>
                    </div>

                @endforeach

            </div>
            <div class="archive">
                <h3>@lang('bee.archive')</h3>
                @foreach($archive as  $mon)
                    <ul>
                        <a href="{{ route('wineMonth', substr($mon, 0, strpos($mon, ' '))) }}"><< {{ $mon }}</a>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

@endsection
