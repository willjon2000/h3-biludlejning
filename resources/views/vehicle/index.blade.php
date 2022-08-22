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

            .card {
                border-bottom: 0;
            }

            .no-width {
                width: 1px;
            }

            td.actions {
                white-space: nowrap;
            }

            td.actions > form {
                display: contents;
            }

            .text-right {
                text-align: end;
            }

            td.actions > form > button {
                background: transparent;
                border: unset;
                color: #0d6efd;
                text-decoration: underline;
                padding: unset;
            }
        </style>
    </head>
    <body>
        <div class="container main">
            <div class="text-right">
                <a href="{{ route('vehicle.create') }}">Opret</a>
            </div>
            <div class="card">
                <div class="card-header">Vehicles</div>
                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Type</th>
                                <th scope="col">Pris</th>
                                <th scope="col" class="no-width"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($vehicle as $v)
                            <tr>
                                <th scope="row">{{$v->id}}</th>
                                <td>{{$v['type']}}</td>
                                <td>{{$v['price']}}</td>
                                <td class="actions">
                                    <a href="{{ route('vehicle.edit', [ 'id' => $v->id ]) }}">Rediger</a> | 
                                    <form action="{{ route('vehicle.destroy', $v->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="">Slet</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    </body>
</html>