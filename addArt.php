<?php
$title = 'Submit';
include 'top.php';
?>
<h2>Submit artwork</h2>
<?php
//if user not logged in
if (!isset($_SESSION['username'])) {
    print '<h3>You must be signed in to add artwork</h3>';
} else {
    //ask which artist to add artwork to
    if (!isset($_GET['a'])) {
        //Inital query to database to get artists names
        $query = 'SELECT `pmkArtistId`, `fldFirstName`, `fldLastName`, `pmkAccountEmail` FROM `tblArtists` ';
        $query .= ' JOIN tblAccounts ON `fnkAccountEmail` =  `pmkAccountEmail` ';
        $query .= ' WHERE `pmkAccountEmail` LIKE ?';
       //only select data from current user
        $insertData = array($_SESSION['username']);
        $artists = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);
        
        //display names
        print'<h3>Please select artist</h3>';
        foreach ($artists as $artist) {
            print'<a href="addArt.php?a=' . $artist['pmkArtistId'] . '" class="artist">' . $artist['fldFirstName'] . ' ' . $artist['fldLastName'] . '</a>';
        }
        //option to add an artist
        print '<a href="addArtist.php" class="artist">Add an Artist</a>';
    } else {
        //if user is logged in and specific artist is seleced.
       
        // Inital query to database to get artists names
        $query = 'SELECT `pmkArtistId`, `fldFirstName`, `fldLastName` FROM `tblArtists` ';
        $query .= ' WHERE `pmkArtistId` LIKE ?';
        //current user
        $insertData = array($_SESSION['username']);
        $artists = $thisDatabaseReader->select($query, $insertData, 1, 0, 0, 0, false, false);
        foreach ($artists as $artist) {
            print'<h3>Adding artwork for' . $artist['fldFirstName'] . ' ' . $artist['fldLastName'] . '</h3>';
        }

//=============== Initalize variables and Errors ===============
//SECTION: 1a
        // Initialize variables
        $title = 'Untitled';
        $medium = '';
        $price = '';
        //errors
        $titleERROR = false;
        $mediumERROR = false;
        $priceERROR = false;
        $photoERROR = false;

//--------------------------
// SECTION: 1b misc variables
// 
        // create array to hold error messages filled (if any).
        $errorMsg = array();
        // array used to hold form values that will be displayed, emailed or uploaded to database 
        $dataRecord = array();


//=============================================================================       
        //form to upload images 
        include 'upload.php';

//=============================================================================
//
// SECTION: 2 Process for when the form is submitted

        if (isset($_POST["btnSubmit"])) {


            //---------------------------------
            //
            // SECTION: 2a Sanitize (clean) data
            // remove any potential JavaScript or html code from users input on the
            // form.

            $title = htmlentities($_POST["txtTitle"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $title;

            $medium = htmlentities($_POST["lstMedium"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $medium;

            $price = htmlentities($_POST["txtPrice"], ENT_QUOTES, "UTF-8");
            $dataRecord[] = $price;


            //=================== ERROR check ==========================
            //SECTION: 2b check for errors in the array
            if ($medium == "") {
                $errorMsg[] = "Please select medium used";
                $mediumERROR = true;
            }

            if ($title == "") {
                $errorMsg[] = "Please enter title of artwork";
                $titleERROR = true;
            }

            if ($price != "") {
                if (!verifyNumeric($price)) {
                    $errorMsg[] = "Please enter a number for price, or leave blank for NFS";
                    $priceERROR = true;
                } else {
                    $price = 0;
                }
            }
            //check if a photo has been submited
            if ($photoRecord == '') {
                $errorMsg[] = "Please upload a photo first";
                $photoERROR = true;
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
                // to the person filling out the form (section 2f)

                $message = '<h3>Your artwork has been added.</h3>'
                        . '<h4>Here is the information you gave us.</h4>';

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
// SECTION 3a.
// If its the first time coming to the form or there are errors we are going
// to display the form.
        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { //closing of if marked with: end body submit
        
        //############################################################
        // Insert query, inserts data provided into tblArtworks
        //############################################################
            //insert into tblstudents   
            $query = 'INSERT INTO tblArtworks SET ';
            $query .= 'fldPhoto = ?, ';
            $query .= 'fldTitle = ?, ';
            $query .= 'fldMedium = ?, ';
            $query .= 'fldPrice = ?, ';
            $query .= 'fnkArtistId = ? ';
            //Data values to be passed into the query
            $insertData = array($photoRecord[0], $dataRecord[0], $dataRecord[1], $dataRecord[2], $_GET['a']);

            $artworkINSERT = $thisDatabaseWriter->insert($query, $insertData, 0, 0, 0, 0, TRUE, false);
            //check for error in instert    
            if ($artworkINSERT == false) {
                print '<p id="error">Somthing went wrong adding artwork to database</p>';
            }



            //----------------------------
            //display message created
            print $message;
            //links to view all and add another artwork
            print '<a href="viewAll.php" class="thick" id="bottom">View All</a>';
            print '<a href="addArt.php" class="thick" id="bottom">Add more art</a>';

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
                print '<a href="' . PHP_SELF . '">Reset</a>';
                print '</div>';
            }
            //HTML form
            ?>
            <label for="txtTitle" class="required">Title
                <input type="text" id="txtTitle" name="txtTitle"
                       value=""
                       tabindex="100" maxlength="20" placeholder="Untitled"
                       onfocus="this.select()"
                       >
            </label>

            <fieldset  class="listbox">	
                <label for="lstMedium">Medium</label>
                <select id="lstMedium" 
                        name="lstMedium" 
                        tabindex="200" >
                    <option value="Pencil">Pencil</option>
                    <option value="Ink">Ink</option>
                    <option value="Colored Pencil">Colored Pencil</option>
                    <option value="Acrylic Paint">Acrylic Paint</option>
                    <option value="Oil Paint">Oil Paint</option>
                    <option value="Watercolor">Watercolor</option>
                    <option value="Screen Print">Screen Print</option>
                    <option value="Photography">Photography</option>
                    <option value="Sculpture">Sculpture</option>
                    <option value="Mixed Media">Mixed Media</option>
                    <option value="other">Other</option>
                </select>
            </fieldset>

            <label for="txtPrice" >Price $
                <input type="text" id="txtPrice" name="txtPrice"
                       value=""
                       tabindex="100" maxlength="45"
                       onfocus="this.select()"
                       >
            </label>

            <fieldset class="buttons">
                <legend></legend>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit Artwork" tabindex="9" class="button">
            </fieldset> <!-- ends buttons -->
            </fieldset><!-- class ="wrapper" -->
            </form>


            <?php
        }
    }//close 'if no arist selected
}//close 'if not logged in'
include 'footer.php';
?>
</body>
</html>