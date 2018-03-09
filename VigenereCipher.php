<?php

/**
 * Created by PhpStorm.
 * User: element
 * Date: 3/9/2018
 * Time: 2:59 AM
 */
class ElementMvc_Security_VigenereCipher
{
    /**
     * @return array
     * You can change/re-arrange the translator array
     */
    public function translator()
    {
        return array(
            'a'=>'Z', 'b'=>'k', 'c'=>'g', 'd'=>'n', 'e'=>'v', 'f'=>'m', 'g'=>'A', 'h'=>'B', 'i'=>'U',
            'j'=>'z', 'k'=>'l', 'l'=>'O', 'm'=>'C', 'n'=>'D', 'o'=>'R', 'p'=>'e', 'q'=>'M', 'r'=>'F',
            's'=>'c', 't'=>'H', 'u'=>'i', 'v'=>'f', 'w'=>'h', 'x'=>'s', 'y'=>'o', 'z'=>'p',
            'A'=>'x', 'B'=>'q', 'C'=>'V', 'D'=>'Q', 'E'=>'J', 'F'=>'X', 'G'=>'T', 'H'=>'G', 'I'=>'N',
            'J'=>'W', 'K'=>'a', 'L'=>'b', 'M'=>'d', 'N'=>'j', 'O'=>'r', 'P'=>'t', 'Q'=>'u', 'R'=>'w',
            'S'=>'y', 'T'=>'Y', 'U'=>'L', 'V'=>'P', 'W'=>'S', 'X'=>'E', 'Y'=>'I', 'Z'=>'K',
            0=>4, 1=>3, 2=>5, 3=>8, 4=>1, 5=>7, 6=>0, 7=>2, 8=>6, 9=>7
        );
    }

    /**
     * @param $value
     * @param bool|false $isDecrypt
     * @return string
     */
    protected function handleValue($value, $isDecrypt = false)
    {
        $value = (string)$value;
        $matrix = $isDecrypt ? array_flip($this->translator()) : $this->translator();
        $size = strlen($value);
        $i = 0;
        $encrypt = "";
        while($i < $size){
            $encrypt .= (isset($matrix[$value[$i]])) ? $matrix[$value[$i]] : $value[$i];
            $i++;
        }
        return $encrypt;
    }

    /**
     * @param $value
     * @return string
     */
    public function encrypt($value)
    {
        return $this->handleValue($value);
    }

    /**
     * @param $value
     * @return string
     */
    public function decrypt($value)
    {
        return $this->handleValue($value, true);
    }

}