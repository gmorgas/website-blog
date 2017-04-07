<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('tag')">
    <meta name="robots" content="noodp">
    <meta name="robots" content="noydir">
    <meta name="author" content="Grzegorz Morgaś">
    <meta name="generator" content="Laravel">
    <meta name="revised" content="22.03.2017">

    <title>Grzegorz Morgaś</title>
    <!-- Style -->
    <link rel="stylesheet" href="/css/app.css">
    <!-- JS -->
    <script type="text/javascript" src="/js/app.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicons.png') }}}">


</head>

<body>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <h1>{{ $post->subject }}</h1>

            <p class="lead">{!! unserialize($post->content) !!}</p>

            <hr>
            @foreach($tag as $tags)
             <span class="label label-default">{!! $tags !!}</span>
            @endforeach

            {{--<div id="backend-comments" style="margin-top: 50px;">--}}
                {{--<h3>Comments <small>{{ $post->comments()->count() }} total</small></h3>--}}

                {{--<table class="table">--}}
                    {{--<thead>--}}
                    {{--<tr>--}}
                        {{--<th>Name</th>--}}
                        {{--<th>Email</th>--}}
                        {{--<th>Comment</th>--}}
                        {{--<th width="70px"></th>--}}
                    {{--</tr>--}}
                    {{--</thead>--}}

                    {{--<tbody>--}}
                    {{--@foreach ($post->comments as $comment)--}}
                        {{--<tr>--}}
                            {{--<td>{{ $comment->name }}</td>--}}
                            {{--<td>{{ $comment->email }}</td>--}}
                            {{--<td>{{ $comment->comment }}</td>--}}
                            {{--<td>--}}
                                {{--<a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-xs btn-primary"><span class="glyphicon glyphicon-pencil"></span></a>--}}
                                {{--<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></a>--}}
                            {{--</td>--}}
                        {{--</tr>--}}
                    {{--@endforeach--}}
                    {{--</tbody>--}}
                {{--</table>--}}
            {{--</div>--}}
        </div>

        <div class="col-md-4">
            <div class="well">

                <dl class="dl-horizontal">
                    <label>Category:</label>
                    <p>{{ $post->category }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Created At:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</p>
                </dl>

                <dl class="dl-horizontal">
                    <label>Last Updated:</label>
                    <p>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</p>
                </dl>
                <hr>
                <div class="row">
                    <div class="col-sm-6">
                        <a class="btn btn-primary btn-block" href="{{ route('edit', $post->id) }}">Edytuj</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{ Html::linkRoute('admin', '<< Pokaż wszystko', array(), ['class' => 'btn btn-xs btn-primary']) }}
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</body>