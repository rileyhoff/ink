<?php
$title = 'Add Artist';
include 'top.php';
?>
<article>
    <h3>add Artist</h3>
</article>


<?php
//if user not logged in
if (!isset($_SESSION['username'])) {
    print '<p>you must be signed in to add artist</p>';
    print '<a href="signIn.php">Sign In</a>';
} else {
//current user logged in
//=============== Initalize variables and Errors ===============
//SECTION: 1a
// Initialize variables
    $firstName = '';
    $lastName = '';

//errors
    $firstNameERROR = false;
    $lastNameERROR = false;


//--------------------------
// SECTION: 1b misc variables
// 
// create array to hold error messages filled (if any).
    $errorMsg = array();
// array used to hold form values that will be displayed, emailed or uploaded to database 
    $dataRecord = array();


//=============================================================================
// SECTION: 2 Process for when the form is submitted

    if (isset($_POST["btnSubmit"])) {

    //############################################################
    // Select query, selects data from tblArtists
    //############################################################
        $query = 'SELECT `fldFirstName`, `fldLastName` FROM `tblArtists`';

        $artists = $thisDatabaseReader->select($query, '', 0, 0, 0, 0, TRUE, false);

        //---------------------------------
        //
        // SECTION: 2a Sanitize (clean) data
        // remove any potential JavaScript or html code from users input on the
        // form.

        $firstName = htmlentities($_POST["txtFirstName"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $firstName;

        $lastName = htmlentities($_POST["txtLastName"], ENT_QUOTES, "UTF-8");
        $dataRecord[] = $lastName;


        //=================== ERROR check ==========================
        //SECTION: 2b check for errors in the array
        if ($firstName == "") {
            $errorMsg[] = "Please enter a first name";
            $firstNameERROR = true;
        }

        if ($lastName == "") {
            $errorMsg[] = "Please enter a last name";
            $lastNameERROR = true;
        }
        //check if name is already in database
        foreach ($artists as $artist) {
            if ($firstName == $artist['fldFirstName'] && $lastName == $artist['fldLastName']) {
                $errorMsg[] = "An artist with this name is already created";
                $firstNameERROR = true;
            }
        }

        //-----------------------------
        //
        // SECTION: 2c Process Form
        //
        // Process for when the form passes validation (the errorMsg array is empty)
        //
        if (!$errorMsg) {
            if (DEBUG)
                print "<p>Form is valid</p>";


            //@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@
            //
            // SECTION: 2d Create message
            //
            // build a message to display on the screen in section 3a and to 
            // to the person filling out the form (section 2g)

            $message = '<h2>Artist has been added.</h2>'
                    . '<h3>Here is the information you gave us.</h3>';

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


// If its the first time coming to the form or there are errors we are going
// to display the form.
    if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { //closing of if marked with: end body submit
    //############################################################
    // Insert query, inserts data provided into tblArtworks
    //############################################################ 
        $query = 'INSERT INTO tblArtists SET ';
        $query .= 'fldFirstName = ?, ';
        $query .= 'fldLastName = ?, ';
        $query .= 'fnkAccountEmail = ?';

        //Data values to be passed into the query
        $insertData = array($dataRecord[0], $dataRecord[1], $_SESSION['username']);
        
        $artworkINSERT = $thisDatabaseWriter->insert($query, $insertData, 0, 0, 0, 0, TRUE, false);
        
        //check for error in instert    
        if ($artworkINSERT == false) {
            print '<p id="error">Somthing went wrong adding artist</p>';
        }

        //----------------------------
        //display message created
        print $message;
        //links to view all and add another artwork
        print '<a href="viewAll.php" class="thick" id="bottom">View All</a>';
        print '<a href="addArt.php" class="thick" id="bottom">Add art</a>';

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
        //HTML FORM
        ?>
        <form action="<?php print PHP_SELF; ?>"
              method="post"
              id="frmAddArtist">

            <fieldset class="wrapper">

                <label for="txtFirstName" class="required">First Name
                    <input type="text" id="txtFirstName" name="txtFirstName"
                           value=""
                           tabindex="1" maxlength="20" placeholder=""
                           onfocus="this.select()"
                           >
                </label>


                <label for="txtLastName" >Last Name
                    <input type="text" id="txtLastName" name="txtLastName"
                           value=""
                           tabindex="2" maxlength="20"
                           onfocus="this.select()"
                           >
                </label>


            </fieldset><!-- class ="wrapper" -->

            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Add Artist" tabindex="3" class="button">
            </fieldset> <!-- ends buttons -->

        </form>


        <?php
    }
}
include 'footer.php';
?>
</body>
</html>