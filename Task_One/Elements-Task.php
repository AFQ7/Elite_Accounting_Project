<?php

//======================================================================
// CLASS FOR ADDING INPUT ELEMENTS  
//======================================================================

class InputElements
{

/*  Input Addtion function  */
# First Input: $LableText is for adding a Label befor befor any input Element
# Second Input: $NewLine is for adding a desirable new line after printing the Lable  
# Third Input: $InputPrams is for chosing type of input Elemnt (text, password, etc.)
# Forth Input: $InputValue is for adding value to the input element
# Output (Return): $OutputShown is for showing the desired Input Element


public function addInput($LableText = null, $NewLine = false , $InputPrams = array(), $InputValue = array(), $valueLable =null) 
{
    $this->showElment($this->processInput($LableText, $NewLine, $InputPrams, $InputValue, $valueLable ));
}

private function processInput($LableTexT = null, $NewLinE = false , $InputPramS = array(), $InputValueS = array(), $ValueLable =null) 
{
    $OutputShown = "<div";

    $OutputShown .= $this->divClassFetch($InputPramS);
    $OutputShown .= $this-> labelFetch($LableTexT, $NewLinE);
    $OutputShown .= $this-> inArraylFetch($InputPramS, $InputValueS , $ValueLable);
    
    $OutputShown .= "</div>";
    return $OutputShown;

} // end of processInput function

private function divClassFetch ($TempArray = array()){
    $FetchShown = null;
    if ($TempArray != null)
    {
        foreach ($TempArray as $key => $value)
        {
            if (current($this->checkInputValues($key,$value)) == null )
            {
                if( key($this->checkInputValues($key,$value)) == 'list' || 'name'){
                    $FetchShown .= " class=";
                    $FetchShown .= "\"$value\">";
                }
            }
        }
    return $FetchShown;
    } else { return null; }
} // end of labelFetch function

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
} // end of labelFetch function


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
} // end of inputValueFetch function


private function inArraylFetch ($TempArray = array(), $TempValueArray= array(), $ValueLable =null)
{
    $intialtypeFlag =null;
    $listFlag =null;
    $inputFlag =null;
    $typeFlag =null;
    
    $FetchShown=null;

    $correctValue = false;

    $ArrayValueCount = count($TempValueArray);
    $valueArrayFlag =true;

    $recordArray = array();
    
    if ($TempArray != null)
    {
        foreach ($TempArray as $key => $value)
        {
            if (current($this->checkInputValues($key,$value)) == null )
            {
                if( $key == 'list' )
                {
                    $listFlag .= "".key($this->checkInputValues($key,$value))."";
                    $listFlag .= "=\"$value\"> ";
                    $listFlag .= "<datalist id=";
                    $listFlag .= "\"$value\"> ";
                    if ($ArrayValueCount == 0)
                    {
                        $listFlag .= "<option value=";
                        $listFlag .= "\"Intail-Value\" ";
                        $listFlag .= "> </datalist";
                        $correctValue = true;
                    } elseif ($ArrayValueCount > 0)
                    {
                        $recordArray = $this->inputValueFetch($TempValueArray);
                        for ($i = 0; $i < $ArrayValueCount; $i++)
                        {
                            $listFlag .= "<option value=";
                            $listFlag .= $recordArray[$i];
                            $listFlag .= ">";
                        } 
                        $listFlag .= "</datalist";
                        $valueArrayFlag = true;
                        $correctValue = true;
                    }
                    
                } else {
                    $inputFlag .= "".key($this->checkInputValues($key,$value))." ";
                    if($value != null){
                        $inputFlag .= "=\"$value\" ";
                    }
                    
                    $valueArrayFlag = true;
                    $correctValue = true;
                }
            } elseif (current($this->checkInputValues($key,$value)) != null )
            {
                if ($ArrayValueCount == 0)
                {
                    $typeFlag .= "".key($this->checkInputValues($key,$value))."";
                    $typeFlag .= "="."\"".current($this->checkInputValues($key,$value))."\" ";
                    $valueArrayFlag = true;
                    $correctValue = true;
                } elseif ($ArrayValueCount > 0)
                {
                    $recordArray = $this->inputValueFetch($TempValueArray);
                    for ($i = 0; $i < $ArrayValueCount; $i++)
                    {
                        $typeFlag = null;
                        $typeFlag .= "".key($this->checkInputValues($key,$value))."";
                        $typeFlag .= "="."\"".current($this->checkInputValues($key,$value))."\" ";
                        $typeFlag .= "value=";
                        $typeFlag .= $recordArray[$i];
                        $FetchShown .= "<input ".$inputFlag.$typeFlag."> ";
                        if($ValueLable == true)
                        {$FetchShown .= str_replace('"', '', $recordArray[$i]);}
                        $FetchShown .= "\n";
                    } return $FetchShown;
                    $valueArrayFlag = false;
                    $correctValue = true;
                }
            }

        } 
        if($correctValue != true)
        {
            $intialtypeFlag .= "name=";
            $intialtypeFlag .= "\"intialID\" ";
            $intialtypeFlag .= "type=";
            $intialtypeFlag .= "\"text\" ";
            $FetchShown .= "<input ".$intialtypeFlag.">";
            return $FetchShown;
        } elseif($valueArrayFlag == true)
        {
            $FetchShown .= "<input ".$inputFlag.$typeFlag.$listFlag.">";
            return $FetchShown;
        }
    } else { return null; }
} // end of inputArraylFetch function


