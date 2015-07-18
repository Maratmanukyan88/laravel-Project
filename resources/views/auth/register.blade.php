@extends('app')

@section('content')
<div id="register" class="container">
    <div class="row">
        <div class="col-md-8 col-left">
            <h1>Register For your
                Marketing Automation</h1>
            <p>Integer bibendum tincidunt dapibus. Vestibulum egestas vel diameu bibendum. Vivamus ultrices vehicula ultrices. Nunc elit est, porttitor vel facilisis sed, volutpat at magna. Sed a eros in ante maximus dictum. Mauris lobortis et augue non semper. Cras iaculis ex quis purus maximus ornare. Aliquam volutpat porta posuere. Proin ut aliquet nulla. Vestibulum dictum nisl condimentum 
                pharetra efficitur.</p>
        </div>
        <div class="col-md-4 col-right">
            {!!Form::open(['class' => 'form form-default','data-toggle'=>'validator'])!!}
            
            <div class="get-in-touch">
                <h2>Please complete your details</h2>

                @include('_partials.messages')

                <div class="form-group">
                    <label>USER NAME*</label>
                    {!! Form::text('username', old('username')) !!}
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
                    <label>EMAIL*</label>
                    {!! Form::text('email', old('email'), ['id'=>'Email']) !!}
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
                    <label>PASSWORD*</label>
                    {!! Form::password('password') !!}
                </div>

                <div class="form-group">
                    <label>PASSWORD CONFIRMATION*</label>
                    {!! Form::password('password_confirmation') !!}
                </div>


                <div class="form-group">
                    <label>CRM</label>
                    <div class="controls">
                        {!! Form::select('crm', ['Please select', 'Please select'], null) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::checkbox('fromna') !!} Yes, I would like to receive offers and information from NA
                </div>

                <div class="form-group" style="margin-bottom: 20px;">
                    {!! Form::button('REGISTER', ['class' => 'btn btn-primary btn-lg btn-block', 'type'=>'submit']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
