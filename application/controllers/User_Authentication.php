<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentication extends CI_Controller {

    /**
     * @todo Faire une class User et une class Pop qui contiendra toute les donneés de ces deux categories
     *       ce qui facilitera l'appelle des variables dans touts le code.
     */
    private $logged;

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User_model','',TRUE);
        $this->logged = $this->session->has_userdata('logged_in');
    }


    public function login()
    {
        $submit = $this->input->post('submit');
        $email = $this->input->post('email');
        $plainPassword = $this->input->post('password');

        if ($submit) {

            $confirm_email = '';
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Mot de passe', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|required|valid_email');

            if ($this->form_validation->has_rule('email')) $confirm_email = $email;

            if ($this->form_validation->run() == FALSE)
            {
                $data = array();
                $data['errors'] = validation_errors();
                $data['logged'] = $this->logged;
                if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                $this->load->view('layout/header',$data);
                $this->load->view('user_authentication/login');
                $this->load->view('layout/footer');
            }
            else
            {

                $result = $this->User_model->userLogin($confirm_email);

                if (!empty($result))
                {

                    $hashPassword = $result->password;

                    if (password_verify($plainPassword,$hashPassword))
                    {
                        $user = $this->User_model->getUserById($result->id);
                        $user['logged_in'] = TRUE;

                        $this->session->set_userdata($user);
                        redirect('/', 'location');
                    }
                    else
                    {
                        $data = array();
                        $data['errors'] = 'Adresse mail ou mot de passe incorrecte';
                        $data['logged'] = $this->logged;
                        if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                        $this->load->view('layout/header',$data);
                        $this->load->view('user_authentication/login');
                        $this->load->view('layout/footer');
                    }

                }
                else
                {
                    $data = array();
                    $data['errors'] = 'Aucun compte ne correspond à vos identifiants';
                    $data['logged'] = $this->logged;
                    if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                    $this->load->view('layout/header',$data);
                    $this->load->view('user_authentication/login');
                    $this->load->view('layout/footer');
                }

            }


        } else {

            $data['logged'] = $this->logged;

            $this->load->view('layout/header',$data);
            $this->load->view('user_authentication/login');
            $this->load->view('layout/footer');
        }
    }

    public function logout()
    {
        $user_data = $this->session->all_userdata();
        foreach ($user_data as $key => $value) {
            if ($key != 'session_id' && $key != 'ip_address' && $key != 'user_agent' && $key != 'last_activity') {
                $this->session->unset_userdata($key);
            }
        }
        $this->session->sess_destroy();
        redirect('user_authentication/login');
    }
}
