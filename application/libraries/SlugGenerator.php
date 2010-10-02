<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * This class generate slugs for the urls
 *
 * @package url_shortener
 * @author Christopher Vallés
 */
class SlugGenerator{
    
    protected $_base = '';
    
    public function __construct(){
        $this->_base = implode(range('a', 'z')) . implode(range('A', 'Z')) . implode(range(0,9));
    }
    
    /**
     * Handle the encoding of the url
     *
     * @param int $id 
     * @return string
     * @author Christopher Vallés
     */
    public function encode($id = NULL){
        if(is_null($id)){
            throw new Exception('Parameters error in ' . __METHOD__);
        }
        
        //Encode and return
        return $this->_encodeBase($id);
    }
    
    /**
     * Handle the decoding of the url
     *
     * @param string $id
     * @return int
     * @author Christopher Vallés
     */
    public function decode($slug = NULL){
        if(is_null($slug)){
            throw new Exception('Parameters error in ' . __METHOD__);
        }
        
        //Encode and return
        return $this->_decodeBase($slug);
    }
    
    /**
     * Encode the string in the target base
     *
     * @param int $id 
     * @param int $exp 
     * @return string
     * @author Christopher Vallés
     */
    private function _encodeBase($id, $exp = 1){
        //Check if we can map the id directly
        if($id <= strlen($this->_base)){
            return $this->_base[$id - 1];
        }else{
            //Calculate the base values
            $potVal = pow(strlen($this->_base), $exp);
            //Normalize the value
            $nVal = floor($id/$potVal);
            
            //Check if we have to return the character or call this function recursively
            if($nVal <= strlen($this->_base)){
                return $this->_base[$nVal] . $this->_encode($id % $potVal);
            }else{
                return $this->_encode($id, $exp++);
            }
        }
    }
    
    /**
     * Decode the string in the target base
     *
     * @param string $id
     * @return int
     * @author Christopher Vallés
     */
    private function _decodeBase($slug){
        //Reverse the string
        $slug = strrev($slug);
        //Get an array of characters
        $chars = explode('-', chunk_split($slug,1, '-'));
        unset($chars[count($chars)-1]);
        $exp = 0;
        //Loop through all the characters
        $id = '';
        foreach($chars as $c){
            //Calculate the value for each character
            $id += ((strpos($this->_base, $c)) * pow(strlen($this->_base), $exp));
            $exp++;
        }
        
        //Offset
        $id++;
        
        //Return the id
        return $id;
    }
}