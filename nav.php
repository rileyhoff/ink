<?php

// ######################     Main Navigation   ########################## 
print '<nav>';
    print '<ol id="left">';
        
        // This sets the current page to not be a link. Repeat this if block for
        //  each menu item 
 
        if ($PATH_PARTS['filename'] == "index") {
            print '<li class="activePage"><a href="index.php">Home</a></li>';
        } else {
            print '<li><a href="index.php">Home</a></li>';
        }
        if ($PATH_PARTS['filename'] == "viewAll") {
            print '<li class="activePage"><a href="viewAll.php">View All</a></li>';
        } else {
            print '<li><a href="viewAll.php">View All</a></li>';
        }
        if ($PATH_PARTS['filename'] == "addArt") {
            print '<li class="activePage"><a href="addArt.php">Submit</a></li>';
        } else {
            print '<li><a href="addArt.php">Submit</a></li>';
        }
        print'</ol>';
        print '<ol id="right">';
        if (!isset($_SESSION['username'])) {
        if ($PATH_PARTS['filename'] == "signIn") {
            print '<li class="activePage" id="signIn"><a href="signIn.php" id="signIn">Sign In</a></li>';
        } else {
            print '<li id="signIn"><a href="signIn.php" id="signIn">Sign In</a></li>';
        }
        }else{
          //  print '<li id="currentUser"><a href="manageAccount.php" id="currentUser">'.$_SESSION['username'].'</a></li>';
            print '<li><a href="manageAccount.php" id="manageAccount">Manage Account</a></li>';
        }
        

    print '</ol>';
print '</nav>';
// #################### Ends Main Navigation    ########################## -->
?>
