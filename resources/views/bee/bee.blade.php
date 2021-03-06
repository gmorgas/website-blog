@extends('layouts.main')
@section('description')
    @lang('bee.description')
@endsection
@section('tag')
    @lang('bee.keywords')
@endsection
@section('title')
    @lang('bee.title')
@endsection
@section('content')

    <div class="contentWidth">
        <div class="navUp">
            <a href="/">start</a> >> <a href="{{ env('APP_URL').'/'.Lang::get('route.bee') }}">@lang('main.bee')</a>
            <form action="{{ route('beeSearch') }}" method="post">
                <input class="searchBox" type="search" id="search-input" name="q" placeholder="Wpisz szukaną frazę…" required>
                <input class="search" type="submit" value="">
                {{ csrf_field() }}
            </form>
        </div>
        <div class="contentFlex">
            <div class="mainContent">
                @foreach($contents as $content)
                    <div class="contentText">
                        <h1><a href="{{ env('APP_URL').'/'.Lang::get('route.bee').'/'.$content->slug }}">{{ $content->subject }}</a></h1>
                        <div class="wrapContent">
                        <p>{!! \App\Http\Controllers\BeeController::truncate(unserialize($content->content), 1000) !!} </p>
                        </div>
                        <form action="{{ route('beeSearch') }}" method="post">
                            {{ csrf_field() }}
                            <b>@lang('bee.tag')</b>
                            @foreach(explode(',', $content->tags) as $tag)
                                <input type="submit" name="q" class="label-default" value="{{ $tag }}">
                            @endforeach
                            <a href="{{ route('beeShow', $content->slug) }}" class="btn btn-md btn-info more">@lang('bee.more')</a>
                        </form>
                        <p class="date">@lang('bee.add') {{ $content->created_at }}</p>
                    </div>

                @endforeach
                <div class="text-center">
                    {{ $contents->links() }}
                </div>
            </div>
            <div class="archive">
                <h3>@lang('bee.archive')</h3>
                @foreach($archive as  $mon)
                    <ul>
                        <a href="{{ route('beeMonth', substr($mon, 0, strpos($mon, ' '))) }}"><< {{ $mon }}</a>
                    </ul>
                @endforeach
            </div>
        </div>
    </div>

@endsection
