<div class="modal fade action_modal">
    <div class="modal-dialog drip-modal"  style="z-index: 99999;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">ACTION</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-folder-open"></i>
                    </span>
                    <input type="text" class="form-control fil-link" readonly="" required="">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default choose-meil">Choose</button>
                    </span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 
**************
****FILES*****
**************
-->
<div class="modal fade action_files">
    <div class="modal-dialog drip-modal"  style="z-index: 99999;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">ACTION</h4>
            </div>
            <div class="modal-body">
                @include('drips.test')
            </div>
            <div class="input-group">
                <span class="input-group-addon">
                    <i class="glyphicon glyphicon-folder-open"></i>
                </span>
                <input type="text" class="form-control file-link" readonly="" value="">
                <span class="input-group-btn">
                    <button data-dismiss="modal" type="button" class="btn btn-default choose-fil">Choose</button>
                </span>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 
**************
****PAUSE*****
**************
-->
<div class="modal fade pause_modal">
    <div class="modal-dialog drip-modal"  style="z-index: 99999;">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">PAUSE</h4>
            </div>
            <div class="modal-body">
                <div class="input-group">
                    <span class="input-group-addon">
                        <i class="glyphicon glyphicon-pause"></i>
                    </span>
                    <input type="number" min="1" max="31" class="form-control pause-limit">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-default choose-pause" data-dismiss="modal">Choose</button>
                    </span>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- 
**************
**CONDITION***
**************
-->
<div class="modal fade condition_modal">
    <div class="modal-dialog drip-modal"  style="z-index: 99999;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">CONDITION</h4>
            </div>
            <div class="modal-body condition-body">
               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-btn" data-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
