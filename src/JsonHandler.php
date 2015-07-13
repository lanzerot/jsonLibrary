<?php

/**
 * @author Leo
 */

class JsonHandler{

  public function __construct(){}
  
  public function parseToObject($json){
    $this->validate();  
    $obj=json_decode($json);
    return $obj;
  }
  
  public function parseToJson($obj){
     $json=  json_encode($obj); 
     $this->validate();
     return $json;
  }
  
  
  private function validate(){
    if(json_last_error() != JSON_ERROR_NONE){ return "Invalid format JSON";}
  }
  

}
