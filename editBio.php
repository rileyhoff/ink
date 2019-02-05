<?php
$title = 'Edit Bio';
include 'top.php';
?>
<article>
    <h2>edit Bio</h2>
</article>


<?php

//=============== Initalize variables and Errors ===============
//SECTION: 1a
// Initialize variables

$firstName = '';
$lastName = '';
$email = '';
$bio = '';
$age = '';
$hometown = '';
//errors
$photoERROR = false;
$firstNameERROR = false;
$lastNameERROR = false;
$emailERROR = false;
$bioERROR = false;
$ageERROR = false;
$hometownERROR = false;

//--------------------------
// SECTION: 1b misc variables
// 
// create array to hold error messages filled (if any).
$errorMsg = array();
// array used to hold form values that will be displayed, emailed or uploaded to database 
$dataRecord = array();


//form to upload images 
include 'upload.php';

//=============================================================================
// SECTION: 2 Process for when the form is submitted

if (isset($_POST["btnSubmit"])) {


    //---------------------------------
    //
    // SECTION: 2b Sanitize (clean) data
    // remove any potential JavaScript or html code from users input on the
    // form.

    $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $firstName;

    $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $lastName;

    $email = htmlentities($_POST["txtEmail"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $email;

    $bio = htmlentities($_POST["txaBio"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $bio;

    $age = htmlentities($_POST["lstAge"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $age;


    $hometown = htmlentities($_POST["txtHometown"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $hometown;

    //=================== ERROR check ==========================
    //SECTION: 2c check for errors in the array
    //-----------------------------
    //
    // SECTION: 2d Process Form
    //
    // Process for when the form passes validation (the errorMsg array is empty)
    //
        if (!$errorMsg) {
        if (DEBUG)
            print "<p>Form is valid</p>";


        //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
        //
        // SECTION: 2f Create message
        //
        // build a message to display on the screen in section 3a and to 
        // to the person filling out the form (section 2g)

        $message = '<h2>Your Informaiton has been updated.</h2>'
                . '<h3>Here is the what you gave us.</h3>';

        foreach ($_POST as $key => $value) {
            if ($key != "btnSubmit") {
                $message .= "<p>";

                $camelCase = preg_split('/(?=[A-Z])/', substr($key, 3));

                foreach ($camelCase as $one) {
                    $message .= $one . " ";
                }
                $message .= " - " . htmlentities($value, ENT_QUOTES, "UTF-8") . "</p>";
            }
        }
    } // end form is valid
} // ends if form was submitted.
//#############################################################################
//
//====================== Display Form======================
//SECTION: 3

print '<article id="main">';

//####################################
//
// SECTION 3a.
//
// 
// 
// 
// If its the first time coming to the form or there are errors we are going
// to display the form.
if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { //closing of if marked with: end body submit
//############################################################
// Insert query, inserts data provided into tblArtworks
//############################################################
    //insert into tblstudents 
    
    //if the feild was not submited dont add to insertData array and dont add to query
    $insertData = array();
    $query = 'UPDATE `tblArtists` SET ';
    if ($dataRecord[0] != '') {
        $query .= '` fldFirstName`= ? ,';
        $insertData[] = $dataRecord[0];
    }
    if ($dataRecord[1] != '') {
        $query .= ' `fldLastName`= ? ,';
        $insertData[] = $dataRecord[1];
    }
    if ($dataRecord[2] != '') {
        $query .= ' `fldArtistEmail`= ? ,';
        $insertData[] = $dataRecord[2];
    }
    if (isset($photoRecord[0])) {
        $query .= ' `fldProfilePhoto`= ? ,';
        $insertData[] = $photoRecord[0];
    }
    if ($dataRecord[3] != '') {
        $query .= ' `fldBio`= ? ,';
        $insertData[] = $dataRecord[3];
    }
    if ($dataRecord[4] != '') {
        $query .= ' `fldAge`= ? ,';
        $insertData[] = $dataRecord[4];
    }
    if ($dataRecord[5] != '') {
        $query .= ' `fldHomeTown`= ? ,';
        $insertData[] = $dataRecord[5];
    }
    //remove last comma of insert to prevent syntax errors in mySQL
    $query = rtrim($query, ",");
    //add to specified artist bio
    $query .= ' WHERE `pmkArtistId` LIKE ?';
    $insertData[] = $_GET['id'];

    $artistUPDATE = $thisDatabaseWriter->insert($query, $insertData, 1, 0, 0, 0, TRUE, false);
    //check for error in insert    
    if ($artistUPDATE == false) {
        print '<p id="error">Somthing went wrong updating your information</p>';
    }



    //----------------------------
    //display message created
    print $message;
    //links to view all and add another artwork

    print '<a href="bio.php?id=' . $_GET['id'] . '" id="bottom">View Bio</a>';

    print "<article id='message'>";

    print "</article>"; //close id = 'message'
} else {

    //####################################
    //
        // SECTION 3b Error Messages
    //
        // display any error messages before we print out the form

    if ($errorMsg) {
        print '<div id="errors">';
        print "<h1>Oops! There is an error with your form.</h1>";
        print "<ol>\n";
        foreach ($errorMsg as $err) {
            print "<li>" . $err . "</li>\n";
        }
        print "</ol>\n";
        print '</div>';
    }
    
    //HTML form
    ?>
    <label for="txtFirstName" >First Name
        <input type="text" id="txtFirstName" name="txtFirstName"
               value=""
               tabindex="1" maxlength="20" placeholder=""
               onfocus="this.select()"
               >
    </label>

    <label for="txtLastName" >Last Name
        <input type="text" id="txtLastName" name="txtLastName"
               value=""
               tabindex="2" maxlength="20" placeholder=""
               onfocus="this.select()"
               >
    </label>

    <label for="txtEmail" >Email
        <input type="text" id="txtEmail" name="txtEmail"
               value=""
               tabindex="3" maxlength="50"
               onfocus="this.select()"
               >
    </label>

    <label for="txaBio" >Description
        <textarea id="txaBio" name="txaBio"
                  rows="5" cols="20"
                  tabindex="4" maxlength="500" 
                  onfocus="this.select()"
                  ></textarea>
    </label>

    <fieldset  class="listbox">	
        <label for="lstAge">Age</label>
        <select id="lstAge" 
                name="lstAge" 
                tabindex="5" >
            <option value=""></option>
    <?php
    for ($i = 1; $i <= 120; $i++) {
        print '<option value="' . $i . '">' . $i . '</option>';
    }
    ?>
        </select>
    </fieldset>

    <label for="txtHometown" >Hometown
        <input type="text" id="txtHometown" name="txtHometown"
               value=""
               tabindex="6" maxlength="50"
               onfocus="this.select()"
               >
    </label>

    </fieldset><!-- class ="wrapper" -->

    <fieldset class="buttons">
        <legend></legend>
        <input type="submit" id="btnSubmit" name="btnSubmit" value="Update Bio" tabindex="9" class="button">
    </fieldset> <!-- ends buttons -->

    </form>
    <?php
}
include 'footer.php';
?>
</body>
</html>