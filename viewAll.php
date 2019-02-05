<?php
$title = 'View All';
include 'top.php';
//if user is signed in
if (isset($_SESSION['username'])) {
    //print manage button (toggles on/off)
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
    ?>
    <form action="<?php PHP_SELF; ?>" method="post">
        <fieldset class="buttons" id ="manage">
            <input type="submit" id="btnManage" name="btnManage" value="Edit Posts" tabindex="1" class="button">
        </fieldset> <!-- ends buttons -->
    </form>   
    <?php
}
//-------------------------------------------------------------
// Inital query to database to get artists names
$query = 'SELECT `pmkArtistId`, `fldFirstName`, `fldLastName`, `fnkAccountEmail` FROM `tblArtists` ';

$artists = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
//print only three artworks
foreach ($artists as $artist) {
    print '<h2 class="artist name">' . $artist['fldFirstName'] . ' ' . $artist['fldLastName'] . '</h2>';
    $query = 'SELECT `pmkArtworkId`, `fldPhoto`, `fldTitle`, `fldMedium`, `fldPrice`, `fnkArtistId` FROM `tblArtworks` ';
    $query .= 'WHERE `fnkArtistId` LIKE ? LIMIT 3';
    $insertData = array($artist['pmkArtistId']);
    $artworks = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);
    print '<div class="clearFloats">';
    foreach ($artworks as $artwork) {
        //display artworks
        print '<article class="artwork">';
        print '<img src="uploads/' . $artwork['fldPhoto'] . '" alt="' . $artwork['fldPhoto'] . '"/>';
        print '<h3>' . $artwork['fldTitle'] . '</h3>';
        print '<p class="med">' . $artwork['fldMedium'] . '</p>';
        print '<p class="price">';
        //if price is 0 display as 'NFS'
        if ($artwork['fldPrice'] == '0') {
            print 'NFS';
        } else {
            print '$' . $artwork['fldPrice'];
        }
        print '</p>';
        //if manage is turned on display delete button
        if (isset($_SESSION['manage']) && $_SESSION['manage']) {
            if ($artist['fnkAccountEmail'] == $_SESSION['username']) {
                include'delete.php';
            }
        }
        print '</article>';
    }
    //link to artist bio
    print '<a href="bio.php?id=' . $artist['pmkArtistId'] . '" class="artistBio">More...</a>';
    print'</div>';
}

include 'footer.php';
?>
</body>
</html>