<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Login Controller
 *
 * @package default
 * @author Christopher Vallés
 *
 */
class Login extends SF_Controller {
    /**
     * Application name
     */
    const APP = 'backoffice';
    
    /**
     * Constructor
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function __construct() {
        //Load the parent
        parent::SF_Controller();
        
        //Initialization
        $this->_init();
        
        //Class initializated
        log_message('debug', 'Login Controller Initialized');
    }
    
    /**
     * Index redirect to admin
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function index() {
        //get the classname to automatic template loading but in this case we force it
        $class = strtolower(__CLASS__);
        $func = strtolower(__FUNCTION__);
        
        $this->_render(__CLASS__, __FUNCTION__, NULL);
    }
    /**
     * Login function
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function doLogin() {
        $this->sessionlib->login();
    }
    /**
     * Logout function
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function doLogout() {
        $this->sessionlib->logout();
    }
    
    /**
     * Initialization function
     *
     * @return void
     * @author Christopher
     */
    private function _init(){
        //Load the menu configuration
        $this->config->load(self::APP);
        //Load language file
        $this->_loadLanguageFile(self::APP);
    }
}
?>