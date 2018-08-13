@extends('layouts.login_master')

@section('content')

<!-- main -->
    <div class="main">
        <h1></h1>
        <div class="main-w3lsrow">
            <!-- login form -->
            <div class="login-form login-form-left"> 
                <div class="agile-row">
                    <div class="head">
                        <h2>SIVES KOM</h2>
                        <span class="fa fa-lock"></span>
                    </div>                  
                    <div class="clear"></div>
                    <div class="login-agileits-top">
                    <form method="post" action="{{route('login')}}">    
                        {{-- <form method="post" id="login-form" action="#"> --}}
                       {{--  <form method="post" action="{{ url('/loginLDAP') }}"> --}}
                        {{ csrf_field() }}
 
                            <input type="text" class="name" name="email" Placeholder="Username" required>
                            <input type="password" class="password" name="password" Placeholder="Password" required>
                            <input type="submit" id="button" value="Login"> 
                        </form>     
                    </div> 
                </div>  
            </div>  
        </div>
@endsection
@section('script')
<script src="{{asset("vendor/jquery/jquery.min.js")}}"></script>
<script type="text/javascript">
    $(document ).ready(function() {
    console.log( "ready!" );
    $("#login-form").submit(function( event ) {
       $.ajax({
    type: 'POST',
    url: {{ url('/loginLDAP') }},
    headers: {
        "LTI-Authorization":"X-IPBAPI-TOKEN:Bearer 3e433708-0d6c-338e-9054-fe993aed2018"
    },
    data: {
       "lti_version":"${lti_version}" // all other data
    }
    }).done(function(data) { 
        alert(data); 
    });
           

      event.preventDefault();
    });
});

</script>
@endsection
