<?php
$title = 'Sign In';
include 'top.php';


print '<h3>Sign In</h3>';

//=============== Initalize variables and Errors ===============
//SECTION: 1a
// Initialize variables
$user = '';
$password = '';
$currentUser = '';
//errors
$userERROR = false;
$passwordERROR = false;

//--------------------------
// SECTION: 1b misc variables
// 
// create array to hold error messages filled (if any).
$errorMsg = array();
// array used to hold form values that will be displayed, emailed or uploaded to database 
$dataRecord = array();


//=============================================================================
// SECTION: 2 Process for when the form is submitted

if (isset($_POST["btnSignIn"])) {


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

    $user = htmlentities($_POST["txtUser"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $user;

    $password = htmlentities($_POST["pwdPassword"], ENT_QUOTES, "UTF-8");
    $dataRecord[] = $password;



    //=================== ERROR check ==========================
    //SECTION: 2c check for errors in the array
    if ($user == "") {
        $errorMsg[] = "Please enter a username or email";
        $userERROR = true;
    }

    if ($password == "") {
        $errorMsg[] = "Please enter a Password";
        $passwordERROR = true;
    }

    foreach ($accounts as $account) {
        if (($account['pmkAccountEmail'] == $user || $account['fldUsername'] == $user) && $account['fldPassword'] == $password) {
            $currentUser = $account['pmkAccountEmail'];
        }
    }
    if ($currentUser == '') {
        $errorMsg[] = "Please enter valid a username and password";
        $userERROR = true;
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

        $message = '<h2>Welcome Back!</h2>';
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
if (isset($_POST["btnSignIn"]) AND empty($errorMsg)) { //closing of if marked with: end body submit
    
    //select accounts and passwords
    $query = 'SELECT `pmkAccountEmail` FROM `tblAccounts` WHERE `pmkAccountEmail` LIKE ? OR `fldUsername` LIKE ?';

    //Data values to be passed into the query
    $insertData = array($dataRecord[0], $dataRecord[0]);

    $currentAccount = $thisDatabaseReader->select($query, $insertData, 1, 1, 0, 0, TRUE, false);
    //set current user
    foreach ($currentAccount as $ca) {
        $_SESSION['username'] = $ca['pmkAccountEmail'];
    }

    print "<article id='message'>";
    //----------------------------
    //display message created
    print $message;
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
          id="frmSignIn">

        <fieldset class="wrapper">

            <label for="txtUser" class="required">Email or Username
                <input type="text" id="txtUser" name="txtUser"
                       value=""
                       tabindex="100" maxlength="50" placeholder="Enter your Email or Username"
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



        </fieldset><!-- class ="wrapper" -->

        <fieldset class="buttons">
            <legend></legend>
            <input type="submit" id="btnSignIn" name="btnSignIn" value="Sign In" tabindex="300" class="button">
        </fieldset> <!-- ends buttons -->
    </form>

    <p>Don't have an account?</p>
    <a href="signUp.php">Sign Up</a>

    </article>
    <?php
}
include 'footer.php';
?>
</body>
</html>