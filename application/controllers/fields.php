<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fields extends CI_Controller {

  public function __construct() {
    parent::__construct();
    $this->load->model('field_model');
  }

  public function index()
  {
    $request = $this->input->get();

    $fields = $this->field_model->get_all($request);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($fields));
  }

  public function show()
  {
    $id = $this->uri->segment(2, 1);

    $field = $this->field_model->get_one($id);

    $this->output
      ->set_content_type('application/json')
      ->set_output(json_encode($field));
  }

  public function create($event_id)
  {
    $request = $this->input->post();

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

}
