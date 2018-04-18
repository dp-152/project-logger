<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 10:32
 */

require_once 'dbinterface.php';
require_once "htmlwrapper.php";

$db = dbInterface::getInstance();

$logHistory = $db->logHistory();

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td class='text-left'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$html = new htmlWrapper();
$html->wrapHeader("LOG HISTORY");
?>
<table class="table-fill">
    <thead>
        <tr>
            <th class="text-left">Date/Time</th>
            <th class="text-left">Entry</th>
        </tr>
    </thead>
    <tbody class="table-hover">
    <?php
    foreach(new TableRows(new RecursiveArrayIterator($logHistory)) as $k=>$v) {
        echo $v;
    }
    ?>
    </tbody>
</table>
<div class="buttons">
    <a href="new-entry.php" class="btn blue">CREATE NEW ENTRY</a>
    <a href="index.php" class="btn green">GO TO HOME PAGE</a>
</div>
<?php $html->wrapFooter(); ?>