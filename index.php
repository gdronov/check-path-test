<?php

include 'PathFinder.php';

$pf = new PathFinder([
    ['_', '_', '_', '_', '_'],
    ['X', 'X', 'X', 'X', '_'],
    ['_', '_', 'X', '_', '_'],
    ['X', 'X', 'X', '_', 'X'],
    ['_', '_', '_', '_', '_']
]);

var_dump($pf->pathExists([0, 0], [4, 4])); // True
var_dump($pf->pathExists([0, 0], [2, 1])); // False
var_dump($pf->pathExists([0, 3], [4, 1])); // True
var_dump($pf->pathExists([2, 1], [2, 0])); // True
var_dump($pf->pathExists([2, 0], [2, 3])); // False

