<?php

class inputElements{

public function InBox($LaBle, $InType) // $LaBle is for adding a Label befor befor any input Element
// $InType is for chosing type of input Elemnt (text, password, radio, email, file, etc.) 
{
    $output = $LaBle.": <br>";
    $output.= "<input type=\"$InType\"><br>";
    return $output;
}
}

$InputCall = new inputElements; 
echo $InputCall->InBox("Username", "text");

?>