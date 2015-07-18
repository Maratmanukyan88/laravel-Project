<!DOCTYPE html>

<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Nurture Automation</title>

    <link rel="stylesheet" href="{{elixir('css/app.css')}}" type="text/css">

    <!-- Bootstrap Core CSS -->
   <link rel="stylesheet" href="{!! URL::asset('/css/bootstrap.min.css')!!}" type="text/css">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="{!! URL::asset('/css/agency.css')!!}" type="text/css">
        <link rel="stylesheet" href="{!! URL::asset('/css/custom.css')!!}" type="text/css">
        <link rel="stylesheet" href="{!! URL::asset('/css/default.css')!!}" type="text/css">
        <link href="{!! URL::asset('/font-awesome/css/font-awesome.min.css')!!}" rel="stylesheet" type="text/css">

        <!-- Plugin CSS -->
        <link rel="stylesheet" href="{!! URL::asset('/css/automation.css')!!}" type="text/css">
        
        <script src="{!! URL::asset('/js/jquery.js')!!}"></script>
        <!-- Bootstrap Core JavaScript -->
        <script src="{!! URL::asset('/js/bootstrap.min.js')!!}"></script>
        <script src="{!! URL::asset('/js/wow.min.js')!!}"></script>
        <script src="{!! URL::asset('/js/drip.function.js')!!}"></script>
        
       <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
      <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
      <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
      <!--<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>-->
<!-- jQuery easing plugin -->
 <script src="{!! URL::asset('/js/php_file_tree_jquery.js')!!}"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>

<style>
        .for2{
            position:relative;
        }
        .login-wrap{
            margin:70px auto;
            width: 300px;
        }
        @media(max-width:992px){
            
        }
        @media(max-width:480px){
            .login-wrap{
                width:100%;  
            }
            .form-control2{
                height:auto;
            }
            .for2 button{
                padding:2%;
            }
        }
    </style>

</head>
<body id="page-top">

	@include('_partials.header')

	@yield('content')
        
	<!-- Scripts -->
    
        @yield('footer_css')
        @yield('footer_js')
</body>
</html>
