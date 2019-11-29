<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'APILogger') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Styles -->
    <style type="text/css">
        body {
            font-family: 'Varela Round', sans-serif;
        }
        .modal-confirm {
            color: #636363;
            width: 400px;
        }
        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm .modal-header {
            display: block;
            border-bottom: none;
            position: relative;
        }
        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm .modal-body {
            color: #999;
        }
        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }
        .modal-confirm .modal-footer a {
            color: #999;
        }
        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }
        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }
        .modal-confirm .btn {
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            margin: 0 5px;
            outline: none !important;
        }
        .modal-confirm .btn-info {
            background: #c1c1c1;
        }
        .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
            background: #a8a8a8;
        }
        .modal-confirm .btn-danger {
            background: #f15e5e;
        }
        .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .modal-confirm-add {
            color: #636363;
            width: 400px;
        }
        .modal-confirm-add .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }
        .modal-confirm-add .modal-header {
            display: block;
            border-bottom: none;
            position: relative;
        }
        .modal-confirm-add h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }
        .modal-confirm-add .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }
        .modal-confirm-add .btn {
            color: #fff;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            margin: 0 5px;
            outline: none !important;
        }
    </style>
</head>
<body style="font-family: 'Nunito', sans-serif;font-size: 1rem;line-height: 1.6">
    <div class="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'IpChecker') }}
                </a>
            </div>
        </nav>

        <main class="py-4">
            <div class="container">
                <div class="w-100 d-flex justify-content-between">
                    <h3 class="text-center">IP List</h3>
                    <div class="form-group">
                        <button class="btn btn-success font-weight-bold btn-block"
                                data-toggle="modal" data-target="#add">
                            ADD IP ADDRESS
                        </button>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="list-group">
                    @forelse ($iplist as $key => $ip)
                        <div class="list-group-item list-group-item-action mt-2">
                            <div class="row w-100">
                                <h5 class="col-md-2 pt-2"><b>Group : </b> {{$ip->group}}</h5>
                                <h5 class="col-md-5 pt-2"><b>Description : </b> {{$ip->definition}}</h5>
                                <h5 class="col-md-3 pt-2"><b>IP :</b> {{$ip->ip}}</h5>
                                <span class="col-md-2" style="padding:0">
                                <button class="btn btn-danger font-weight-bold btn-block"
                                        data-toggle="modal" data-target="#delete" data-ip="{{$ip->ip}}">
                                    DELETE
                                </button>
                            </span>
                            </div>
                        </div>
                    @empty
                        <h5>
                            No Records
                        </h5>
                    @endforelse
                </div>
            </div>
        </main>
        <!-- Add Modal HTML -->
        <div id="add" class="modal fade">
            <div class="modal-dialog modal-confirm-add">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Ip Address</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('iplist.add')}}" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label for="group">Group</label>
                                <input type="text" class="form-control" id="group" name="group">
                            </div>
                            <div class="form-group">
                                <label for="definition">Definition</label>
                                <input type="text" class="form-control" id="definition" name="definition">
                            </div>
                            <div class="form-group">
                                <label for="ip">Ip Address</label>
                                <input type="text" class="form-control" id="ip" name="ip">
                            </div>
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Delete Modal HTML -->
        <div id="delete" class="modal fade">
            <div class="modal-dialog modal-confirm">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="icon-box" style="display: block">
                            <i class="material-icons">&#xE5CD;</i>
                        </div>
                        <h4 class="modal-title">Are you sure?</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body">
                        <p>Do you really want to delete these ip address? This process cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{route('iplist.delete')}}" method="POST">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <input type="hidden" id="ipAddress" name="ipAddress" value="">
                            <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.0/js/bootstrap.min.js" integrity="sha384-3qaqj0lc6sV/qpzrc1N5DC6i1VRn/HyX4qdPaiEFbn54VjQBEU341pvjz7Dv3n6P" crossorigin="anonymous"></script>
    <script>
        $(document).on('show.bs.modal','#delete', function (event) {
            let button = $(event.relatedTarget);
            $('#ipAddress').val(button.data('ip'));
        });
    </script>
</body>
</html>


