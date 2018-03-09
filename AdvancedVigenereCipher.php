<?php

/**
 * Created by Ademola Aina.
 * Date: 3/9/2018
 * Time: 4:18 AM
 */
include_once "VigenereCipher.php";
class AdvancedVigenereCipher extends VigenereCipher
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