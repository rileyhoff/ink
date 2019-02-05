<?php
$title = 'Sign Up';
include 'top.php';
?>
<article>
    <h3>Sign Up</h3>
</article>
<?php
//=============== Initalize variables and Errors ===============
//SECTION: 1a
// Initialize variables
$email = '';
$password = '';
$username = '';
//errors
$emailERROR = false;
$passwordERROR = false;
$usernameERROR = false;


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
    // Select query, selects data from tblAccounts
    //############################################################
    //insert into tblstudents   
    $query = 'SELECT `pmkAccountEmail`, `fldPassword`, `fldUsername` FROM `tblAccounts`';

    $accounts = $thisDatabaseReader->select($query, '', 0, 0, 0, 0, TRUE, false);


    //---------------------------------
    //
    // SECTION: 2b Sanitize (clean) data
    // remove any potential JavaScript or html code from users input on the
    // form.

    $email = htmlentities($_POST["txtEmail"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $email;

    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;

    $username = htmlentities($_POST["txtUser"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $username;


    //=================== ERROR check ==========================
    //SECTION: 2c check for errors in the array
    if ($email == "") {
        $errorMsg[] = "Please enter an email";
        $emailERROR = true;
    }

    if ($password == "") {
        $errorMsg[] = "Please enter a password";
        $passwordERROR = true;
    }

    foreach ($accounts as $account) {
        if ($email == $account['pmkAccountEmail']) {
            $errorMsg[] = "Email is already in use";
            $emailERROR = true;
        }

        if ($username == $account['fldUsername']) {
            $errorMsg[] = "Username already in use";
            $usernameERROR = true;
        }
    }

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

        $message = '<h2>Your account has been created.</h2>';
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
// Insert query, inserts data provided into tblAccounts
//############################################################
    $query = 'INSERT INTO tblAccounts SET ';
    $query .= 'pmkAccountEmail = ?, ';
    $query .= 'fldPassword = ?, ';
    if ($dataRecord[2 != '']) {
        $query .= 'fldUsername = ? ';
        //Data values to be passed into the query
        $insertData = array($dataRecord[0], $dataRecord[1], $dataRecord[2]);
    } else {
        $query = rtrim($query, ",");
        //Data values to be passed into the query
        $insertData = array($dataRecord[0], $dataRecord[1]);
    }


    $accountINSERT = $thisDatabaseWriter->insert($query, $insertData, 0, 0, 0, 0, TRUE, false);
//check for error in instert    
    if ($accountINSERT == false) {
        print '<p id="error">Somthing went wrong creating your account</p>';
    }

    $_SESSION['username'] = $dataRecord[0];


    //----------------------------
    //display message created
    print $message;
    //links to view all and add artwork
    print '<a href="viewAll.php" id="bottom">View All</a>';
    print '<a href="addArt.php" id="bottom">Add art</a>';
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
    ?>

    <form action="<?php print PHP_SELF; ?>"
          method="post"
          id="frmSignUp">


        <label for="txtEmail" class="required">Email
            <input type="text" id="txtEmail" name="txtEmail"
                   value=""
                   tabindex="100" maxlength="50" 
                   onfocus="this.select()"
                   >
        </label>

        <label for="pwdSignIn" class="required">Password
            <input type="password" id="pwdPassword" name="pwdPassword"
                   value=""
                   tabindex="200" maxlength="20" 
                   onfocus="this.select()"
                   >
        </label>
        <label for="txtUser" class="required">Username (optional)
            <input type="text" id="txtUser" name="txtUser"
                   value=""
                   tabindex="300" maxlength="20" 
                   onfocus="this.select()"
                   >
        </label>

        <fieldset class="buttons">
            <legend></legend>
            <input type="submit" id="btnSignUp" name="btnSubmit" value="Sign Up" tabindex="400" class="button">
        </fieldset> <!-- ends buttons -->
    </form>

    <?php
}
include 'footer.php';
?>
</body>
</html>