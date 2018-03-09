<?php

/**
 * Created by PhpStorm.
 * User: element
 * Date: 3/2/2018
 * Time: 2:18 AM
 */
include_once "VigenereCipher.php";
class ElementMvc_Security_AdvancedVigenereCipher extends ElementMvc_Security_VigenereCipher
{
    /**
     * @param $value
     * @param bool|false $isDecrypt
     * @return mixed
     */
    protected function handleArray($value, $isDecrypt = false)
    {
        foreach($value as $key => $val){
            $newSelf = new self();
            $value[$key] = $isDecrypt ? $newSelf->encrypt($val) : $newSelf->decrypt($val);
        }
        return $value;
    }

    /**
     * @param $value
     * @param bool|false $isDecrypt
     * @return mixed
     */
    protected function handleObject($value, $isDecrypt = false)
    {
        $objectVars = get_object_vars($value);
        foreach($objectVars as $key => $val){
            $newSelf = new self();
            $value->{$key} = $isDecrypt ? $newSelf->encrypt($val) : $newSelf->decrypt($val);
        }
        return $value;
    }

    /**
     * @param $value
     * @return mixed
     */
    public function encrypt($value)
    {
        $dataType = gettype($value);
        switch($dataType)
        {
            case "integer" :
            case "double" :
            case "string" :     return $this->handleValue($value);
            case "array" :      return $this->handleArray($value);
            case "object" :     return $this->handleObject($value);
            case "resource" :   return $value; //Resource: Encryption not needed for such.
            case "NULL" :
            case "boolean" :
            default :           return $value;
        }
    }

    /**
     * @param $value
     * @return mixed|string
     */
    public function decrypt($value)
    {
        $dataType = gettype($value);
        switch($dataType)
        {
            case "integer" :
            case "double" :
            case "string" :     return $this->handleValue($value, true);
            case "array" :      return $this->handleArray($value, true);
            case "object" :     return $this->handleObject($value, true);
            case "resource" :   return $value; //Resource: Encryption not needed for such.
            case "NULL" :
            case "boolean" :
            default :           return $value;
        }
    }

}