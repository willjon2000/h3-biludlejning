<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Log ind</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            .container.main {
                max-width: 35%;
                margin: 0;
                position: absolute;
                top: 50%;
                left: 50%;
                -ms-transform: translate(-50%, -50%);
                transform: translate(-50%, -50%);
            }
        </style>
    </head>
    <body>
        <div class="container main">
            @if($errors->any())
            <div class="alert alert-danger" role="alert">
                {!! implode('', $errors->all(':message')) !!}
            </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('authenticate') }}">
                        <div class="form-group mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Email adresse</label>
                            <input type="email" name="email" class="form-control" value="{{old('email')}}" placeholder="name@example.com">
                        </div>
                        <div class="form-group mb-3">
                            <label for="exampleFormControlInput1" class="form-label">Adgangskode</label>
                            <input type="password" name="password" class="form-control" value="{{old('password')}}" placeholder="•••••••••••••">
                        </div>
                        {{ csrf_field() }}
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Log ind</button>
                        </div>
                    </form>
                </div>
            </div>  
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>