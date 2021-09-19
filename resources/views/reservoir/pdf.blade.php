<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$reservoir->title}}</title>
    <style>
        div {
            margin: 7px;
            padding: 7px;
        }
        .master {
            font-size: 18px;
        }
        .about {
            font-size: 11px;
            color: gray;
        }
        .color {
            margin: 12px;
            font-size: 25px;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <h1>{{$reservoir->title}}</h1>
    <div class="size">Size: {{$reservoir->area}}</div>
    <div class="about">{!!$reservoir->about!!}</div>
    <div class="master">Member: {{$reservoir->getMembers->name}} {{$reservoir->getMembers->surname}} {{$reservoir->getMembers->live}}</div>
</body>
</html>