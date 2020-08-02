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
    <a href="/">Главная страница</a>

    <h1>Панель администратора</h1>
    <h2>Список новостей</h2>
    <ul>

        <?php if (!empty($news)) {
            foreach ($news as $article) : ?>

                <li>
                    <a href="/article?id=<?php echo $article->id; ?>"><?php echo $article->title; ?></a>
                    -
                    <a href="/admin/edit?id=<?php echo $article->id; ?>">редактировать</a>
                    <span> | </span>
                    <a href="/admin/delete?id=<?php echo $article->id; ?>">удалить</a>
                </li>

            <?php endforeach;
        } else {
            echo 'Статей нет. Добавьте пожалуйста статьи по ссылке ниже';
        } ?>

    </ul>
    <a href="/admin/create">Добавить новость</a>
</div>
</body>
</html>
