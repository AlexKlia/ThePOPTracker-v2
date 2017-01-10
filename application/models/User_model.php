<?php

class User_model extends CI_Model {

    protected $table = 'users';

    public function userLogin($email)
    {
        return $this->db->select('users.id, users.email, users.password')
            ->from($this->table)
            ->where('email', $this->db->escape_str($email))
            ->get()
            ->row();
    }

    public function getUserById($id)
    {
        return $this->db->select('users.id, users.username, users.email, users.avatar, users.role, users.level, users.confirmate_at, users.flag, users.xp')
            ->from($this->table)
            ->where('id', $this->db->escape_str($id))
            ->get()
            ->row_array();
    }

}