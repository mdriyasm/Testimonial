<?php 

class ncsf_usermodel extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function ncsf_contacts_add($ncsf_contact) {
        $this->db->insert('ncsf_contactlist', $ncsf_contact);
        return true;
    }
    public function ncsf_enquiry_add($ncsf_enquiry) {
        $this->db->insert('ncsf_enquirylist', $ncsf_enquiry);
        return true;
    }
}
