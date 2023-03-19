<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- STYLE --}}
    <style>
        body{
            background-color: rgba(40, 163, 163, 0.303);
            border: 1px solid transparent;
            border-radius: 30px;
        }
      .text-center{
        text-align: center;
      }

      .text-small{
        font-size: 13px;
      }

      .image{
        width: 50%;
        height: 50%;
      }
    </style>
</head>

<body>
<h3>{{$project->type?->label}}</h3>
    {{-- Per le technologies un foreach --}}
    <div class="text-center">
        <h2>A new Project has been released!</h2>
        {{-- IMAGE --}}
        @if($project->image)
        <img class="image" src="{{asset('storage/'. $project->image)}}" alt="{{$project->slug}}">
        @endif
        
        <h3>{{ $project->title }}</h3>
        <img src="" alt="">
        <p class="text-small">{{$project->description}}</p>
        <span>{{$project->created_at}}</span>
    </div>
    
</body>
</html>