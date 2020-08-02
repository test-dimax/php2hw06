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

    <h1>Редактировать новость</h1>

    <?php if (!empty($article)) { ?>

        <form action="/admin/save" value="<?php echo $article->id; ?>">
            <input type="hidden" name="author_id" value="<?php echo $article->author->id; ?>"><br><br>
            <input type="text" name="title" value="<?php echo $article->title; ?>"><br><br>
            <textarea name="contents" cols="30" rows="10"><?php echo $article->contents; ?></textarea><br><br>
            <button type="submit">Редактировать</button>
        </form>

    <?php } ?>

</div>
</body>
</html>
