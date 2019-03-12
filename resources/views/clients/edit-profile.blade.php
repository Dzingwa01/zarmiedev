@extends('client_processing')

@section('content')

    <div class="container">

        <form class="card hoverable" col="col-md-11" role="form" method="POST" style="margin-top:2em;" action="{{url('/update-profile/'.$user->id)}}">
            <input id="_token" name="_token" value="{{ csrf_token() }}" hidden>
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <div class="row">
                <div class="input-field col s6">
                    <label for="name" class="active">First Name</label>
                    <input id='name' name="name" value="{{$user->name}}" type='text' required>

                </div>
                <div class="input-field col s6">
                    <label for="surname" class="active">Last Name</label>
                    <input id='surname' name="surname" value="{{$user->surname}}" type='text' required>

                </div>
            </div>
            <div class="row">
                <p id="name_p" class="col-md-6" style="color:black">
                    <label for="phone_number" class="active">Phone Number</label>
                    <input id='phone_number' name="phone_number" value="{{$user->phone_number}}" type='tel' required>
                </p>

                <div class="input-field col s6">
                    <label for="email" class="active">Email</label>
                    <input id='email' disabled="disabled" value="{{$user->email}}" type='email' required>
                </div>

            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="surname" class="active">Address</label>
                    <textarea class="materialize-textarea" name="physical_address" required>{{$user->physical_address}}</textarea>

                </div>
            </div>


            <div class="row" style="margin-top:2em;" >
                <div class="col offset-s2 col s2" style="margin-bottom:1em;">
                    <button id='cancel' class="btn waves-effect waves-light" onclick="dismiss()">Cancel
                    </button>
                </div>
                <div class="col offset-s2 col s2" style="margin-bottom:1em;">
                    <button id='register_new_account' type="submit" class="btn waves-effect waves-light">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>
        function dismiss(){
            window.history.back();
        }
    </script>

@endsection