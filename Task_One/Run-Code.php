<?php

require ('Elements-Task.php');

$InputCall = new InputElements;
$InputCall->addInput("Select Gender:", true , array(
'list' => 'color'
), array(
    'value1' => 'Yellow',
    'value2' => 'Red',
    'value3' => 'Green'

), false);

?>