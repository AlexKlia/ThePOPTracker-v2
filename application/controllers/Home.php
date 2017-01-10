<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function index()
    {

        $data = array();
        $data['title'] = 'Accueil';
        $data['logged'] = $this->session->has_userdata('logged_in');

        $this->load->view('layout/header',$data);
        $this->load->view('index');
        $this->load->view('layout/footer');
    }
}
