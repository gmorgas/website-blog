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
    <script type="text/javascript" src="/js/tiny_mce/tiny_mce_src.js"></script>
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{{ asset('img/favicons.png') }}}">
    <script>
        tinymce.init({
            language : "pl",
            selector: 'textarea',

            plugins: "autolink,lists,spellchecker,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",

            theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontselect,fontsizeselect,|,code,|,fullscreen",
            theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,|,insertdate,inserttime,preview,|,forecolor,backcolor",
            theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl",
            theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,insertfile,insertimage ",

            // ustawienia przycisków
            theme : "advanced",
            theme_advanced_toolbar_location : "top",
            theme_advanced_toolbar_align : "left",
            theme_advanced_statusbar_location : "bottom",
            theme_advanced_resizing : true,

            template_external_list_url : "js/template_list.js",
            external_link_list_url : "js/link_list.js",
            external_image_list_url : "js/image_list.js",
            media_external_list_url : "js/media_list.js",

            entity_encoding : "raw",

        });
    </script>
</head>

<body>
<div class="content">
    <h1>Eytujesz wpisz nr: {{ $post->id }}</h1>
    <hr>
    {{ Form::open(['route' => ['update', $post->id],  'method' => 'POST']) }}
    {{ Form::label('title', 'Title:') }}
    {{ Form::text('title', $post->subject, array('class' => 'form-control', 'style' => 'width: 80%;', 'required' => '', 'maxlength' => '255')) }}

    {{ Form::label('slug', 'Slug:') }}
    {{ Form::text('slug', $post->slug, array('class' => 'form-control',  'style' => 'width: 80%;', 'required' => '', 'minlength' => '5', 'maxlength' => '255')) }}

    {{ Form::label('category_id', 'Category:') }}
    <select class="form-control" style="width:80%;" name="category">
        <option value="@lang('route.bee')">@lang('route.bee')</option>
        <option value="@lang('route.wine')">@lang('route.wine')</option>
    </select>


    {{ Form::label('tags', 'Tags:') }}
    {{ Form::text('tags', $post->tags, array('class' => 'form-control', 'style' => 'width: 80%;', 'required' => '', 'maxlength' => '255')) }}

    {{ Form::label('body', "Post Body:") }}
    {!! Form::textarea('body', unserialize($post->content), array('class' => 'form-control')) !!}

            <dl class="dl-horizontal">
                <dt>Created At:</dt>
                <dd>{{ date('M j, Y h:ia', strtotime($post->created_at)) }}</dd>
            </dl>

            <dl class="dl-horizontal">
                <dt>Last Updated:</dt>
                <dd>{{ date('M j, Y h:ia', strtotime($post->updated_at)) }}</dd>
            </dl>
            <hr>

                <div class="col-sm-6">
                    {!! Html::linkRoute('show', 'Cancel', array($post->id), array('class' => 'btn btn-danger')) !!}
                </div>
                <div class="col-sm-6">
                    {{ Form::submit('Save Changes', array('class' => 'btn btn-success')) }}
                </div>

    {!! Form::close() !!}

</div>
</body>