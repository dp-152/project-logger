<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 10:32
 */

require_once "dbinterface.php";
require_once "htmlwrapper.php";

session_start();

$html = new htmlWrapper();

if ($_POST != NULL){
    $_SESSION[ 'table' ] = $_POST[ 'table_name' ];
}

$html->wrapHeader(strtoupper($_SESSION[ 'table' ]) . " - NEW LOG ENTRY");

?>
<form class="topBefore" id="form" action="submit-log.php" method="post">
    <textarea id="message" name="log_data" placeholder="LOG ENTRY"></textarea>
    <input id="submit" type="submit" value="SUBMIT">
</form>
<div class="buttons">
    <a href="index.php" class="btn green">GO TO HOME PAGE</a>
    <a href="log-history.php" class="btn red">VIEW LOG HISTORY</a>
</div>
<?php $html->wrapFooter(); ?>