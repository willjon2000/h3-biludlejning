<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>XYZ</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
        <style>
            .container.main {
                margin-top: 45px;
            }
        </style>
    </head>
    <body>
        <div class="container main">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Car</label>
                    <select name="vehicle_id">
                        @foreach ($vehicle as $v)
                            <option value="{{$v->id}}">{{$v->type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Addons</label>
                    @foreach ($addon as $a)
                    <input class="form-check-input" type="checkbox" name="addons[]" value="{{$a->id}}">
                    <label class="form-check-label">
                        {{$a->type}}
                    </label>
                    @endforeach
                </div>
                <div class="mb-3">
                    <label class="form-label">Name</label>
                    <input type="text" name="fullname" value="{{old('fullname')}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="text" name="email" value="{{old('email')}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Phone</label>
                    <input type="number" name="phone" value="{{old('phone')}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">Start date</label>
                    <input type="datetime-local" name="start_timestamp" value="{{old('start_timestamp')}}" class="form-control">
                </div>
                <div class="mb-3">
                    <label class="form-label">End date</label>
                    <input type="datetime-local" name="end_timestamp" value="{{old('start_timestamp')}}" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
