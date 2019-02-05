<?php
include "lib/constants.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Four Year plan - Lab 5 - Data Dictionary</title>
        <meta charset="utf-8">
        <meta name="author" content="Riley Hoff">
        <meta name="description" content="Every student needs a four year plan. its crazy they are still on paper. 
              This project is an attmept to improve the situation.">

        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!--[if lt IE 9]>
        <script src="//html5shim.googlecode.com/sin/trunk/html5.js"></script>
        <![endif]-->

        <link rel="stylesheet" href="css/dictionaryStyle.css" type="text/css" media="screen">

</head>
    <!-- **********************     Body section      ********************** -->
<?php
print '<body id="' . $PATH_PARTS['filename'] . '">';
include "header.php";
include "nav.php";
?>
<style>html{display:block}</style></noscript></head><body><noscript><div class="error"><img src="themes/dot.gif" title="" alt="" class="icon ic_s_error" /> Javascript must be enabled past this point!</div></noscript><div id="page_content"><div>
<h2>tblAccounts</h2>
<table width="100%" class="print"><tr><th width="50">Column</th><th width="80">Type</th><th width="40">Null</th><th width="70">Default</th>    <th>Links to</th>
    <th>Comments</th>
</tr><tr class="odd"><td class="nowrap">pmkAccountEmail <em>(Primary)</em></td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldPassword</td><td class="nowrap" lang="en" dir="ltr">varchar(20)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldUsername</td><td class="nowrap" lang="en" dir="ltr">varchar(20)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr></table><h3>Indexes</h3><div class='no_indexes_defined hide'><div class="notice"><img src="themes/dot.gif" title="" alt="" class="icon ic_s_notice" /> No index defined!</div></div><table id="table_index"><thead><tr><th>Keyname</th><th>Type</th><th>Unique</th><th>Packed</th><th>Column</th><th>Cardinality</th><th>Collation</th><th>Null</th><th>Comment</th></tr></thead><tbody><tr class="noclick odd"><td  rowspan="1" >PRIMARY</td><td  rowspan="1" >BTREE</td><td  rowspan="1" >Yes</td><td  rowspan="1" >No</td><td>pmkAccountEmail</td><td>2</td><td>A</td><td>No</td><td  rowspan="1" ></td></tr></tbody></table></div><div>
<h2>tblArtists</h2>
<table width="100%" class="print"><tr><th width="50">Column</th><th width="80">Type</th><th width="40">Null</th><th width="70">Default</th>    <th>Links to</th>
    <th>Comments</th>
</tr><tr class="odd"><td class="nowrap">pmkArtistId <em>(Primary)</em></td><td class="nowrap" lang="en" dir="ltr">int(5)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldFirstName</td><td class="nowrap" lang="en" dir="ltr">varchar(20)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldLastName</td><td class="nowrap" lang="en" dir="ltr">varchar(20)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldArtistEmail</td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldProfilePhoto</td><td class="nowrap" lang="en" dir="ltr">varchar(100)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldBio</td><td class="nowrap" lang="en" dir="ltr">varchar(500)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldAge</td><td class="nowrap" lang="en" dir="ltr">int(3)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldHometown</td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fnkAccountEmail</td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>No</td><td class="nowrap"></td>    <td>tblAccounts -&gt; pmkAccountEmail</td>
    <td></td>
</tr></table><h3>Indexes</h3><div class='no_indexes_defined hide'><div class="notice"><img src="themes/dot.gif" title="" alt="" class="icon ic_s_notice" /> No index defined!</div></div><table id="table_index"><thead><tr><th>Keyname</th><th>Type</th><th>Unique</th><th>Packed</th><th>Column</th><th>Cardinality</th><th>Collation</th><th>Null</th><th>Comment</th></tr></thead><tbody><tr class="noclick odd"><td  rowspan="1" >PRIMARY</td><td  rowspan="1" >BTREE</td><td  rowspan="1" >Yes</td><td  rowspan="1" >No</td><td>pmkArtistId</td><td>4</td><td>A</td><td>No</td><td  rowspan="1" ></td></tr><tr class="noclick even"><td  rowspan="1" >fnkAccountEmail</td><td  rowspan="1" >BTREE</td><td  rowspan="1" >No</td><td  rowspan="1" >No</td><td>fnkAccountEmail</td><td>4</td><td>A</td><td>No</td><td  rowspan="1" ></td></tr></tbody></table></div><div>
<h2>tblArtworks</h2>
<table width="100%" class="print"><tr><th width="50">Column</th><th width="80">Type</th><th width="40">Null</th><th width="70">Default</th>    <th>Links to</th>
    <th>Comments</th>
</tr><tr class="odd"><td class="nowrap">pmkArtworkId <em>(Primary)</em></td><td class="nowrap" lang="en" dir="ltr">int(5)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldPhoto</td><td class="nowrap" lang="en" dir="ltr">varchar(100)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldTitle</td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>No</td><td class="nowrap"></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fldMedium</td><td class="nowrap" lang="en" dir="ltr">varchar(50)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="odd"><td class="nowrap">fldPrice</td><td class="nowrap" lang="en" dir="ltr">int(10)</td><td>Yes</td><td class="nowrap"><i>NULL</i></td>    <td></td>
    <td></td>
</tr><tr class="even"><td class="nowrap">fnkArtistId</td><td class="nowrap" lang="en" dir="ltr">int(5)</td><td>No</td><td class="nowrap"></td>    <td>tblArtists -&gt; pmkArtistId</td>
    <td></td>
</tr></table><h3>Indexes</h3><div class='no_indexes_defined hide'><div class="notice"><img src="themes/dot.gif" title="" alt="" class="icon ic_s_notice" /> No index defined!</div></div><table id="table_index"><thead><tr><th>Keyname</th><th>Type</th><th>Unique</th><th>Packed</th><th>Column</th><th>Cardinality</th><th>Collation</th><th>Null</th><th>Comment</th></tr></thead><tbody><tr class="noclick odd"><td  rowspan="1" >PRIMARY</td><td  rowspan="1" >BTREE</td><td  rowspan="1" >Yes</td><td  rowspan="1" >No</td><td>pmkArtworkId</td><td>21</td><td>A</td><td>No</td><td  rowspan="1" ></td></tr><tr class="noclick even"><td  rowspan="1" >fnkArtistId</td><td  rowspan="1" >BTREE</td><td  rowspan="1" >No</td><td  rowspan="1" >No</td><td>fnkArtistId</td><td>7</td><td>A</td><td>No</td><td  rowspan="1" ></td></tr></tbody></table></div><div>

 </body></html>