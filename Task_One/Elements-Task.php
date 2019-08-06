<?php

/* Classes' name should starts with capital letter and preferred to be in camel case */
class InputElements{

    /*
    *
    * NOTES:
    * 1- Function's name preferred to be short and in camel case.
    * 2- Variables' names also preferred to be short and in camel case.
    * 3- It is important to define the function whether it's public, private or protected.
    * 4- It is much better to give initial values to all variables if possible.
    * 5- Every function should return data, and should not echo or print anything.
    * 6- HTML code returned from a function should not have <br>, CSS codes or any style. It should be pure HTML.
    *
    * VARIABLES:
    * $txt      => is for adding a Label before any input element.
    * $params   => is all the parameters to configure the input.
    *
    */
    public function addInput($txt = null, $params = array()){
        $out = "<div";
        $divClass = $this->val('divClass', null, $params);
        if($divClass != null){
            $out.= " class=\"".$divClass."\"";
        }
        $out.= ">";
        if($txt != null){
            $out.= "<label>".$txt.":</label>";
        }
        $out.= "<input type=\"".$this->val('type', 'text', $params)."\">";
        $out.= "</div>";
        return $out;
    }
    
    private function val($index, $initialVal, $array){
        return (array_key_exists($index, $array)) ? $array[$index]  : $initialVal;
    }
}

$forms = new InputElements; 
echo $forms->addInput("Username", array(
    'type' => 'number'
));

?>