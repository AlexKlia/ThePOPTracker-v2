<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class PopList extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        $this->load->model('Pop_model','',TRUE);
        $this->output->enable_profiler(TRUE);
    }
    
    public function popList($string)
    {
        $data['title']='Liste des pop de la categorie '.$string;
        $list=$this->Pop_model->getPopByCate($string);
        $this->load->view('layout/header',$data);
        $this->load->view('popList/popList',['list'=>$list]);
        $this->load->view('layout/footer');
    }
}