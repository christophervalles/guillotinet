<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SF_Controller
 *
 * @package default
 * @author Christopher Vallés
 **/
class SF_Controller extends Controller {
    
    /**
     * PHP5 Constructor
     *
     * @author Christopher
     */
    public function __construct(){
        parent::Controller();
        $this->_init();
    }
    
    /**
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher
     */
    public function SF_Controller(){
        parent::Controller();
        $this->_init();
    }
    
    /**
     * Common code to render the views
     *
     * @param string $func 
     * @param string $data 
     * @param boolean $useLayout 
     * @author Christopher
     */
    protected function _render($class = NULL, $func = NULL, $data){
        if(is_null($func)){
            throw new Exception('Wrong call to render function, you have to specify the function name');
        }
        
        //Set browser title
        $data['title'] = $this->lang->line('projectTitle') . $this->lang->line('separator') . $this->lang->line(strtolower($class) . ucwords($func));
        //Activate the cache
        
        if($this->config->config['cache_enabled']){
            $this->output->cache(60);
        }
        
        //get the classname and function to automatic template loading but in this case we force it
        $class = strtolower($class);
        $func = strtolower($func);
        $app = strtolower($this->lang->line('app'));
        
        //Pass the classname to the view
        $data['className'] = $class;
        //Load some layout files
        $data['error_messages'] = sprintf('%s/layout/error_messages', $app);
        $data['layoutHeader'] = sprintf('%s/layout/header', $app);
        $data['layoutFooter'] = sprintf('%s/layout/footer', $app);
        
        //Autoload the related js file
        $jsFile = sprintf('/js/%s/%s_%s.js', $app, $class, $func);
        if(file_exists(realpath(dirname(FCPATH)) . $jsFile)){
            $data['jsFile'] = $jsFile;
        }else{
            $data['jsFile'] = NULL;
        }
        
        //Pass the lang we use
        $data['lang'] = $this->_checkCookie();
        
        //Get the menu from the config file
        if(isset($this->config->config[$app . '_menu'])){
            $menu = $this->config->config[$app . '_menu'];
            //Store the actual section
            $data['menu']['selected'] = $menu[$class];
            //Unset the actual section
            unset($menu[$class]);
            //Store the rest of the menu
            $data['menu']['items'] = $menu;
        }
        
        //Load and parse the file
        $data['content'] = sprintf('%s/%s/%s', $app, $class, $func);
        //Load the vars to the view
        $this->load->vars($data);
        //Load the layout
        $this->load->view(sprintf('%s/layout/index', $app));
    }
    
    /**
     * Erase cache files
     *
     * @return void
     * @package url_shortener
     * @author Christopher Vallés
     **/
    protected function _flushcache(){
        $dir = 'cache/';
        foreach(glob($dir.'*') as $v){
            unlink($v);
        }
    }
    
    /**
     * Crear Cookie function
     *
     * @return void
     * @author Christopher Valles
     *
     */
    protected function _createCookie() {
        $headers = apache_request_headers();
        preg_match('/[a-zA-Z]{2}-[a-zA-Z]{2}/', $headers['User-Agent'], $lang);
        switch(substr($lang[0],0,2)){
            case 'es':
                $lang = 'es';
                break;
            case 'ca':
                $lang = 'ca';
                break;
            case 'fr':
                $lang = 'fr';
            default:
                $lang = 'en';
                break;
        }
        
        $this->session->set_userdata(array('lang' => $lang));
        return $lang;
    }
    
    /**
     * Comprovamos si está la cookie
     *
     * @return void
     * @author Christopher Valles
     *
     */
    protected function _checkCookie() {
        // Comprovamos si está la cookie con el lang
        $language = $this->_getLang();
        if (!$language) {
            $language = $this->_createCookie();
            return $language;
        }
        
        return $language;
    }
    
    /**
     * get language from session
     *
     * @return string
     * @author Christopher Vallés
     *
     */
    protected function _getLang() {
      return $this->session->userdata('lang');
    }
    
    protected function _loadLanguageFile($app = NULL){
        //Check if we have app name
        if(is_null($app)){
            throw new Exception('You have to specify the app name');
        }
        
        //Get the actual lang
        $lang = $this->_getlang();
        
        //Load the lang files based on the lang
        switch($lang){
            case 'es':
                $this->lang->load($app, 'spanish');
                break;
            case 'fr':
                $this->lang->load($app, 'french');
                break;
            case 'ca':
                $this->lang->load($app, 'catalan');
                break;
            default:
                $this->lang->load($app, 'english');
                break;
        }
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