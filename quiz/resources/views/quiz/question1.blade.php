<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Question1</title>
</head>
<body>
<h1>Вопрос №1</h1>
<form action="/quiz/question2" method="post">
    <h1>{{$question->getText()}}</h1>

    @foreach($question->getChoices() as $choice)
        <label for="">
            <input type="checkbox" name="answer[]" value="{{$choice->getUUid()}}">
            {{$choice->getText()}}
        </label> <br>
    @endforeach
    <br>

    <input type="submit" value="Следующий вопрос >">
    @csrf
</form>
</body>
</html>
