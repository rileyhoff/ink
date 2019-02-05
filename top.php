<?php
session_start();
include "lib/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>
            <?php if (isset($title)) {
                print $title . ' - ';
            } ?>INK.</title>
        <meta charset="utf-8">
        <meta name="author" content="Riley Hoff">
        <meta name="description" content="Ink. is a site where users can sign up and either
              view other user's art, or submit their own.">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="css/base.css" type="text/css" media="screen">

        <?php
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // inlcude all libraries. 
        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
         print "<!-- require Database.php -->";

        require_once(BIN_PATH . '/Database.php');

        // %^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%^%
        //
        // Set up database connection
        //
        // generally you dont need the admin on the web
        // print "<!-- make Database connections -->";
        $dbUserName = get_current_user() . '_reader';
        $whichPass = "r"; //flag for which one to use.
        $dbName = DATABASE_NAME;

        $thisDatabaseReader = new Database($dbUserName, $whichPass, $dbName);

        $dbUserName = get_current_user() . '_writer';
        $whichPass = "w";
        $thisDatabaseWriter = new Database($dbUserName, $whichPass, $dbName);


        print '</head>';
        /*         * *********************     Body section      ********************* */

        require_once('lib/security.php');

        include "lib/validation-functions.php";

        print '<body id="' . $PATH_PARTS['filename'] . '">';
        include "nav.php";
        print'<article id="body">';
        include "header.php";

        if (DEBUG)
            print "<p>DEBUG MODE IS ON</p>";
        ?>