<?php
//form to create log out button
if (isset($_POST['btnLogOut'])) {
    session_unset();
    print'<p>You have been logged out.</p>';
}
?>
<form action="<?php PHP_SELF; ?>" method="post">
    <fieldset class="buttons">
        <input type="submit" id="btnLogOut" name="btnLogOut" value="Log Out" tabindex="1" class="button">
    </fieldset> <!-- ends buttons -->
</form>  