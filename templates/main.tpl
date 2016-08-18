<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ title }}</title>
    <base href="{{ base_url }}">
    <meta name="description" content="{{ description }}">
    <meta name="keywords" content="{{ keywords }}">
    <script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
</head>
<body>
    {% include content_tpl ignore missing %}
</body>
</html>