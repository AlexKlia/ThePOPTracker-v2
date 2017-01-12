<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Categorie extends CI_Controller {   
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pop_model','',TRUE);
        $this->output->enable_profiler(TRUE);
        
    }
    
    
    
    public function category()
    {
        $data['title']='Categorie';
        
        $cate=$this->Pop_model->getCategory();
        $this->load->view('layout/header',$data);
        $this->load->view('category/view',['cate'=>$cate]);
        $this->load->view('layout/footer');
        
        
    }
}