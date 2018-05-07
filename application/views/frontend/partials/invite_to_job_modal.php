<!-- Modal -->

<div class="modal fade modal-invite-to-job" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= form_open("", array('id'=>'form-job-invitation')); ?>
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Invite <?= $user->fullname ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <h6 class="font-weight-bold">Select Job HELLO</h6>
                    <select name="job_id" class="form-control">
                        <?php foreach($jobAvailable as $jA): ?>
                            <option value="<?= $jA->id ?>"><?= $jA->title ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <h4 class="font-weight-bold">Include a Message</h4>
                    <textarea name="message" rows="3" class="form-control"></textarea>
                </div>
                <!-- <div class="form-group">
                    <h6 class="font-weight-bold">Attach Files</h6>
                    <form action="#" class="dropzone dz-clickable">
                        <div class="dz-default dz-message text-center">
                            <span>Drop files here to upload</span>
                        </div>
                    </form>
                </div> -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-success" style="z-index:1;">Send Invitation</button>
            </div>
            <?= form_close(); ?>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<div class="modal fade modal-already-invite" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="myLargeModalLabel">Invite <?= $user->fullname ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <p>This user/member is already invited to the job.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Ok</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