/*  Text Check and Similarity Functions  */
# Single Input: For check and process the typed and input text with main index

private function checkInputValues ($inKeyText, $inValText)
{
    $returnIndex = array();
    foreach ($this->InputAttribute as $key => $value)
    {
        similar_text($key, $inKeyText, $simKeyPercent);
        if($simKeyPercent >= 80.0)
        {
            if (is_array($value)) 
            {
                foreach ($value as $inside)
                {
                    similar_text($inside, $inValText, $simValuePercent);
                    if ($simValuePercent >= 80.0)
                    {
                        $returnIndex[$key]=$inside;
                    }
                }
            } else { $returnIndex[$key]=null; }  
        }
    }
    return $returnIndex; 
}  // end of checkInputValues function

private function checkValueText ($inText){
    $nameShown =null;
    similar_text("value", $inText, $simPercent);
    if($simPercent >= 40.0)
    {
        return true;
    }else {return false;}
} // end of checkValueText function



/*  Show and Print to Screen Functions  */
# Single Input: For print the typed and input text on screen with desirable form

private function showElment($InVariable)
{
    echo nl2br($InVariable);
} // end of showElment function

private $InputAttribute = array (
    'accept' => null,
    'alt' => null,
    'autofocus' => null,
    'autocomplete' => array( 'on', 'off'),
    'checked' => null,
    'dirname' => null,
    'disabled' => null,
    'form' => null,
    'formaction' => null,
    'formenctype' => null,
    'formmethod' => null,
    'formnovalidate' => null,
    'formtarget' => null,
    'height' => null,
    'list' => null,
    'max' => null, 
    'min' => null,
    'maxlength' => null,
    'multiple' => null,
    'name' => null,
    'pattern' => null,
    'placeholder' => null,
    'readonly' => null,
    'size' => null,
    'src' => null,
    'step' => null,
    'type' => array('button', 'checkbox', 'color', 'date', 'datetime-local', 'email', 'file', 'hidden', 'image', 'month', 'number', 'password', 'radio', 'range', 'search', 'submit', 'tel', 'text', 'time', 'url'),
    'width' => null 
);

} // end of InputElements class


// Main Program Process and Run for using the function
/*$InputCall = new InputElements;
$InputCall->addInput("Select Gender Type:", true , array(
'name' => 'Gender',
'type' => 'radio'

), array(
    'value1' => 'Male',
    'value2' => 'Female'
), false);*/

?>