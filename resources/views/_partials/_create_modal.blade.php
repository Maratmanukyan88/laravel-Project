<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="z-index: 9999;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="exampleModalLabel">New message</h4>
      </div>
      <div class="modal-body">
          {!! Form::open(['class'=>'','id'=>'phrase_crud']) !!}
          <div class="form-group">
              {!! Form::label('url',trans('Websites'), ['class' => 'control-label']) !!}
              {!! Form::select('url',$data,NULL,['class' => 'form-control2']) !!}
          </div>
          <div class="form-group">
              {!! Form::label('phrase',trans('Phrase'),['class' => 'control-label']) !!}
              {!! Form::text('phrase',NULL,['class'=>'form-control2 white-btn','required' => 'required'])!!}
          </div>
              <button type="submit" class="btn btn-primary">Save</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        {!! Form::close() !!}
      </div>
      <div class="modal-footer">
       
        
      </div>
    </div>
  </div>
</div>