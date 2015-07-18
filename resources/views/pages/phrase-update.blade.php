@extends('app')
@include('navbar.navbar1')
@section('content')   
<div class="container" style="margin-top: 84px;">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{!! trans('Update Phrase') !!}</div>
                    <div class="panel-body">
                        {!! Form::open(['url'=>$action,'class' => 'form-horizontal']) !!}

                        <div class="form-group">
                            {!! Form::label('phrase', trans('Phrase'), ['class' => 'col-md-4 control-label']) !!}
                            <div class="col-md-6">
                                {!! Form::text('phrase', $model->phrase, ['class' => 'form-control2','required' => 'required']) !!}
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                {!! Form::submit(trans('Update'), ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

