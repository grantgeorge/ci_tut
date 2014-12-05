<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tests extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
  }

  public function index()
  {

    $this->load->library('unit_test');

    $test = 1 + 1;

    $expected_result = 2;

    $test_name = 'Adds one plus one';

    echo $this->unit->run($test, $expected_result, $test_name);

    echo $this->unit->report();

    // echo $this->unit->result();


  }

  public function fields_tests()
  {

    $this->passed = 0;
    $this->failed = 0;

    $this->load->library('unit_test');

    $this->load->model('field_model');

    $this->benchmark->mark('code_start');

    $fields = $this->field_model->get_all(1);

    $this->benchmark->mark('code_end');

    echo "Query elapsed time: " . $this->benchmark->elapsed_time('code_start', 'code_end'). "\n";

    $fields_count = count($fields);

    $test_one = $fields_count > 0;

    $test_one_expect = true;

    $test_one_name = 'Fields get_all test';

    $this->unit->run($test_one, $test_one_expect, $test_one_name);

    // print_r($this->unit->report());

    // loop over $this->unit->result() and count results
    if($this->unit->result()[0]['Result'] === 'Passed')
    {
      $this->passed++;
    }
    else
    {
      $this->failed++;
    }

    echo "\033[1;32mPassed: " . $this->passed . "\033[0;31m Failed: " . $this->failed . "\n";

  }

}
