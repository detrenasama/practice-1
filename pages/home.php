<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Практическое задание №1</title>

    <link rel="stylesheet" href="/css/style.css">
</head>

<body>
    <div class="wrapper page-center">
        <form action="/form/send" method="post">
            <div class="card">
                <div class="card__header">
                    <div class="card__item">
                        <h1>Отправьте нам сообщение!</h1>
                    </div>
                </div>

                <?php if ($errors && !$errors->empty()): ?>
                    <div class="error-block">
                        <?php while (!$errors->empty()): ?>
                            <div class="error-block__item"><?= $errors->pop() ?></div>
                        <?php endwhile ?>
                    </div>
                <?php endif ?>

                <div class="card__item input-group">
                    <label for="field-name">Как Вас зовут? *</label>
                    <input id="field-name" name="name" type="text" placeholder="Иван Иванов" value="<?= htmlspecialchars($userInput['name']) ?: '' ?>">
                    <?php /* example of input error text
                    <div class="error">Error text</div>
                    */?>
                </div>

                <div class="card__item input-group">
                    <label for="field-email">E-mail для связи *</label>
                    <input id="field-email" name="email" type="email" placeholder="example@domain.com" value="<?= htmlspecialchars($userInput['email']) ?: '' ?>">
                </div>

                <div class="card__item input-group">
                    <label for="field-message">Сообщение</label>
                    <textarea id="field-message" name="message" cols="30" rows="10"><?= htmlspecialchars($userInput['message']) ?></textarea>
                </div>

                <div class="card__footer">
                    <div class="card__item text-center">
                        <input type="submit" class="button button_big" value="Отправить">
                    </div>
                </div>
            </div>
        </form>
    </div>
</body>

</html>