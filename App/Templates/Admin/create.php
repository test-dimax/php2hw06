<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Панель администратора</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<div class="container">
    <a href="/">Главная страница</a><br>
    <a href="/admin">Панель администратора</a><br>

    <h1>Создать новость</h1>

    <form action="/admin/save" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="author_id" value="1"><br><br>
        <input type="text" name="title" value=""><br><br>
        <textarea name="contents" cols="30" rows="10"></textarea><br><br>
        <button type="submit">Добавить</button>
    </form>

</div>
</body>
</html>
