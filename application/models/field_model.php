<?php

class Field_model extends CI_Model {

  var $id;
  var $account_id;
  var $event_id;
  var $name;
  var $order;
  var $visible;

  public function __construct() {
    $this->load->database();
    parent::__construct();
  }

  public function get_all($request)
  {
    $query = $this->db->get_where('fields', $request);
    return $query->result('field_model');
  }

  public function get_one($id)
  {
    $query = $this->db->get_where('fields', array('id' => $id));
    return $query->row(0,'field_model');
  }

  public function create($request)
  {

    $this->db->like('event_id', $request['event_id']);
    $this->db->from('fields');

    $request['order'] = $this->db->count_all_results() + 1;

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
