<?php 

if (! defined('BASEPATH')) exit('No direct script access');

class SF_Model extends Model{

    /**
     * PHP5 Constructor
     *
     * @author Christopher
     */
    public function __construct() {
        parent::Model();
    }
    
    /**
     * PHP4 Constructor
     *
     * @return void
     * @author Christopher
     */
    public function SF_Model() {
        parent::Model();
    }
    
    /**
    * Modify the array to avoid SQL Injections
    *
    * @return void
    * @author Christopher Valles
    *
    */
    protected function _cleanUp($params = NULL) {
       try {
           if (is_null($params)) {
               $this->_throwException("<strong>Function " . __FUNCTION__ . ": </strong>Error de par&aacute;metros");
           }
       }catch(Exception $e) {
           show_error($e->getMessage());
       }
       $temp = array();
       foreach($params as $k => $v) {
           if (is_array($v)) {
               $temp[$k] = $this->_cleanup($v);
           } else {
               $temp[$k] = mysql_real_escape_string($v);
           }
       }
       return $temp;
    }
    
    /**
    * Modify the array to avoid SQL Injections
    *
    * @return void
    * @author Christopher Valles
    *
    */
    protected function _strip($params = NULL, $html = NULL) {
      try {
          if (is_null($params)) {
              $this->_throwException("<strong>Function " . __FUNCTION__ . ": </strong>Error de par&aacute;metros");
          }
      }catch(Exception $e) {
          show_error($e->getMessage());
      }

      if(is_array($params)){
          foreach($params as &$p){
              $this->_strip($p, $html);
          }
      }else{
          $temp = get_object_vars($params);
          foreach($temp as $k => $v){
              if($html == TRUE){
                  $params->{$k} = stripslashes(str_replace('\n', '<br />', $v));
              }else{
                  $params->{$k} = stripslashes(str_replace('\n', chr(13), $v));
              }
          }
      }

      return $params;
    }
    
    /**
     * This function manage the request of throwing an exception
     *
     * @return void
     * @author Christopher Vallés
     *
     */
    protected function _throwException($message) {
        throw new Exception($message);
    }
}