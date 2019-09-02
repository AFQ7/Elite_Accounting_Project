<?php
//======================================================================
// CLASS FOR ADDING INPUT ELEMENTS  
//======================================================================
class InputElements{
/*  Input Addtion function  */
# First Input: $LableText is for adding a Label befor befor any input Element
# Second Input: $NewLine is for adding a desirable new line after printing the Lable  
# Third Input: $InputPrams is for chosing type of input Elemnt (text, password, etc.)
# Forth Input: $InputValue is for adding value to the input element
# Output (Return): $OutputShown is for showing the desired Input Element
public function addInput($LableText = null, $NewLine = false , $InputPrams = array(), $InputValue = array()) 
{
    $this->showElment($this->processInput($LableText, $NewLine, $InputPrams, $InputValue ));
}
private function processInput($LableTexT = null, $NewLinE = false , $InputPramS = array(), $InputValueS = array()) 
{
    $OutputShown = "<div";
    $OutputShown .= $this-> labelFetch($LableTexT, $NewLinE);
    $OutputShown .= $this-> inputArraylFetch($InputPramS, $InputValueS);
    //if ($LableText != null) {$OutputShown .= "<label>".$LableText."</label>";}
    // The above code is to Show the Lable of the Input Element
    //$OutputShown .= "<input ";
    //$OutputShown .= $this-> FetchIndex($InputPrams);
    $OutputShown .= "</div>";
    return $OutputShown;
}
private function labelFetch ($CommentText, $EndLine){
    $FetchShown = null;
    if ($CommentText != null) 
    {
        if ($EndLine == true)
        {
            $FetchShown .= "<label>".$CommentText."</label>"."\n"; 
        } else {$FetchShown .= "<label>".$CommentText."</label>";}
        return $FetchShown;
    } else { return null; }
}
private function inputArraylFetch ($TempArray = array(), $TempValueArray= array())
{
    $typeFlag =null;
    $nameFlag =null;
    $identityFlag =null;
    $typeFlag =null;
    $FetchShown=null;
    $correctValue = false;
    $vlaueArrayCount = count($TempValueArray);
    $recordArray = array();
    $valueArrayFlag =true;
    if ($TempArray != null)
    {
        foreach ($TempArray as $key => $value)
        {
            if ($this->checkNameVlaue($key) == true )
            {
                $nameFlag .= "name=";
                $nameFlag .= "\"$value\" ";
                $correctValue = true;
            } elseif($this->checkTypeValue($key) == true) 
            {
                if ($vlaueArrayCount == 0)
                {
                    $typeFlag .= "type=";
                    $typeFlag .= "\"$value\" ";
                    $correctValue = true;
                } elseif ($vlaueArrayCount > 0)
                {
                    $recordArray = $this->inputValueFetch($TempValueArray);
                    for ($i = 0; $i < $vlaueArrayCount; $i++)
                    {
                        $typeFlag .= "type=";
                        $typeFlag .= "\"$value\" ";
                        $typeFlag .= "value=";
                        $typeFlag .= $recordArray[$i];
                        $FetchShown .= "<input ".$nameFlag.$typeFlag.$identityFlag."> ";
                        $FetchShown .= str_replace('"', '', $recordArray[$i]);;
                        $FetchShown .= "\n";
                    } return $FetchShown;
                    $valueArrayFlag = false;
                    $correctValue = true;
                }
            }elseif($this->checkListValue($key) == true) 
            {
                if ($vlaueArrayCount == 0)
                {
                    $typeFlag .= "list=";
                    $typeFlag .= "\"$value\"> ";
                    $typeFlag .= "<datalist id=";
                    $typeFlag .= "\"$value\"> ";
                    $typeFlag .= "<option value=";
                    $typeFlag .= "\"Intail-Value\" ";
                    $typeFlag .= "> </datalist";
                    $correctValue = true;
                } elseif ($vlaueArrayCount > 0)
                {
                    $recordArray = $this->inputValueFetch($TempValueArray);
                    $FetchShown .= "<input ";
                    $FetchShown .= "list=";
                    $FetchShown .= "\"$value\" ";
                    $FetchShown .= "".$nameFlag.$identityFlag.">";
                    $FetchShown .= "<datalist id=";
                    $FetchShown .= "\"$value\"> ";
                    for ($i = 0; $i < $vlaueArrayCount; $i++)
                    {
                        $FetchShown .= "<option value=";
                        $FetchShown .= $recordArray[$i];
                        $FetchShown .= "> \n";
                    } 
                    return $FetchShown;
                    $valueArrayFlag = false;
                    $correctValue = true;
                }
            }
        } 
        if($correctValue != true)
        {
            $nameFlag .= "name=";
                $nameFlag .= "\"intialID\" ";
                $typeFlag .= "type=";
                $typeFlag .= "\"text\" ";
        }
        if($valueArrayFlag == true)
        {
            $FetchShown .= "<input ".$nameFlag.$typeFlag.$identityFlag.">";
            return $FetchShown;
        }
    } else { return null; }
}
private function inputValueFetch ($TempArray = array())
{
    $listValueFlag =null;
    $inputValueFlag=null;
    $FetchShownArray= array();
    if ($TempArray != null)
    {
        foreach ($TempArray as $key => $value)
        {
            if ($this->checkValueText($key) == true )
            {
                $inputValueFlag = "\"$value\"";
            } array_push($FetchShownArray, $inputValueFlag);
        } return $FetchShownArray;
    } else { return null; }
}
private function checkListValue ($inText){
    $nameShown =null;
    similar_text("list", $inText, $simPercent);
    if($simPercent >= 40.0)
    {
        return true;
    }else {return false;}
}
private function checkNameVlaue ($inText){
    $nameShown =null;
    similar_text("name", $inText, $simPercent);
    if($simPercent >= 40.0)
    {
        return true;
    }else {return false;}
}
private function checkValueText ($inText){
    $nameShown =null;
    similar_text("value", $inText, $simPercent);
    if($simPercent >= 40.0)
    {
        return true;
    }else {return false;}
}
private function checkTypeValue ($inText){
    $nameShown =null;
    similar_text("type", $inText, $simPercent);
    if($simPercent >= 40.0)
    {
        return true;
    }else {return false;}
}
private function showElment($InVariable)
{
    echo nl2br($InVariable);
}
}
$InputCall = new InputElements;
$InputCall->addInput("Username", true , array(
'name' => 'Gender',
'list' => 'Gender'
), array(
    'value1' => 'Male',
    'value2' => 'Female',
    'value3' => 'Other'
));
?>
