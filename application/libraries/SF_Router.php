<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * SF_Router
 *
 * @package default
 * @author Christopher Vallés
 **/
class SF_Router extends CI_Router {

  /**
   * Return if the request is post
   *
   * @return void
   * @author Christopher Vallés
   **/
  function is_post(){
      return ($_SERVER['REQUEST_METHOD'] == 'POST');
  }
  
  /**
   * Return if the request is get
   *
   * @return void
   * @author Christopher Vallés
   **/
  function is_get(){
      return ($_SERVER['REQUEST_METHOD'] == 'GET');
  }

}

?>