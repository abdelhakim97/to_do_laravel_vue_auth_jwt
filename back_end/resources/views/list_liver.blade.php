<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Document</title>
</head>
<body>
    <div class="w-50 m-auto mt-5">
@if (session()->has('Success'))
   <div class="alert alert-info">
    {{session('Success')}}
    </div>
@endif


        <a href="{{route('livres.create')}}" class="btn btn-info">ADD</a>
    <table class="table">
        <thead> <tr><th>#id</th><th>title</th><th>prix</th><th>Action</th></tr></thead>
        <tbody>
    @forelse ($livres as $livre)
    <tr><td>{{$livre->id}}</td><td>{{$livre->title}}</td><td>{{$livre->prix}}</td><td> <form action="{{route('livres.destroy',$livre->id)}}" method="POST" > @csrf @method('DELETE') <button type="submit" class="btn btn-danger">supp</button> <a class="btn btn-primary" href="{{route('livres.edit',$livre->id)}}">update</a></form>   </td></tr>
    @empty
        <h4>pas d livres !!</h4>
    @endforelse
    

        
</tbody>
    </table>
</div>
</body>
</html>