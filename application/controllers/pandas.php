<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pandas extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('panda_model');
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
  public function index($id = 0)
  {

    $this->load->model('panda_model', '', TRUE);

    $request = $this->input->get();

    $data = $this->panda_model->get_all();

    $request['id'] = intval($request['id'],10);

    // $this->output->enable_profiler(TRUE);

    $this->output
        ->set_content_type('application/json')
        ->set_output(json_encode($data));

    // $this->load->view('index_view', $data);
  }

  public function friends($type = '', $id = 0)
  {
    echo $type;
    echo $id;
  }

  public function single()
  {
    $this->load->model('panda_model', '', TRUE);

    $data['id'] = $this->uri->segment(2, 1);

    $data['panda'] = $this->panda_model->get_one($data['id']);

    $this->load->view('single_view', $data);
  }

  public function insert()
  {
    $this->load->model('panda_model', '', TRUE);

    $this->load->view('insert_view');
  }

  public function update()
  {
    $this->load->model('panda_model', '', TRUE);

    print_r($this->input->put());

    // $this->load->view('update_view');
  }

  public function insert_entry()
  {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->insert_entry();
  }

  public function update_entry()
  {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->update_entry();
  }

  public function delete_entry()
  {
    $this->load->model('panda_model', '', TRUE);

    $this->panda_model->delete_entry();
  }

  public function test(){
    $this->load->library('unit_test');

    $this->unit->use_strict(TRUE);

    $test = $this->testingFunction(1);

    $expected_result = 2;

    $test_name = 'Test testing function';

    $this->unit->run($test, $expected_result, $test_name);

    $this->unit->run($test, $expected_result, $test_name);

    echo $this->unit->report();
  }

  public function testingFunction($input) {
    return $input + 1;
  }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
