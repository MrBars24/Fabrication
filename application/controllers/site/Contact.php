<?php

class Contact extends MX_Controller {
  public function submitContactUs() {
    $data = array(
      'message' => $this->input->post('message'),
      'email' => $this->input->post('email'),
      'name' => $this->input->post('name'),
      'address' => $this->input->post('address')
    );

    $template = $this->load->view('email_templates/contact_us', NULL, TRUE);
    // format the email content
    $message = $this->formatBody($template, $data);

    $this->load->model("admin/cms_model");
    $email = $this->cms_model->getSettings()->contact_email;

    $this->load->library('email',EMAIL_DETAILS);
  	$this->email->from($data['email'], $data['name']);
  	$this->email->to($email);
  	$this->email->cc('efab@efab-prod.tk');
  	$this->email->bcc(EMAIL_DETAILS['smtp_user']);
  	$this->email->set_mailtype('html');
  	$this->email->subject('Efab - New Message');
  	$this->email->message($message);

  	$sendReturn = $this->email->send();

    // $sendReturn = send_mail('Efab - New Message', 'leonardo.iformatlogic@gmail.com', $message);
    if($sendReturn) {
      if (is_ajax()) {
        return json(array('success' => true), 200);
      }
  	}
    if (is_ajax()) {
    	return json(array('success' => false), 500);
    }

    redirect($_SERVER['HTTP_REFERER']);
  }

  private function validate() {

  }

  private function formatBody($template, $data) {
    $template = str_replace("[name]", $data['name'], $template );
    $template = str_replace("[address]", $data['address'], $template );
    $template = str_replace("[message]", $data['message'], $template );

    return $template;
  }
}
