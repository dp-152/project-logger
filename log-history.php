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

if ($_SESSION == NULL || $_SESSION[ 'table' ] == NULL) {
    header('Location: index.php');
    die();
}

$db = dbInterface::getInstance();
$logHistory = $db->pullLog($_SESSION[ 'table' ]);

$html = new htmlWrapper();
$html->wrapHeader(strtoupper($_SESSION[ 'table' ]) . " - LOG HISTORY");
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
    foreach ($logHistory as $line) { ?>
        <tr>
            <td class="text-left"><?php echo $line[ 'log_date' ] ?></td>
            <td class="text-left"><?php echo $line[ 'log_data' ] ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<div class="buttons">
    <a href="new-entry.php" class="btn blue">CREATE NEW ENTRY</a>
    <a href="index.php" class="btn green">GO TO HOME PAGE</a>
</div>
<?php $html->wrapFooter(); ?>