<?php
/**
 * Created by PhpStorm.
 * User: mzalm
 * Date: 2018/04/18
 * Time: 12:26
 */

class htmlWrapper
{
    public function wrapHeader($title){ ?>
        <html>
        <head>
            <meta charset="UTF-8"/>
            <title><?php echo $title; ?></title>
            <link rel="stylesheet" href="style.css"/>
        </head>

        <body>
        <div class="table-title">
            <header><?php echo $title; ?></header>
        </div>
    <?php }

    public function wrapFooter() { ?>
        </body>
        </html>
    <?php }
} ?>