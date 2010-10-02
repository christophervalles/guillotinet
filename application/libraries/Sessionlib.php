<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Clase que maneja el proceso de login/logout y mantenimiento de la sesión
 *
 * @package cpanel
 * @author Christopher Vallés
 *
 */
class CI_Sessionlib {
    /**
     * Constructor
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function CI_Sessionlib() {
        $this->CI = & get_instance();
        $this->_init();
        session_start();
        log_message('debug', 'CI_Sessionlib Library Initialized');
    }
    /**
     * Login function manages the login process creating the session handler
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function login() {
        $CI = & get_instance();
        //Cargar la liberia de validacion de forms
        $CI->load->library('form_validation');
        $CI->load->model('m_login', 'login');
        // Establecer campos username y password como obligatorios
        $CI->form_validation->set_rules('username', $CI->lang->line('username'), 'required');
        $CI->form_validation->set_rules('password', $CI->lang->line('password'), 'required');
        // Validar campos
        if ($CI->form_validation->run() == FALSE) {
            // Si no han sido completados asignar mensaje al template
            $CI->session->set_flashdata('statusMsgType', 'ERROR');
            $CI->session->set_flashdata('statusMsg', $CI->lang->line('provideCredentials'));
            redirect('login');
        } else {
            $user = $CI->input->post('username');
            $pass = $CI->input->post('password');
            if ($CI->login->verifyUser($user, $pass)) {
                $_SESSION['logged'] = TRUE;
                $_SESSION['username'] = ucwords($user);
                redirect('admin/index');
            } else {
                $CI->session->set_flashdata('statusMsgType', 'ERROR');
                $CI->session->set_flashdata('statusMsg', $CI->lang->line('invalidCredentials'));
                redirect('login');
            }
        }
    }
    /**
     * Logout function
     *
     * @return void
     * @author Christopher
     *
     */
    function logout() {
        $CI = & get_instance();
        $_SESSION['logged'] = FALSE;
        $CI->session->sess_destroy();
        // Si no han sido completados asignar mensaje al template
        $CI->session->set_flashdata('statusMsgType', 'SUCCESS');
        $CI->session->set_flashdata('statusMsg', 'Su sesión se ha cerrado correctamente');
        redirect('admin/index');
    }
    /**
     * Check User function
     *
     * @return void
     * @author Christopher Valles
     *
     */
    function _checkUser() {
        $CI = & get_instance();
        return (isset($_SESSION['logged']) && $_SESSION['logged'] == TRUE);
    }
    
    /**
     * Initialization
     *
     * @return void
     * @author Christopher
     */
    private function _init(){
    }
}
?>