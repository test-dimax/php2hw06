<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Новости</title>
</head>
<body>

<h1>Новости</h1>

<a href="/admin">Панель администратора</a>

<?php foreach ($news as $article) : ?>

    <article>
        <h2>
            <a href="<?php echo '/article?id=' . $article->id; ?>"><?php echo $article->title ?></a>
        </h2>
        <p>Автор: <?php echo $article->author->name ?></p>
        <p>Текст: <?php echo $article->contents ?></p>
        <br>
    </article>
    <hr>

<?php endforeach; ?>

</body>
</html>
