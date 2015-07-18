@extends('app')

@section('content')
<div class="clearfix"></div>

<div id="login" class="container">
    <div class="row">
        <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 col-xs-12">

            <h1>LOGIN TO NURTURE AUTOMATIC</h1>
            @include('_partials.messages')

            {!! Form::open(['class' => 'form form-login form-default']) !!}
            <div class="get-in-touch">
                <div class="form-group">
                    <label>E-MAIL ADRESS</label>

                    {!! Form::email('email', old('email'), ['id' => 'email', 'placeholder'=>'e-mail address']) !!}

                </div>

                <div class="form-group">
                    <label>PASSWORD</label>

                    {!! Form::password('password', ['id' => 'password', 'placeholder'=>'Password']) !!}

                </div>

                <div class="form-group remember">
                    <label>
                        {!! Form::checkbox('remember') !!} Remember me
                    </label>
                </div>

                <div class="controls row form-group">
                    <div class="col-md-5">
                        {!! Form::button('LOGIN', ['class' => 'btn btn-primary btn-lg btn-block','type'=>'submit']) !!}
                    </div>

                    <div class="col-md-7 text-right">
                        <a href="{!! url('/auth/forgot') !!}">Forgotten your password?</a><br/>
                        <a href="{!! url('/auth/register') !!}">Register</a>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
</div>


</div>
</div>

@endsection

