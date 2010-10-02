<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Model handler for login class
 *
 * @package default
 * @author Christopher Vallés
 *
 */
class m_login extends SF_Model {
    
    private $_table = 'users';
    
    /**
     * PHP5 Constructor
     *
     * @author Christopher
     */
    public function __construct(){
        parent::SF_Model();
        log_message('debug', 'M_login Model Initialized');
    }
    
    /**
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function m_login() {
        parent::SF_Model();
        log_message('debug', 'M_login Model Initialized');
    }
    
    /**
     * Verify User function
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    function verifyUser($user, $pass) {
        $this->db->select('id, user');
        $this->db->where('user', mysql_escape_string($user));
        $this->db->where('pass', sha1(mysql_escape_string($pass)));
        $this->db->limit(1);
        $query = $this->db->get($this->_table);
        return ($query->num_rows() == 1);
    }
}
?>