<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/19
 * Time: 20:11
 */

require_once "dbinterface.php";

if ($_POST == NULL || $_POST[ 'method' ] == NULL) {
    header('Location: index.php');
}
else {

    session_start();
    $db = dbInterface::getInstance();

    switch ($_POST['method']) {
        case "page-new-entry":
            if ($_POST[ 'table' ] != NULL) {
                setCookieSession($_POST[ 'table' ]);
            }
            goToPage("new-entry.php");
            break;

        case "page-history":
            if ($_POST[ 'table' ] != NULL) {
                setCookieSession($_POST[ 'table' ]);
            }
            goToPage("log-history.php");
            break;

        case "submit-log":
            $db->makeLog( $_SESSION[ 'table' ], $_POST['log-entry']);
            goToPage("log-history.php");
            break;

        case "make-project":
            $db->makeProject($_POST[ 'project-name' ]);
            goToPage("index.php");
            break;

        case "kill-project":
            $db->killProject($_POST[ 'table' ]);
            goToPage("index.php");
            break;

        default:
            break;
    }
}

function setCookieSession($table) {
    if ($table != NULL) {
        $_SESSION[ 'table' ] = $table;
    }
}

function goToPage($page) {
    header("Location: " . $page);
}