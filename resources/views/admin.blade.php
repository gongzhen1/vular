<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Vular Admin</title>
        <link rel = "stylesheet"  type = "text/css"  href = "{{asset('/vular/css/admin.css')}}" />
    </head>
    <body>
        <div id="app">
        </div>

        <script type="text/javascript">
            window.host = "{{((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https:' : 'http:'}}//{{$_SERVER['HTTP_HOST']}}/api/vular/v1/";
            window.indexPage = '{{Water\Vular\Admin\Dashboard\Page::make()->pageId()}}'

            window.mediasApi = '{{mediasApi()}}'
            window.uploadMediaApi = '{{uploadMediaApi()}}'
            window.removeMediaApi = '{{removeMediaApi()}}'
            window.updateMediaApi = '{{updateMediaApi()}}'
            window.uploadMediaThumbnailApi = '{{uploadMediaThumbnailApi()}}'
            window.getMediaCateogriesApi = '{{getMediaCateogriesApi()}}'
            window.saveMediaCateogriesApi = '{{saveMediaCateogriesApi()}}'
            window.mediaOriginalsPath='/uploads/originals/';
            window.mediaThumbnailsPath='/uploads/thumbnails/';

        </script>

        <script src="{{asset('/vular/js/vular.js')}}">
        </script>
    </body>
</html>
