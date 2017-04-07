@extends('layouts.main')
@section('description')
    @lang('wine.description')
@endsection
@section('tag')
    @lang('wine.keywords'), {{ $content->tags }}
@endsection
@section('title')
    @lang('wine.title')
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="contentWidth">
        <div class="navUp">
            <a href="/">@lang('bee.start')</a> >> <a href="{{ env('APP_URL').'/'.Lang::get('route.wine') }}">@lang('main.wine')</a> >> <a href="{{ env('APP_URL').'/'.Lang::get('route.bee').'/'.$content->slug }}">{{ $content->subject }}</a>
            <form action="search.php" method="post">
                <input class="searchBox" type="search" id="search-input" name="q" placeholder="Wpisz szukaną frazę…" required>
                <input class="search" type="submit" value="">
            </form>
        </div>
        <div class="contentFlex">
            <div class="mainContent">
                <div class="contentBody">
                        <h1>{{ $content->subject }}</h1>
                    <div class="wrapContent">
                        <p>{!! unserialize($content->content) !!}</p>
                    </div>
                    <hr>
                    <form action="{{ route('wineSearch') }}" method="post">
                        {{ csrf_field() }}
                        <b>@lang('bee.tag')</b>
                        @foreach(explode(',', $content->tags) as $tag)
                            <input type="submit" name="q" class="label-default" value="{{ $tag }}">
                        @endforeach
                    </form>
                    <p class="date">@lang('bee.add') {{ $content->created_at }}</p>
                    <div class="comments">
                        <h4>Ilość komentarzy: {{ count($comments) }}</h4>
                        <hr>
                        @foreach($comments as $comment)
                            <div>
                                <i>{{$comment->nick}}</i><br/>
                                <i style="color:#ff0000; font-size:12px;">{{ $comment->created_at }}</i>
                                <p>{{ $comment->comment }}</p>
                                <hr>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div id="comment-form">
                    {{ Form::open(['route' => ['comments', $content->id], 'method' => 'POST']) }}

                    <div class="row">
                        <div class="col-md-6">
                            {{ Form::label('name', Lang::get('bee.name')) }}
                            {{ Form::text('name', null, ['class' => 'form-control']) }}
                            @if($errors->has('name')) <p class="error">{{ $errors->first('name') }}</p> @endif
                        </div>
                        <div class="col-md-6">
                            {{ Form::label('email', Lang::get('bee.email')) }}
                            {{ Form::text('email', null, ['class' => 'form-control']) }}
                            @if($errors->has('email')) <p class="error">{{ $errors->first('email') }}</p> @endif
                        </div>
                        <div class="col-md-12">
                            {{ Form::label('comment', Lang::get('bee.comment')) }}
                            {{ Form::textarea('comment', null, ['class' => 'form-control', 'rows' => '5']) }}
                            @if($errors->has('comment')) <p class="error">{{ $errors->first('comment') }}</p> @endif
                            {{ Form::submit(Lang::get('bee.addComment'), ['class' => 'btn btn-success']) }}
                        </div>
                    </div>
                    {{ Form::close() }}
                </div>
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
