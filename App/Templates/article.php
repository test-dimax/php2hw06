<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Страница новости</title>
</head>
<body>
<ul>
    <li><a href="/">Страница новостей</a></li>
</ul>

<h1><?php echo $article->title; ?></h1>
<div>
    <p>Автор: <?php echo $article->author->name; ?></p>
    <p>Текст: <?php echo $article->contents; ?></p>
</div>
</body>
</html>
