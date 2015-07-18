@extends('app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 col-xs-12">
            <h2 class="text-uppercase">Profile</h2>

            @include('_partials.messages')

            {!! Form::model($user, ['class' => 'form form-profile form-default']) !!}

                <div class="form-group">
                    <label>E-MAIL</label>
                    {!! Form::email('email', old('email')) !!}
                </div>

                <div class="form-group">
                    <label>FIRST NAME*</label>
                    {!! Form::text('firstname', old('username')) !!}
                </div>
                
                <div class="form-group">
                    <label>LAST NAME*</label>
                    {!! Form::text('lastname', old('username')) !!}
                </div>
                <div class="form-group">
                    <label>PHONE*</label>
                    {!! Form::text('phone', old('phone')) !!}
                </div>
                <div class="form-group">
                    <label>COMPANY*</label>
                    {!! Form::text('company', old('company')) !!}
                </div>
                <div class="form-group">
                    <label>NEW PASSWORD</label>
                    {!! Form::password('new_password') !!}
                </div>
                <div class="form-group password">
                    <label>REPEAT NEW PASSWORD</label>
                    {!! Form::password('password_confirmation') !!}
                </div>
                <div class="form-group password">
                    <label>CURRENT PASSWORD</label>
                    {!! Form::password('password') !!}
                </div>
                <div class="form-group" style="margin-bottom: 20px;">
                    {!! Form::button('UPDATE', ['class' => 'btn btn-primary btn-lg btn-block', 'type'=>'submit']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

