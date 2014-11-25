<?php

class Field_model extends CI_Model {

  public $id;
  public $account_id;
  public $event_id;
  public $name;
  public $order;
  public $visible;

  public function __construct() {
    $this->load->database();
    parent::__construct();
  }

  public function get_all($event_id)
  {
    $query = $this->db->get_where('fields', array('event_id' => $event_id));
    return $query->result('field_model');
  }

  public function get_one($id)
  {
    $query = $this->db->get_where('fields', array('id' => $id));
    return $query->row(0,'field_model');
  }

  public function create($request)
  {
    $this->load->helper('date');

    $this->db->like('event_id', $request['event_id']);
    $this->db->from('fields');

    $request['order'] = $this->db->count_all_results() + 1;

    $now_timestamp = unix_to_human(now(), TRUE, 'eu');

    $request['updated'] = $now_timestamp;
    $request['created'] = $now_timestamp;

    $this->db->insert('fields', $request);

    if($this->db->affected_rows() > 0)
    {
      $new_field = $request;

      return $this->db->get_where('fields', array('id' => $this->db->insert_id()))
        ->row(0, 'field_model');
    }
  }

  public function update($id, $request)
  {

    $this->db->update('fields', $request, 'id = ' . $id);

    return $this->db->get_where('fields', array('id' => $id))
      ->row(0, 'field_model');
  }

  public function destroy($id)
  {
    $debug = true;

    $field = $this->db->get_where('fields', array('id' => $id))
      ->row(0,'field_model');

    $this->db->trans_start();
    $this->db->delete('fields', array('id' => $id));

    // update other fields
    $this->db->set('order', '`order`-1', FALSE);
    $this->db->where(array('event_id' => $field->event_id, 'order >' => $field->order));
    $this->db->update('fields');
    $this->db->trans_complete();

    if ($this->db->trans_status() === FALSE)
    {
      return false;
    }
    return true;
  }

}
