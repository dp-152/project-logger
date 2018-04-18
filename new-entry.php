<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 10:32
 */
require_once "htmlwrapper.php";

$html = new htmlWrapper();

$html->wrapHeader("NEW LOG ENTRY");
?>
<form class="topBefore" id="form" action="submit-log.php" method="post">
    <textarea id="message" name="log_data" placeholder="LOG ENTRY"></textarea>
    <input id="submit" type="submit" value="SUBMIT">
</form>
<div class="buttons">
    <a href="index.php" class="btn green">RETURN TO PREVIOUS PAGE</a>
</div>
<?php $html->wrapFooter(); ?>