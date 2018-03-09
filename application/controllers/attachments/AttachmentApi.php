<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AttachmentApi extends MX_Controller {

	public function __construct(){
        parent::__construct();
        $this->load->model('Attachment_model');
	}

	public function getAttachmentsByMorphedId($attachable_type, $attachable_id){
        $attachments = $this->Attachment_model->getAttachmentsByMorphedId($attachable_type, $attachable_id);
        dd($attachments);

        // return json(array(
        //     'data' => $bids
        // ));
    }
}