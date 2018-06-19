<?php

class Train{
public $train_line;
public $route_name;
public $run_number;
public $operator_id;

function __construct($t_line, $r_name, $r_number, $o_id){

  $this->train_line = $t_line;
  $this->route_name = $r_name;
  $this->run_number = $r_number;
  $this->operator_id = $o_id;
}

}







 ?>
