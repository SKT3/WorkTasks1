<?php

//data
include_once('./src/Tasks.php');

$array = [
    ["id" => 1, "parent_id" => null, "value" => 30],
    ["id" => 2, "parent_id" => null, "value" => 50],
    ["id" => 3, "parent_id" => 1, "value" => 10],
    ["id" => 4, "parent_id" => 1, "value" => 20],
    ["id" => 5, "parent_id" => 3, "value" => 12],
    ["id" => 6, "parent_id" => 3, "value" => 15],
    ["id" => 7, "parent_id" => 2, "value" => 10]
];

$taskFunctions = new src\Tasks();

//Task1
$result = $taskFunctions->transform($array);
print_r($result);

//Task2
$result = $taskFunctions->transform($array);
$maxDepth = $taskFunctions->findMaxDepth($result);
print_r($maxDepth);

//Task3
$result = $taskFunctions->transform($array);
$ids = $taskFunctions->findItemsByValue($result, 10);
print_r($ids);

//Task4
$result = $taskFunctions->transform($array);
$item = $taskFunctions->findValueById($result, 6);
print_r($item);

//Task5
$result = $taskFunctions->transform($array);
$new_tree = $taskFunctions->removeItemById($result, 1);
print_r($new_tree);

//Task6
$result = $taskFunctions->transform($array);
$new_tree = $taskFunctions->removeDuplicates($result);
print_r($new_tree);

