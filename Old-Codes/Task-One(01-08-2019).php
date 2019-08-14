<?php
class InputElements{
function InBox($LaBle, $InType) // $LaBle is for adding a Label befor befor any input Element
// $InType is for chosing type of input Elemnt (text, password, radio, email, file, etc.) 
{
    //echo "$LaBle"; echo "<br>";
    print("<label>".$LaBle.": </label>\n <input type=\"$InType\"> "); echo "<br>";
}
}

$InputCall = new InputElements;
$InputCall->InBox("Username", "text");
?>