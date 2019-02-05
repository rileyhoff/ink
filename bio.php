<?php
$title = 'Bio';
include 'top.php';
//if user signed in print manage button
if (isset($_SESSION['username'])) {
    //mangage button
    if (isset($_POST['btnManage'])) {
        if (!isset($_SESSION['manage'])) {
            $_SESSION['manage'] = true;
        } else {
            if ($_SESSION['manage']) {
                $_SESSION['manage'] = false;
            } else {
                $_SESSION['manage'] = true;
            }
        }
    }

    //initial query to select artist name (if current user has rights to update)
    $query = 'SELECT `pmkArtistId`, `fldFirstName`, `fldLastName`, `pmkAccountEmail` FROM `tblArtists` ';
    $query .= ' JOIN tblAccounts ON `fnkAccountEmail` =  `pmkAccountEmail` ';
    $query .= ' WHERE `pmkAccountEmail` LIKE ?';
    
    $insertData = array($_SESSION['username']);
    $artists = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);
    //print edit bio button if current user has rights to edit
    foreach ($artists as $artist) {
        if ($artist['pmkArtistId'] == $_GET['id']) {
            print '<a href="editBio.php?id=' . $_GET['id'] . '" class="thick" id="updateBio">Update Bio</a>';
        }
    }
    //manage button
    print '<form action="' . PHP_SELF . '?id=' . $_GET['id'] . '" method="post">';
    print '<fieldset class="buttons" id ="manage">';
    print '<input type="submit" id="btnManage" name="btnManage" value="Edit Posts" tabindex="1" class="button">';
    print '</fieldset> <!-- ends buttons -->';
    print '</form>';
}
//-------------------------------------------------------------
// Inital query to database to get artist informaition
$query = 'SELECT `pmkArtistId`, `fldFirstName`, `fldLastName`, `fldArtistEmail`,'
        . ' `fldProfilePhoto`, `fldBio`, `fldAge`, `fldHometown`,'
        . ' `fnkAccountEmail` FROM `tblArtists` ';
$query .= 'WHERE `pmkArtistId` LIKE ?';
//get id of current artist's page your are viewing
$insertData = array($_GET['id']);

$artists = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);

//print out bio information of selected artist
foreach ($artists as $artist) {
    print '<h2>' . $artist['fldFirstName'] . ' ' . $artist['fldLastName'] . '</h2>';
    if (isset($artist['fldProfilePhoto'])) {
        print '<img class="bio" src="uploads/' . $artist['fldProfilePhoto'] . '" />';
    } else {
        print '<img class="bio" src="uploads/default_profile.png" />';
    }
    print'<ul class="bio">';
    if (isset($artist['fldArtistEmail'])) {
        print '<li><p id="contact">Contact Artist:</p><a href="mailto:' . $artist['fldArtistEmail'] . '">' . $artist['fldArtistEmail'] . ' </a></li>';
    }
    if (isset($artist['fldBio'])) {
        print '<li><p>' . $artist['fldBio'] . '</p><li>';
    }
    if (isset($artist['fldAge'])) {
        print '<li><p>Age:' . $artist['fldAge'] . '</p></li>';
    }
    if (isset($artist['fldHometown'])) {
        print '<li><p>Hometown:' . $artist['fldHometown'] . '</p></li>';
    }
    print '</ul>';
    //print out all artwork for current artist
    print '<h4 class="clearFloats">Artwork</h4>';
    //selects all artwork for current artist
    $query = 'SELECT `pmkArtworkId`, `fldPhoto`, `fldTitle`, `fldMedium`, `fldPrice`, `fnkArtistId` FROM `tblArtworks` ';
    $query .= 'WHERE `fnkArtistId` LIKE ? ';
    $insertData = array($_GET['id']);
    $artworks = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);
    //display data
    foreach ($artworks as $artwork) {

        print '<article class="artwork">';
        print '<img src="uploads/' . $artwork['fldPhoto'] . '" alt="' . $artwork['fldPhoto'] . '"/>';
        print '<h3>' . $artwork['fldTitle'] . '</h3>';
        print '<p class="med">' . $artwork['fldMedium'] . '</p>';
        print '<p class="price">';
        if ($artwork['fldPrice'] == '0') {
            print 'NFS';
        } else {
            print '$' . $artwork['fldPrice'];
        }
        print '</p>';
        if (isset($_SESSION['manage']) && $_SESSION['manage']) {
            if ($artist['fnkAccountEmail'] == $_SESSION['username']) {
                include'delete.php';
            }
        }
        print '</article>';
    }
}

include 'footer.php';
?>
</body>
</html>