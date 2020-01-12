<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Vular Admin</title>
        <link rel = "stylesheet"  type = "text/css"  href = "{{asset('/vular/css/admin.css')}}" />
    <body>
        <div id="app">
            <v-card>
              dddd
            </v-card>
        </div>


        <script src="{{asset('/vular/js/vular-lib.js')}}">
        </script>
        <script type="text/javascript">new Vue({el:'#app'})</script>
    </body>
</html>
