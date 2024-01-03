<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
		public function __construct()
	{
		
		parent::__construct();

		$this->load->helper('url');
		$this->load->helper('html');
        
		
	}
    public function index()
    {
		$this->load->helper('url');
        $this->load->view('ncsf_home.php');
	}
    public function ncsf_contact()
    {
        $this->load->helper('url');
        
		$this->load->view('contact.php');
	 }
	 public function ncsf_about()
	 {
		 $this->load->helper('url');
		 
		 $this->load->view('about.php');
	  }
	  public function ncsf_services()
	  {
		  $this->load->helper('url');
		  
		  $this->load->view('services.php');
	   }
	   public function contact_process()
	   {
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->database();
        $this->load->library('email');
        
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('phone','Phone','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('message','Message','required');

       if($this->form_validation->run() == FALSE)
       {
       	$this->load->view('ncsf_home.php');
       }
		else{
			$ncsf_contact['name'] = $this->input->post('name');
			$ncsf_contact['phone'] = $this->input->post('phone');
			$ncsf_contact['email'] = $this->input->post('email');
			$ncsf_contact['message'] = $this->input->post('message');

			$this->load->model('ncsf_usermodel');
			$ncsf_contcrcheck = $this->ncsf_usermodel->ncsf_contacts_add($ncsf_contact);

			if($ncsf_contcrcheck == true)
			{
                $ncsf_contcemail = $this->input->post('email');
				$this->ncsf_conatctconfirm($ncsf_contcemail);
				echo "<script>alert('Thank You contact for NCSF.');</script>";
				redirect('Home/index');
			}
			else{


			}

			

		}
		
	   }
	   public function ncsf_conatctconfirm($ncsf_contcemail)
	   {
		$this->load->library('email');

		$config = Array(
			'protocol' => 'smtp',
	  'smtp_host' => 'Chimail.midphase.com',
	  'mailtype'  => 'html', 
	  'charset'   => 'iso-8859-1',
	  'wordwrap'   => TRUE,
			  'smtp_host' => 'Chimail.midphase.com',
			  'smtp_port' => 465,
			  'smtp_user' => 'order@efnypizzeria.net',
			  'smtp_pass' => 'Nc$f#2023ny@',
			  'smtp_crypto' => 'ssl', 
			  'newline' => "\r\n"
	  );
	  $this->email->initialize($config);
	  
		   $this->email->from('info@nationalcatering.net', 'NCSF');
		  $this->email->to($ncsf_contcemail);
  
		  $this->email->subject('Account Registration Confirmation');
		  $this->email->message('<h1 align="center" style="color:blue;">Thank you for contacting NCSF </h1>'); 
  
	  
	  
		  if ($this->email->send()) {
			 
			  return true;
		  } else {
			  log_message('error', $this->email->print_debugger());
	  return false;
		  }
		  
	   }
	   public function enquiry_form()
	   {
		$this->load->helper('url');
		$this->load->library('form_validation');
		$this->load->database();
        $this->load->library('email');
        
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required|valid_email');
		$this->form_validation->set_rules('message','Message','required');

       if($this->form_validation->run() == FALSE)
       {
       	$this->load->view('ncsf_home.php');
       }
		else{
			$ncsf_enquiry['name'] = $this->input->post('name');
			$ncsf_enquiry['email'] = $this->input->post('email');
			$ncsf_enquiry['message'] = $this->input->post('message');

			$this->load->model('ncsf_usermodel');
			$ncsf_enquirycheck = $this->ncsf_usermodel->ncsf_enquiry_add($ncsf_enquiry);

			if($ncsf_enquirycheck == true)
			{
                $ncsf_enquiryemail = $this->input->post('email');
				// $this->ncsf_enquiryconfirm($ncsf_enquiryemail);
				echo "<script>alert('Thank You contact for NCSF.');</script>";
				redirect('Home/index');
			}
			else{


			}

			

		}
}
}