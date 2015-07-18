@extends('app')

@section('content')

<div id="user-edit" class="container">
    <div class="row">
        <div class="col-md-12">
            <h2 class="header-title text-uppercase">{!! trans('Users') !!}</h2>
        </div>
        <div class="col-md-12 content">
        	<h3 class="header-subtitle text-uppercase text-muted">Edit {{ $user->email }}</h3>

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

                <div class="form-group text-right" style="margin-bottom: 20px;">
                	<a href="{{URL::to('admin/user/password', ['id' => $user->id])}}" class="btn btn-primary btn-lg">{!! trans('RESET PASSWORD') !!}</a>
                    {!! Form::button('UPDATE', ['class' => 'btn btn-primary btn-lg', 'type'=>'submit']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection