<?php

require_once "dbinterface.php";
require_once "htmlwrapper.php";

$db = dbInterface::getInstance();
$html = new htmlWrapper();

$html->wrapHeader("PROJECT LOG");

$projects = $db->pullProjects();

?>
<div class="buttons">
    <form class="topBefore" action="post-handler.php" id="make-project" method="post">
        <input type="radio" name="method" value="make-project" checked hidden />
        <input type="text" name="project-name" /><br>
        <input type="submit" id="submit" value="CREATE PROJECT" />
    </form>
    <table class="table-fill">
    <?php foreach ($projects as $line){ ?>
        <tr>
            <td class="text-center"><h2><?php echo $line[ 'proj_name' ] ?></h2></td>
            <td class="text-center">
                <form action="post-handler.php" id="<?php echo $line[ 'proj_name' ] ?>" method="post">
                    <input type="radio" name="table" value="<?php echo $line[ 'proj_name' ] ?>" checked hidden>
                    <button value="page-new-entry" name="method" class="btn blue">NEW ENTRY</button>
                    <button value="page-history" name="method" class="btn green">VIEW HISTORY</button>
                    <button value="kill-project" name="method" class="btn red">DELETE PROJECT</button>
                </form>
            </td>
        </tr>
    <?php } ?>
    </table>
</div>
<?php $html->wrapFooter(); ?>