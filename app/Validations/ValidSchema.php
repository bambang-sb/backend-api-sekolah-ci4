<?php
namespace app\Validations;

use App\Libraries\MyException;
use App\Libraries\ExceptionValidation;

class ValidSchema{
  public $value;

  public function __construct($body,$schema){
    $bd = json_decode($body,true);// to array
    if(json_last_error() !== JSON_ERROR_NONE) throw new MyException('Invalid JSON format !',400);

    //ambil key
    $fieldSchema = array_keys($schema);
    $fieldSend = array_keys($bd);

    $fieldMissing = array_diff($fieldSchema,$fieldSend);
    $fieldOver = array_diff($fieldSend,$fieldSchema);

    if(!empty($fieldMissing)){
      $tm = [];
      foreach($fieldMissing as $fm){
        $tm[$fm] = ['field '.$fm.' cannot missing!'];
      }
      throw new ExceptionValidation($tm,'Request body missing!');
    };

    if(!empty($fieldOver)){
      $temp=[];
      foreach($fieldOver as $over){
        $temp[$over] = ["field not allowed!"];
      }
      throw new ExceptionValidation($temp);
    };


    $this->value = $bd;
  }

}