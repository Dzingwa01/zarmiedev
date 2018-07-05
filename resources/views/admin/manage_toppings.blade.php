@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')
    <div class="container-fluid box box-success">
        @if (session('status'))
            <div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col m3">
                <a id="add_topping" style="margin-top: 1em;" class="btn" data-toggle="modal" data-target="#add_topping_popup"><i
                            class="fa fa-plus"></i>Add Toppings</a><br/>
            </div>
            <br>
        </div>
        <div class="row">

            <div class="col m12">
                <table class="table table-bordered" id="topping-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Prize</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="add_topping_popup" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Add Menu Category</h4>
        </div>
        <div class="modal-body">
            <form class="col s12" method='post' enctype="multipart/form-data" action='/save_topping'>
                <input type="hidden" name="_token" value={{csrf_token()}} >
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Topping Name" id="name" name="name" type="text"
                               class="validate" required>
                        <label for="first_name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="description" name="description" placeholder="Topping Description"
                               type="text" class="validate" required>
                        <label for="description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="prize" name="prize" placeholder="Topping Prize" type="number" step="0.01"
                               class="validate" required>
                        <label for="prize">Prize</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <select id="category" name="category" required>
                            <option value="">**Please select topping category**</option>
                           <option value="standard">Standard - Free</option>
                            <option value="optional">Optional - Paid</option>
                        </select>
                    </div>
                </div>

                <div>
                    <input class="btn" type='submit' style="margin-left:12em!important;" value='Save'>
                </div>
            </form>
        </div>

    </div>

    @push('custom-scripts')
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">

    <script type="text/javascript" charset="utf8"
            src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="js/materialize.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.js"></script>
    <script src="js/init.js"></script>
    <script>
        $(document).ready(function () {

            $("#add_topping").on('click', function () {

                $("#add_topping_popup").modal('show');
            });

            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });

        });

    </script>
    <script>
        $(function () {
            $('#topping-table').DataTable({
                processing: true,
                serverSide: true,
                responsive:true,
                ajax: '{{route('toppings_list')}}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'prize', name: 'prize'},
                    {data: 'category', name: 'category'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
        });
        $('select').material_select();
    </script>

    @endpush
@endsection
