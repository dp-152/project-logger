<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 16:36
 */

require_once "dbinterface.php";

session_start();

$db = dbInterface::getInstance();
$db->makeProject($_POST[ 'new_project' ]);

header('Location: index.php');