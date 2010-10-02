<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class m_urls extends SF_Model {

    protected $_table = "urls";
    
    /**
     * PHP5 Constructor
     *
     * @author Christopher
     */
    public function __construct(){
        parent::SF_Model();
        log_message('debug', __CLASS__ . ' Model Initialized');
    }
    
    /**
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    public function m_configurations() {
        parent::SF_Model();
        log_message('debug', __CLASS__ . ' Model Initialized');
    }
    
    /**
     * Get the urls limited by total and offset
     *
     * @param int $total 
     * @param int $offset 
     * @return stdClass
     * @author Christopher
     */
    public function get($total = NULL, $offset = 0){
        //Check params
        if(is_null($total)){
            throw new Exception('Parameters error in ' . __METHOD__);
        }
        
        //Select the fields
        $this->db->select('url, short_slug as slug, visits');
        //Set the limits and offsets
        $this->db->limit($total, $offset);
        //Get the info
        $data = $this->db->get($this->_table);
        
        //Check if we have results
        if ($data->num_rows() > 0) {
            //Build the sort url
            $urls = $data->result();
            foreach($urls as $u){
                $u->shortUrl = base_url() . $u->slug;
            }
            //Return the info as an array of objects
            return $urls;
        } else {
            return NULL;
        }
    }
    
    /**
     * Get how many rows we have in the table
     *
     * @return int
     * @author Christopher
     */
    public function getTotal(){
        //Count the total rows
        return $this->db->count_all($this->_table);
    }
    
    /**
     * Generate a new short url
     *
     * @param string $url 
     * @return stdClass
     * @author Christopher Vallés
     */
    public function encodeUrl($url = NULL){
        //Check params
        if(is_null($url)){
            throw new Exception('Parameters error in ' . __METHOD__);
        }
        
        //Check if this url exists
        $this->db->select('short_slug');
        $this->db->where('url', $url);
        $data = $this->db->get($this->_table);
        if($data->num_rows() > 0){
            //The url exists so we return the generated url
            $row = $data->result();
            return $row[0]->short_slug;
        }
        
        //If we arrive here means that this url is not in the DB, so we have to generate a new one based on the DB id
        $data = array('url' => $url);
        
        $this->db->insert($this->_table, $data);
        //Get the id of the last insert
        $id = mysql_insert_id();
        
        //Create the slug based on the id
        $this->load->library('SlugGenerator', '', 'generator');
        $slug = $this->generator->encode($id);
        
        //Update the info on the DB
        $data = array('short_slug' => $slug);
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        //Return the slug
        return $slug;
    }
    
    /**
     * Decode the url and increment the statistics
     *
     * @param string $url 
     * @return stdClass
     * @author Christopher Vallés
     */
    public function decodeUrl($slug = NULL){
        //Check params
        if(is_null($slug)){
            throw new Exception('Parameters error in ' . __METHOD__);
        }
        
        //Get the id based on the slug
        $this->load->library('SlugGenerator', '', 'generator');
        $id = $this->generator->decode($slug);
        
        //Get the url info
        $this->db->where('id', $id);
        $url = $this->db->get($this->_table);
        
        //Check if we have results
        if($url->num_rows()){
            $row = $url->result();
            $row = $row[0];
        }else{
            return NULL;
        }
        
        //Update the visits
        $data = array('visits' => ++$row->visits);
        $this->db->where('id', $id);
        $this->db->update($this->_table, $data);
        
        return $row;
    }
}