<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Quiz Start</title>
</head>
<body>
        <h1>Приглашаем вас пройти тест по PHP</h1>
        <h3>{{$quizName}}</h3>
        <form action="/quiz/question1" method="post">

            <input type="submit" value="Начать тестирование">
            @csrf
        </form>
</body>
</html>
