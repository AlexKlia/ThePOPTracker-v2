<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Pop_model extends CI_Model{
    
    public function getCategory(){  
        $this->db->select('pops.name AS pName,pops.id_category,pops.url,categories.id,categories.name AS cName')
                 ->from('pops')
                 ->join('categories','pops.id_category=categories.id')
                 ->group_by('pops.id_category');
       
        $cate= $this->db->get();
        return $cate->result_array();
    }     
    
    public function getPopByCate($string){
        $this->db->select('pops.name,pops.id,pops.exclusivity,pops.url, categories.name,franchies.name AS franchise')
                 ->from('pops')
                 ->join('categories','categories.id = pops.id_category','inner')
                 ->join('franchies','franchies.id = pops.id_franchise','inner')
                 ->where('categories.name',$string);
        $list= $this->db->get();
        return $list->result_array();
    }
  
}
