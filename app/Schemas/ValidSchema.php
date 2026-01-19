<?php
namespace app\Schemas;

use App\Libraries\MyException;
use App\Libraries\MyErrorsSchemaException;
use App\Libraries\ExceptionValidation;

class ValidSchema{
  public $value;

  public function __construct($body,$schema){
    $bd = json_decode($body,true);// to array
    if(json_last_error() !== JSON_ERROR_NONE) throw new MyException('Invalid JSON format !',400);

    $fieldSend = array_keys($bd);

    $fieldMissing = array_diff($schema,$fieldSend);

    $fieldOver = array_diff($fieldSend,$schema);
    $temp=[];
    foreach($fieldOver as $over){
      $temp[] = $over;
    }

    if(!empty($fieldMissing)) throw new MyErrorsSchemaException('Request body missing!',400,$schema);
    if(!empty($fieldOver)) throw new ExceptionValidation(['message'=>'body field not allowed!','field'=>$temp]);


    $this->value = $bd;
  }

}