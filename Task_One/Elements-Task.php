<?php

//======================================================================
// CLASS FOR ADDING INPUT ELEMENTS  
//======================================================================

class InputElements{

/*  Input Addtion function  */
# First Input: $LableText is for adding a Label befor befor any input Element  
# Second Input: $InputPrams is for chosing type of input Elemnt (text, password, etc.)
# Output (Return): $OutputShown is for showing desired Input Element


public function InBox($LableText = null, $InputPrams = array()) 
{

    $OutputShown = null;
    
    if ($LableText != null) {$OutputShown .= "<label>".$LableText.": </label>";}
    // The above code is to Show the Lable of the Input Element

    $OutputShown .= "<input ";
    $OutputShown .= $this-> FetchIndex($InputPrams);
    $OutputShown .= ">";
    return print("$OutputShown");;
}

private function FetchIndex($TempArray = array())
{
    $RefrenceIndex = null;
    foreach ($TempArray as $key => $value)
    {
        $RefrenceIndex .= "$key=";
        $RefrenceIndex .= "\"$value\"";
        $RefrenceIndex .= " ";
    }
    return $RefrenceIndex;
}
}

$InputCall = new InputElements;
$InputCall->InBox("Username" ,array(
    'type' => 'text',
    'name' => 'FirstName',
    'placeholder' => 'Enter Username'
));

?>