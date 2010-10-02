<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Home Controller
 *
 * @package url_shortener
 * @author Christopher Vallés
 *
 */
class Web extends SF_Controller {
    /**
     * Application name
     */
    const APP = 'frontend';
    
    /**
     * PHP5 Constructor
     *
     * @author Christopher
     */
    public function __construct() {
        parent::SF_Controller();
        $this->_init();
    }
    
    /**
     * Index function
     *
     * @return void
     * @author Christopher
     */
    public function index($slug = NULL) {
        $lang = $this->_checkCookie();
        
        //Default values
        $data = array();
        $data['shortURL'] = '';
        $data['redirect'] = FALSE;
        $function = __FUNCTION__;
        
        if($this->router->is_get()){
            //Check if we have to redirect
            if(!is_null($slug)){
                //Load the model
                $this->load->model('m_urls', 'urls');
                
                //Get the original url
                $data['url'] = $this->urls->decodeUrl($slug);
                $data['urlWoTransport'] = str_replace('http://', '', str_replace('https://', '', $data['url']->url));
                $data['redirect'] = TRUE;
                
                //Check if we have info to redirect
                if(is_null($data['url'])){
                    redirect('');
                }
                
                $function = 'redirect';
            }
        }else{
            //Get the url and filter it
            $url = $this->input->post('url', TRUE);
            $button = $this->input->post('create', TRUE);
            $ajax = empty($button);
            
            //Load the model
            $this->load->model('m_urls', 'urls');
            
            //Little validation
            if(substr($url,0,7) != 'http://' && substr($url,0,8) != 'https://'){
                $url = 'http://' . $url;
            }
            
            //Call the model to generate the short url
            $slug = $this->urls->encodeUrl($url);
            
            //Store the info
            $data['slug'] = $slug;
            $data['shortURL'] = base_url() . $slug;
            $data['url'] = $url;
            
            //Check if the request is ajax
            if($ajax){
                //Print the JSON Encode of the info
                echo $data['shortURL'];
                exit();
            }
        }
        
        $this->_render(__CLASS__, $function, $data);
    }
    
    public function redirect($slug = NULL){
        if(is_null($slug)){
            //Class initializated
            log_message('error', 'Missing slug parameter in ' . __METHOD__);
            throw new Exception('Missing slug parameter in ' . __METHOD__);
        }
        
        //Load the model
        $this->load->model('m_urls', 'urls');
        
        //Get the original url
        $url = $this->urls->decodeUrl($slug);
        
        //Redirect the user to the final url
        header('Location: ' . $url->url);
    }
    
    /**
     * Change Language function
     *
     * @return void
     * @author Christopher Valles
     *
     */
    public function changelang($lang = NULL) {
        if (is_null($lang)){
            //Class initializated
            log_message('error', 'Missing lang parameter in ' . __METHOD__);
            throw new Exception('Missing lang parameter in ' . __METHOD__);
        }
        $this->session->set_userdata(array('lang' => $lang));
        $this->_flushcache();
        redirect('');
    }
    
    /**
     * Initialization
     *
     * @return void
     * @author Christopher
     */
    private function _init(){
        $this->_checkCookie();
        $this->_loadLanguageFile(self::APP);
    }
}
/* End of file web.php */
/* Location: ./system/application/controllers/web.php */