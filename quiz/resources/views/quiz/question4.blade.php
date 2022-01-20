<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Question4</title>
</head>
<body>
<h1>Вопрос №4</h1>
<form action="/quiz/question5" method="post">
    <h1>{{$question->getText()}}</h1>

    @foreach($question->getChoices() as $choice)
        <label for="">
            <input type="checkbox" name="answer[]" value="{{$choice->getUUid()}}">
            {{$choice->getText()}}
        </label> <br>
    @endforeach
    <br>
    <input type="hidden" name="answersJson" value="{{$answersJson}}">
    <input type="submit" value="Следующий вопрос >">
    @csrf
</form>
</body>
</html>
