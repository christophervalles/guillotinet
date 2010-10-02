<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class BlockListNoColumns50{
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
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher
     */
    public function BlockListNoColumn(){
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
        
        //Echo the output of the parsed view
        return $CI->load->view('viewHelpers/' . basename(__FILE__), $this, TRUE);
    }
}