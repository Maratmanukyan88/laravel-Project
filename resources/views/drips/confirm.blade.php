@extends('app')

@section('content')
<div class="bread-container">
    <ul class="breadcrumb2">
        <li >Name</li>
        <li href="" >Recipients</li>
        <li href="" >Logic</li>
        <li href="" class="active">Confirm & Save</li>
    </ul>
</div>
<div id="content">
    <div class="container">
        <!-- Form Name -->
        <legend>Logic</legend>

        <div class="col-md-12">
            <div class="row">
                <div class="col-md-3">
                    <p>Avaliable Actions</p>
                    <div class="avaliable-actions">
                        <ul class="actions">
                            <li alt="action" class="action" data-value="sendEmail">Send email</li>
                            <li alt="question" class="box-margin" data-value="questions">Has prospect link

                                <ol class="action-muve">
                                </ol>
                            </li>
                            <li class="action" data-value="hasOpend" >Has pros</li>
                            <li alt="pause" class="action" data-value="pause"><span class="glyphicon glyphicon-pause"></span> Pause</li>
                            <li class="action" data-value="end"><span class="glyphicon glyphicon-stop"></span> End</li>
                        </ul>
                    </div>
                    <button href="#" class="btn btn-primary" id="confirm" >Confirm & Save</button>
                </div>

                <div class="col-md-9">
                    <p>Drip Logic</p>
                    <div id="add-actions" class="drip-logic ">
                        <ul>
                            <li class="start"> <span class="glyphicon glyphicon-triangle-right"></span>Start</li> 
                            <li id="drop">
                                <ol class="addif">
                                    
                                </ol>

                            </li>

                            <li><span class="glyphicon glyphicon-stop"></span>End</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('footer_js')
<script>
  
</script>
@endsection

