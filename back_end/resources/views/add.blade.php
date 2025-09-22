<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h2 class="text-center mb-4">ADD livers</h2>
            <form method="post" action="{{route('livres.store')}}">
              @csrf
              <div class="mb-3">
                <label for="title" class="form-label">title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="title... ">
              </div>
              <div class="mb-3">
                <label for="prix" class="form-label">prix</label>
                <input type="text" class="form-control" id="prix" name="prix" placeholder=" prix... ">
              </div>
              <button type="submit" class="btn btn-primary">Add</button>
            </form>
          </div>
        </div>
      </div>
</body>
</html>