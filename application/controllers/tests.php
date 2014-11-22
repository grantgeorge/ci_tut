<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Index Page for this controller.
   *
   * Maps to the following URL
   *    http://example.com/index.php/welcome
   *  - or -
   *    http://example.com/index.php/welcome/index
   *  - or -
   * @see http://codeigniter.com/user_guide/general/urls.html
   */
  public function index()
  {
    $this->load->helper(array('form', 'url'));

    $this->load->library('form_validation');

    $this->form_validation->set_rules('username', 'Username', 'required');
    $this->form_validation->set_rules('password', 'Password', 'required');
    $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required');
    $this->form_validation->set_rules('email', 'Email', 'required');

    if ($this->form_validation->run() == FALSE)
    {
      $this->load->view('myform');
    }
    else
    {
      $this->load->view('formsuccess');
    }
  }

}
