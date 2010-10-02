<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Admin Controller
 *
 * @package url_shortener
 * @author Christopher Vallés
 *
 */
class Admin extends SF_Controller {
    /**
     * Application name
     */
    const APP = 'backoffice';
    const URLS_PER_PAGE = 25;
    
    /**
     * PHP 5 Constructor
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    public function __construct(){
        //Load the parent
        parent::Controller();
        //Initialization
        $this->_init();
        //Class initializated
        log_message('debug', 'Admin Controller Initialized');
    }
    
    /**
     * Index function
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    public function index($offset = 0){
        if (!$this->sessionlib->_checkUser()) {
            redirect('login');
            exit();
        }
        
        //Load the model
        $this->load->model('m_urls', 'urls');
        
        //Load the view helpers
        $this->load->library('BlockTable100');
        
        //Create the Robberies Block
        $urlBlock = new BlockTable100();
        //Initialize some values of the view helper
        $urlBlock->title = $this->lang->line('urlsBlockTitle');
        $urlBlock->items = array();
        $urlBlock->transKey = 'urlsBlock';
        $urlBlock->showBulkActions = FALSE;
        $urlBlock->showPaginator = TRUE;
        //$urlsBlock->deleteUrl = '/robberies/delete';
        
        //Get the url's
        $urlBlock->items = $this->urls->get(self::URLS_PER_PAGE, $offset);
        
        //Delete the slug
        foreach($urlBlock->items as $u){
            unset($u->slug);
        }
        
        //Generate the info for the paginator
        $total = $this->urls->getTotal();
        //Load the paginator class
        $this->load->library('pagination');
        
        //Generate the config for the paginator
        $config['base_url'] = '/admin/index';
        $config['total_rows'] = $total;
        $config['per_page'] = self::URLS_PER_PAGE;
        $config['next_link'] = $this->lang->line('next');
        $config['prev_link'] = $this->lang->line('previous');
        
        //Initialize the paginator
        $this->pagination->initialize($config);
        
        //Pass the paginator to the view helper
        $urlBlock->paginator = $this->pagination->create_links();
        //Pass the block to the view
        $data['urlBlock'] = $urlBlock;
        
        //Call the render method
        $this->_render(__CLASS__, __FUNCTION__, $data);
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