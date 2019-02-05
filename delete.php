<?php
if (isset($_POST['btnDelete'])) {
    $query = 'DELETE FROM `tblArtworks` WHERE `pmkArtworkId` = ? ';
    $insertData = array($_POST['hidArtworkId']);

    $artworkDELETE = $thisDatabaseWriter->delete($query, $insertData, 1, 0, 0, 0, TRUE, false);
    //check for error in delete    
    if ($artworkDELETE == false) {
    print '<p id="error">Somthing went wrong deleting your artwork</p>';
    }
}
?>
<form action="<?php PHP_SELF; ?>" method="post">
    <fieldset class="buttons">
            <!--  hidden element to pass through the artwork Id  -->
            <input type="hidden" name="hidArtworkId" value="<?php print $artwork['pmkArtworkId'] ?>">

        <input type="submit" id="btnDelete" name="btnDelete" value="Delete" tabindex="1" class="button">
    </fieldset> <!-- ends buttons -->
</form>  