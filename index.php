<?php
require_once "htmlwrapper.php";

$html = new htmlWrapper();

$html->wrapHeader("PROJECT LOG");
?>
<div class="buttons">
    <a class="btn blue" href="new-entry.php">NEW LOG ENTRY</a>
    <a class="btn red" href="log-history.php">LOG HISTORY</a>
</div>
<?php $html->wrapFooter(); ?>