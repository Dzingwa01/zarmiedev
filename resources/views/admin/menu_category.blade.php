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
                <a id="add_category" style="margin-top: 1em;" class="btn" data-toggle="modal" data-target="#add_category_popup"><i
                            class="fa fa-plus"></i>Add Menu Category</a><br/>
            </div>
            <br>
        </div>
        <div class="row">

            <div class="col m12">
                <table class="table table-bordered" id="menu-table">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Picture Url</th>
                        <th>Created At</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    <div id="add_category_popup" class="modal" role="dialog">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title center">Add Menu Category</h4>
        </div>
        <div class="modal-body">
            <form class="col s12" method='post' enctype="multipart/form-data" action='/save_category'>
                <input type="hidden" name="_token" value={{csrf_token()}} >
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input placeholder="Category Name" id="category_name" name="category_name" type="text"
                               class="validate" required>
                        <label for="first_name">Category</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6 offset-m2">
                        <input id="category_description" name="category_description" placeholder="Category Description"
                               type="text" class="validate" required>
                        <label for="category_description">Description</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 offset-m2">
                        <label  for="category_image">Category Image</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col s6 offset-m2">
                        <img id="cat_image" src="" class="img-responsive"/>
                    </div>
                </div>
                <div class="row">

                    <div class="input-field col s6 offset-m2">

                        <input id="category_image" name="category_image" type="file" class="validate" onchange="preview_file()" accept="image/*">
                        <!-- <label for="category_image">Image</label> -->
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
            $('select').material_select();
            $("#add_category").on('click', function () {

                $("#add_category_popup").modal('show');
            });

            $(".alert").fadeTo(2000, 500).slideUp(500, function(){
                $(".alert").slideUp(500);
            });

        });

    </script>
    <script>
        $(function () {
            $('#menu-table').DataTable({
                processing: true,
                serverSide: true,
                responsive:true,
                ajax: '{{route('menu_item_category')}}',
                columns: [
                    {data: 'category_name', name: 'category_name'},
                    {data: 'description', name: 'description'},
                    {data: 'picture_url', name: 'picture_url'},
                    {data: 'created_at', name: 'menu_item.created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ]
            });
//                $('select[name="menu-table_length"]').css("display","inline");
        });
    </script>
    <script>
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

        //        preview_file();
    </script>
    @endpush
@endsection
