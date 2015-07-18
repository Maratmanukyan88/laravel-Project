@extends('app')

@section('content')
<div class="bread-container">
    <ul class="breadcrumb2">
        <li class="active">Name</li>
        <li href="" >Recipients</li>
        <li href="">Logic</li>
        <li href="">Confirm & Save</li>
    </ul>
</div>

<div id="content">
    <div class="container">
        
        <form id="msform" class="form-horizontal" method="GET" action='{!!URL::to("logic")!!}'>
            <fieldset>

                <!-- Form Name -->
                <legend>Name</legend>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Name</label>  
                  <div class="col-md-4">
                    <input id="textinput" name="name" type="text" placeholder="" class="form-control input-md" >
                  <span class="help-block">Please enter a unique name</span>  
                  </div>
                </div>

                <!-- Text input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="textinput">Tags</label>  
                  <div class="col-md-4">
                    <input id="textinput" name="tag" type="text" placeholder="add a tag" class="form-control input-md">

                  </div>
                </div>

                <!-- Appended Input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="appendedtext">Folder</label>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input id="appendedtext" name="appent" class="form-control" placeholder="placeholder" type="text">
                      <span class="input-group-addon">Choose</span>
                    </div>

                  </div>
                </div>
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="checkboxes"></label>
                  <div class="col-md-4">
                  <div class="checkbox">
                    <label for="checkboxes-0">
                      <input type="checkbox" name="checkboxes" id="checkboxes-0" value="1">
                      Only send e-mails during business hours
                    </label>
                        </div>
                  </div>
                </div>

                <!-- Select Basic -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="selectbasic">Select Timezone</label>
                  <div class="col-md-4">
                    <select id="selectbasic" name="selectbasic" class="form-control">
                      <option value="1">Option one</option>
                    </select>
                  </div>
                </div>
                 <div class="buttons">
                    <div class="col-md-12">
                        <input type="button" id="singlebutton" name="" class="btn btn-primary next" value="Next >>" />
                        <input type="submit" id="singlebutton" name="" class="btn btn-primary cancel" value="Cance" />
                        <p class="clearfix"></p>
                    </div>
                </div>
            </fieldset>
            
            <fieldset >

                <!-- Form Name -->
                <legend>Recipients</legend>


                <!-- Appended Input-->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="appendedtext">Lists</label>
                  <div class="col-md-4">
                    <div class="input-group">
                      <input id="appendedtext" name="folder" class="form-control" placeholder="placeholder" type="text">
                      <span class="input-group-addon">Choose</span>
                    </div>

                  </div>
                </div>
                
                <!-- Multiple Checkboxes -->
                <div class="form-group">
                  <label class="col-md-4 control-label" for="checkboxes"></label>
                  <div class="col-md-4">
                  <div class="checkbox">
                    <label for="checkboxes-0">
                      <input type="checkbox" name="check" id="checkboxes-0" value="1">
                      Use Suppression List
                    </label>
                        </div>
                  </div>
                </div>
                 <div class="buttons">
                    <div class="col-md-12">
                        <input type="button" id="singlebutton" name="" class="btn btn-primary previous" value="Previous">
                        <button type="submit"  class="btn" >Next >></button>
<!--                        <input type="submit" id="singlebutton" name="singlebutton" class="btn btn-primary next" value="Next">-->
                        <input type="submit" id="singlebutton" name="" class="btn btn-primary cancel" value="Cancel">
                        <p class="clearfix"></p>
                    </div>
                </div>
            </fieldset>
           
           
        </form>
    </div>
</div>
@endsection


