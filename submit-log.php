<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 10:33
 */

require_once 'dbinterface.php';
require_once "htmlwrapper.php";

$db = dbInterface::getInstance();
$db->logData($_POST['log_data']);

header('Location: log-history.php');

