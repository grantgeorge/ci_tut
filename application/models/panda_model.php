<?php

class Panda_model extends CI_Model {

  var $id;
  var $name;
  var $beverage;
  var $class;
  var $level;
  var $likes;

  public function __construct() {
    date_default_timezone_set('America/New_York');
    // Call the Model constructor
    parent::__construct();
  }

  function get_all() {
    $query = $this->db->get('pandas');
    return $query->result('panda_model');
  }

  function get_one($id) {
    $query = $this->db->get_where('pandas', array('id' => $id));
    return $query->row(0, 'panda_model');
  }

  function insert_entry() {
    $this->name     = $_POST['name'];
    $this->beverage = $_POST['beverage'];
    $this->class    = $_POST['class'];
    $this->level    = $_POST['level'];
    $this->likes    = $_POST['likes'];
    $this->created  = date("Y-m-d H:i:s");

    $this->db->insert('pandas', $this);
  }

  function update_entry() {
    $this->id       = $_POST['id'];
    $this->name     = $_POST['name'];
    $this->beverage = $_POST['beverage'];
    $this->class    = $_POST['class'];
    $this->level    = $_POST['level'];
    $this->likes    = $_POST['likes'];
    $this->updated  = date("Y-m-d H:i:s");

    $this->db->update('pandas', $this, array('id' => $_POST['id']));
  }

  function delete_entry() {
    $this->id = $_POST['id'];

    $this->db->where('id', $_POST['id']);
    $this->db->delete('pandas');
  }

}
