<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Authentification extends CI_Controller {

    /**
     * @todo Faire une class User et une class Pop qui contiendra toute les donneés de ces deux categories
     *       ce qui facilitera l'appelle des variables dans touts le code.
     */
    private $logged;

    function __construct()
    {
        parent:: __construct();
        $this->load->model('User_model','',TRUE);
        $this->load->library('email');
        $this->logged = $this->session->has_userdata('logged_in');
    }

    public function login()
    {
        $submit = $this->input->post('submit');
        $email = $this->input->post('email');
        $plainPassword = $this->input->post('password');

        $data = array();
        $script = array('login');

        $data['title'] = 'Connexion';

        $data['logged'] = $this->logged;
        $data['scripts'] = $script;
        $data['login'] = TRUE;

        if ($submit) {

            $confirm_email = '';
            $this->load->library('form_validation');

            $this->form_validation->set_rules('password', 'Mot de passe', 'htmlspecialchars|trim|required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|required|valid_email');

            if ($this->form_validation->has_rule('email')) $confirm_email = $email;

            if ($this->form_validation->run() == FALSE)
            {
                $data['errors'] = validation_errors();
                if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                $this->load->view('layout/header',$data);
                $this->load->view('user/login');
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
                        unset($user['password']);

                        if ($user['confirmate_at'] !== NULL)
                        {
                            $user['logged_in'] = TRUE;

                            $this->session->set_userdata($user);
                            redirect('/', 'location');
                        }
                        else
                        {
                            $data['errors'] = 'Votre compte n\'a pas été activée';

                            $this->load->view('layout/header',$data);
                            $this->load->view('user/login');
                            $this->load->view('layout/footer');
                        }

                    }
                    else
                    {

                        $data['errors'] = 'Adresse mail ou mot de passe incorrecte';
                        if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                        $this->load->view('layout/header',$data);
                        $this->load->view('user/login');
                        $this->load->view('layout/footer');
                    }

                }
                else
                {
                    $data['errors'] = 'Aucun compte ne correspond à vos identifiants';
                    if (!empty($confirm_email)) $data['confirm_email'] = $confirm_email;

                    $this->load->view('layout/header',$data);
                    $this->load->view('user/login');
                    $this->load->view('layout/footer');
                }

            }


        } else {

            $this->load->view('layout/header',$data);
            $this->load->view('user/login');
            $this->load->view('layout/footer');
        }
    }


    public function signIn()
    {
        $submit = $this->input->post('submit');

        $username = $this->input->post('username');
        $email = $this->input->post('email');
        $plainPassword = $this->input->post('password');
        $confirmPassword = $this->input->post('confirmPassword');
        $captcha = $this->input->post('g-recaptcha-response');

        $data = array();
        $script = array('login');

        $data['title'] = 'Inscription';

        $data['logged'] = $this->logged;
        $data['scripts'] = $script;
        $data['login'] = FALSE;

        if ($submit) {

            $this->load->library('form_validation');

            $this->form_validation->set_rules('username', 'Pseudo', 'htmlspecialchars|trim|required|min_length[6]|max_length[14]');
            $this->form_validation->set_rules('password', 'Mot de passe', 'htmlspecialchars|trim|required|min_length[8]');
            $this->form_validation->set_rules('confirmPassword', 'Mot de passe', 'required');
            $this->form_validation->set_rules('email', 'Email', 'htmlspecialchars|trim|required|valid_email');
            $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'trim|required');

            if ($this->form_validation->run() == FALSE)
            {
                $data['errors'] = validation_errors();
                if ($this->form_validation->has_rule('email')) $data['confirm_email'] = $email;
                if ($this->form_validation->has_rule('username')) $data['confirm_username'] = $username;

                $this->load->view('layout/header',$data);
                $this->load->view('user/login');
                $this->load->view('layout/footer');
            }
            else
            {
                $data['errors'] = '';
                $user = $this->User_model->userLogin($email);
                $existEmail = (!empty($user)) ? TRUE : FALSE;

                if ($plainPassword != $confirmPassword)
                {
                    $data['errors'] .= 'Le mot de passe doit être identique dans les deux champs<br>';
                }

                if ($existEmail)
                {
                    $data['errors'] .= 'Cette adresse email est déjà utilisée<br>';
                }

                if (!empty($captcha))
                {
                    $secretKey = "6LeC1A4UAAAAACfUQhkJt6I5oo2WUOo_QMx9AUD8";
                    $ip = $_SERVER['REMOTE_ADDR'];
                    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $secretKey . "&response=" . $captcha . "&remoteip=" . $ip);
                    $responseKeys = json_decode($response, true);

                    if (intval($responseKeys["success"]) !== 1)
                    {
                        $data['errors'] .= 'Vous êtes un robot !!';
                    }
                }

                if (!empty($data['errors']))
                {
                    if ($this->form_validation->has_rule('email')) $data['confirm_email'] = $email;
                    if ($this->form_validation->has_rule('username')) $data['confirm_username'] = $username;

                    $this->load->view('layout/header',$data);
                    $this->load->view('user/login');
                    $this->load->view('layout/footer');
                }
                else
                {
                    $this->load->helper('string');

                    $option = [
                        'cost' => 12,
                    ];

                    $newUser = [
                        'username' => $username,
                        'email' => $email,
                        'password' => password_hash($plainPassword, PASSWORD_BCRYPT, $option)
                    ];

                    // Insert du nouvelle utilisateur si aucun problemes
                    $this->db->insert('users', $newUser);
                    $this->confirmAccount($email);

                    $this->session->set_flashdata('success', 'Un mail de confirmation vous a était envoyé');

                    redirect('user_authentification/login');

                }
            }
        }
        else
        {
            $this->load->view('layout/header',$data);
            $this->load->view('user/login');
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
        redirect('user_authentification/login');
    }

    /**
     * PHP Mailer
     * @param $destAddress
     * @param $subject
     * @param $messageHtml
     */
    private function sendMail($destAddress, $subject, $messageHtml)
    {
        $this->email
            ->from('ThePOPTracker@gmail.com','ThePOPTracker')
            ->to($destAddress)
            ->subject($subject)
            ->message($messageHtml)
            ->send();
    }


    /**
     * Affichage du formulaire de demande de nouveau mot de passe
     * @param $email
     */
    private function confirmAccount($email)
    {

        $submit = $this->input->post('submit');

        if (!empty($submit)) {

            $user = $this->User_model->userLogin($email);

            if (!empty($user)) {

                // Insert du token de confirmation de compte
                $id = $user->id;
                $token = random_string('sha1');

                $newRecoveryToken = [
                    'id_user' => $id,
                    'confirmation_token' => $token
                ];

                $this->db->insert('recoverytokens', $newRecoveryToken);

                // Envoyer un mail

                $url = base_url() . 'user_authentification/confirm/' . $token;

                $messageHtml = <<< EOT
<h1>Confirmation de votre compte</h1>
Bonjour $user->username:<br>
<a href="$url">Cliquez ici</a> pour finaliser votre inscription.<br>
Si vous n'êtes pas à l'origine de ce mail, n'ouvrez pas le lien ci dessus.
EOT;

                $this->sendMail($user->email, 'Confirmation de compte', $messageHtml);
            }
        } else {
            $this->session->set_flashdata('danger', 'Le mail de confirmation n\' a pas pu être envoyé');
            redirect('user_authentification/login');
        }
    }

    /**
     * confirmation du compte
     * @param $token
     */
    public function confirm($token)
    {
        $tokenExist = $this->User_model->searchToken($token);

        if ($tokenExist != NULL) {
            // Le token existe bien en base

            $this->db->set('confirmate_at', date('Y-m-d'));
            $this->db->where('id',$tokenExist['id_user']);
            $this->db->update('users');

            $this->db->delete('recoverytokens', array('id' => $tokenExist['id']));

            $this->session->set_flashdata('success', 'Votre compte a eté activée!');

            redirect('user_authentification/login');

        } else {
            $this->session->set_flashdata('danger', 'La confirmation de votre compte a échoué');
            redirect('user_authentification/login');
        }

        $data['title'] = 'Inscription';
        $data['logged'] = $this->logged;

        $this->load->view('layout/header',$data);
        $this->load->view('user/confirm-account');
        $this->load->view('layout/footer');
    }
}
