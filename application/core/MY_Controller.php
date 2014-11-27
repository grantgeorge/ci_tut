<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

    function __construct()
    {
      parent::__construct();
    }

    function _output($output)
    {
      $this->output
        ->set_content_type('application/json');
      echo json_encode($output);
    }

    private function _utility()
    {
      // some code
    }

}
