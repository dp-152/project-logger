<?php

require_once "dbinterface.php";
require_once "htmlwrapper.php";

$db = dbInterface::getInstance();
$html = new htmlWrapper();

$html->wrapHeader("PROJECT LOG");

$projects = $db->pullProjects();

?>
<div class="buttons">
    <form action="new-entry.php" id="log-entry" method="post" hidden></form>
    <form action="log-history.php" id="log-history" method="post" hidden></form>

    <form class="topBefore" action="make-project.php" id="new-project" method="post">
        <input type="text" name="new_project" /><br>
        <input type="submit" id="submit" value="CREATE PROJECT" />
    </form>
    <table class="table-fill">
    <?php foreach ($projects as $line){ ?>
        <tr>
            <td class="text-center"><h2><?php echo $line[ 'proj_name' ] ?></h2></td>
            <td class="text-center">
                <button form="log-entry" value="<?php echo $line[ 'proj_name' ] ?>" name="table_name" class="btn blue">NEW ENTRY</button>
                <button form="log-history" value="<?php echo $line[ 'proj_name' ] ?>" name="table_name" class="btn blue">VIEW HISTORY</button>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>
<?php $html->wrapFooter(); ?>