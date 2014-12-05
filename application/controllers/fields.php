<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fields extends MY_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('field_model');
  }

  public function index()
  {

    $event_id = $this->uri->segment(2);

    $fields = $this->field_model->get_all($event_id);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($fields));

    // $this->output->set_output($fields);
  }

  public function show()
  {
    $id = $this->uri->segment(5, 1);

    $field = $this->field_model->get_one($id);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($field));
  }

  public function create($event_id)
  {
    $request = $this->input->post();

    $event_id = $this->uri->segment(2);

    $request['event_id'] = $event_id;

    $new_field = $this->field_model->create($request);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($new_field));
  }

  public function update($id)
  {
    $request = $this->input->post();

    $updated_field = $this->field_model->update($id, $request);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($updated_field));
  }

  public function destroy($id)
  {
    $deleted_field = $this->field_model->destroy($id);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($deleted_field));
  }

  private function tests()
  {
    $this->load->library('unit_test');

    $test = 1 + 1;

    $expected_result = 2;

    $test_name = 'Adds one plus one';

    return $this->unit->result();
  }

}
