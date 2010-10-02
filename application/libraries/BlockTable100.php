<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlockTable100{
    /**
     * Store the info we have to show as a table
     *
     * @var stdClass
     */
    public $items = NULL;
    
    /**
     * Store the title of the block
     *
     * @var string
     */
    public $title = 'Block Title';
    
    /**
     * Translation Key
     *
     * @var string
     */
    public $transKey = __CLASS__;
    
    /**
     * Show paginator
     *
     * @var boolean
     */
    public $showPaginator = FALSE;
    
    /**
     * Store the paginator links
     *
     * @var string
     */
    public $paginator = NULL;
    
    /**
     * Control if we show the bulk actions or not
     *
     * @var boolean
     */
    public $showBulkActions = FALSE;
    
    /**
     * Store the delete url
     *
     * @var string
     */
    public $deleteUrl = '';
    
    /**
     * Store the columns
     *
     * @var array
     */
    public $columns = array();
    
    /**
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher
     */
    public function BlockTable100(){
    }
    
    /**
     * PHP5 Constrcutor
     *
     * @author Christopher
     */
    public function __construct(){
    }
    
    /**
     * PHP Magic method called when we echoed the object
     *
     * @return void
     * @author Christopher
     */
    public function __tostring(){
        //Get the CI instance
        $CI = & get_instance();
        
        //Extract the vars in the object
        if(!empty($this->items)){
            $columns = array_keys(get_object_vars($this->items[0]));
            
            //Get the translations for the column title
            foreach($columns as $c){
                $this->columns[$c] = $CI->lang->line($this->transKey . ucwords($c));
            }
        }
        
        //Echo the output of the parsed view
        return $CI->load->view('viewHelpers/' . basename(__FILE__), $this, TRUE);
    }
}