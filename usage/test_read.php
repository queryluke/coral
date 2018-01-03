<?php
/*
**************************************************************************************************************************
** CORAL Usage Statistics Module
**
** Copyright (c) 2010 University of Notre Dame
**
** This file is part of CORAL.
**
** CORAL is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 3 of the License, or (at your option) any later version.
**
** CORAL is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU General Public License for more details.
**
** You should have received a copy of the GNU General Public License along with CORAL.  If not, see <http://www.gnu.org/licenses/>.
**
**************************************************************************************************************************
*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

ini_set("auto_detect_line_endings", true);
include_once 'directory.php';

$util = new Utility();


$target_path = '/coral/usage/archive/20171019.JR1_EBSCO_2016.txt';
$file_handle = $util->utf8_fopen_read($target_path, false);
var_dump($file_handle);

while (!feof($file_handle)) {
    //get each line out of the file handler
    $line = stream_get_line($file_handle, 10000000, "\n");
    var_dump($line);
}