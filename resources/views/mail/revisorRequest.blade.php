<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Presto.it</title>
</head>
<body>
    <p>
        {{__('ui.user')}}: {{$user->name}}  {{__('ui.text')}} , <a href="{{route('makeRevisor', compact('user'))}}">{{__('ui.click2')}}</a> {{__('ui.text2')}}
 
    </p>
    <span>{{__('ui.indirizzo')}}: {{$user->email}}</span>
</body>
</html>