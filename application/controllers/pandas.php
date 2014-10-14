<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pandas extends CI_Controller {

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
  public function index() {
    $this->load->model('panda_model', '', TRUE);

    $data['query'] = $this->panda_model->get_all();

    $this->load->view('index_view', $data);
  }

  public function single() {
    $this->load->model('panda_model', '', TRUE);

    $data['id'] = $this->uri->segment(2, 1);

    $data['panda'] = $this->panda_model->get_one($data['id']);

    $this->load->view('single_view', $data);
  }

  public function insert() {
    $this->load->model('panda_model', '', TRUE);

    $this->load->view('insert_view');
  }

  public function update() {
    $this->load->model('panda_model', '', TRUE);

    $this->load->view('update_view');
  }

  public function insert_entry() {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->insert_entry();
  }

  public function update_entry() {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->update_entry();
  }

  public function delete_entry() {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->delete_entry();
  }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
