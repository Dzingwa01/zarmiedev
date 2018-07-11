@extends('adminlte::layouts.app')

@section('htmlheader_title')
    {{ trans('adminlte_lang::message.home') }}
@endsection
@section('main-content')

    <div class="container-fluid box box-success">
        @if (session('status'))
            <div class="alert alert-success"><a href="#" class="close" data-dismiss="alert"
                                                aria-label="close">&times;</a>
                {{ session('status') }}
            </div>
        @elseif(session('error'))
            <div class="alert alert-danger"><a href="#" class="close" data-dismiss="alert"
                                               aria-label="close">&times;</a>
                {{ session('error') }}
            </div>
        @endif
        <div class="row">
            <div class="col m3">
                <a id="add_menu" style="margin-top: 1em;" class="btn" data-toggle="modal"
                   data-target="#add_drink_popup"><i
                            class="fa fa-plus"></i>Add Drink Category</a><br/>
            </div>
            <br>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered" id="menu-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>


    <div id="add_drink_popup" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Add Drink Category</h4>
        </div>
        <div class="modal-body">
            <form class="col s12" role="form" method="POST" action="{{ route('store_drink_category') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Drink Name" id="name" name="name" type="text" class="validate"
                               required>
                        <label for="name">Name</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <textarea id="description" name="description" placeholder="Enter drink description"
                                  class="materialize-textarea" required></textarea>
                        <label for="description">Description</label>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 col-md-offset-4">
                        <button type="submit" class="btn btn-primary"><i class="material-icons left">add</i>
                            Save
                        </button>
                    </div>
                    <div>
                        {{-- <a class="btn" style="margin-left:12em!important;"   onclick="add_category()"> Save</a> --}}
                    </div>
                </div>
            </form>
        </div>

    </div>
    @push('custom-scripts')
    {{--<script src="https://code.jquery.com/jquery-3.3.1.min.js"--}}
    {{--integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="--}}
    {{--crossorigin="anonymous"></script>--}}
    <link href="/css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.15/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8"
            src="//cdn.datatables.net/1.10.15/js/jquery.dataTables.js"></script>
    <script src="js/materialize.js"></script>
    <script src="js/init.js"></script>

    <script>
        $(document).ready(function () {
//            $("#item_prize_div").hide();
            $('#item_type').material_select();
            $("#add_category").on('click', function () {

                $("#add_category_popup").modal('show');
            });
            $("#add_menu").on('click', function () {

                $("#add_menu_popup").modal('show');
            });
            $(".alert").fadeTo(2000, 500).slideUp(500, function () {
                $(".alert").slideUp(500);
            });
//            $('input:radio').click(function () {
//                var is_free = $(this).val();
////                console.log("value", is_free);
//                if (is_free == "free") {
//                    $("#item_prize_div").hide();
//                } else {
//                    $("#item_prize_div").show();
//                }
//            });
        });
        function preview_file(){
            var preview = document.getElementById("cat_image"); //selects the query named img
            var file    = document.querySelector('input[type=file]').files[0]; //sames as here
            var reader  = new FileReader();

            reader.onloadend = function () {
                preview.src = reader.result;
            }

            if (file) {
                reader.readAsDataURL(file); //reads the data as a URL
            } else {
                preview.src = "";
            }
        }
        function add_category() {
            alert('Coming Soon');
        }
    </script>

    <script>

        $(function () {
            $('#menu-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{route('drink_categories_list')}}',
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
            $('select[name="menu-table_length"]').css("display", "inline");
        });
    </script>
    @endpush
@endsection
