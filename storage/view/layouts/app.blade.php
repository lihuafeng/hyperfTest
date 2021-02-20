<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no, viewport-fit=cover">
    <title>@yield('title','首页')| Site name</title>
    <meta name="keywords" content="@yield('meta_keywords','关键词')">
    <meta name="description" content="@yield('meta_description','描述')">
</head>
<body>
@section('sidebar')
    This is the master sidebar.
@show

<div class="container">
    @yield('content')
</div>
</body>
</html>
