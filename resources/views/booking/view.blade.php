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
            <b>Name</b><br>
            {{$booking->contact->fullname}}<br>
            <b>Email</b><br>
            {{$booking->contact->email}}<br>
            <b>Phone</b><br>
            {{$booking->contact->phone}}<br>
            <b>Vehicle</b><br>
            {{$booking->vehicle->type}} = {{$booking->vehicle->price}} kr.<br>
            <b>Start date</b><br>
            {{$booking['start_timestamp']}}<br>
            <b>End date</b><br>
            {{$booking['end_timestamp']}}<br>

            <div class="table-responsive">
                <table class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Addone type</th>
                            <th scope="col">Price</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($booking->addons as $a)
                        <tr>
                            <th scope="row">{{$a->id}}</th>
                            <td>{{$a->type}}</td>
                            <td>{{$a->price}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>
