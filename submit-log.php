<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 10:33
 */

require_once "dbinterface.php";

session_start();

$db = dbInterface::getInstance();
$db->makeLog( $_SESSION[ 'table' ], $_POST['log_data']);

header('Location: log-history.php');

