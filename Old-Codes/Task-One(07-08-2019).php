<?php
class InputElements{
public function addInput($txt = null, $params = array()){
    $out = "<div";
    $divClass = $this-> val('divClass', null, $params);
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

function val($index, $initialVal, $array){
    return (array_key_exists($index, $array)) ? $array[$index]  : $initialVal;
}
}
$forms = new InputElements; 
echo $forms->addInput("Username", array(
'type' => 'number'
));

?>