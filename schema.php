<?php
include 'top.php';
?>
    <h2>Schema</h2>
    <!-- Create tblAccounts -->
    
   <!-- HTML generated using hilite.me --><div style="background: #f0f0f0; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #007020; font-weight: bold">CREATE</span> <span style="color: #007020; font-weight: bold">TABLE</span> <span style="color: #007020; font-weight: bold">IF</span> <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #007020; font-weight: bold">EXISTS</span> <span style="color: #06287e">tblAccounts</span> (
	pmkAccountEmail <span style="color: #902000">varchar</span>(<span style="color: #40a070">50</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldPassword <span style="color: #902000">varchar</span>(<span style="color: #40a070">20</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldUsername <span style="color: #902000">varchar</span>(<span style="color: #40a070">20</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,
	<span style="color: #007020; font-weight: bold">PRIMARY</span> <span style="color: #007020; font-weight: bold">KEY</span> (pmkAccountEmail)
);
</pre></div>

     <!-- Create tblArtists -->
     
   <!-- HTML generated using hilite.me --><div style="background: #f0f0f0; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #007020; font-weight: bold">CREATE</span> <span style="color: #007020; font-weight: bold">TABLE</span> <span style="color: #007020; font-weight: bold">IF</span> <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #007020; font-weight: bold">EXISTS</span> <span style="color: #06287e">tblArtists</span> (
	pmkArtistId <span style="color: #902000">int</span>(<span style="color: #40a070">5</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span> <span style="color: #007020">AUTO_INCREMENT</span>,
	fldFirstName <span style="color: #902000">varchar</span>(<span style="color: #40a070">20</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldLastName <span style="color: #902000">varchar</span>(<span style="color: #40a070">20</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldArtistEmail <span style="color: #902000">varchar</span>(<span style="color: #40a070">50</span>),	
	fldProfilePhoto <span style="color: #902000">varchar</span>(<span style="color: #40a070">100</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,
	fldBio <span style="color: #902000">varchar</span>(<span style="color: #40a070">500</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,
	fldAge <span style="color: #902000">int</span>(<span style="color: #40a070">3</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,
	fldHometown <span style="color: #902000">varchar</span>(<span style="color: #40a070">50</span>),
	fnkAccountEmail <span style="color: #902000">varchar</span>(<span style="color: #40a070">50</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	<span style="color: #007020; font-weight: bold">PRIMARY</span> <span style="color: #007020; font-weight: bold">KEY</span> (pmkArtistId),
	<span style="color: #007020; font-weight: bold">FOREIGN</span> <span style="color: #007020; font-weight: bold">KEY</span> (fnkAccountEmail) <span style="color: #007020; font-weight: bold">REFERENCES</span> <span style="color: #06287e">tblAccounts</span>(pmkAccountEmail)
);
</pre></div>

     <!-- Create tblArtworks -->
     
<!-- HTML generated using hilite.me --><div style="background: #f0f0f0; overflow:auto;width:auto;border:solid gray;border-width:.1em .1em .1em .8em;padding:.2em .6em;"><pre style="margin: 0; line-height: 125%"><span style="color: #007020; font-weight: bold">CREATE</span> <span style="color: #007020; font-weight: bold">TABLE</span> <span style="color: #007020; font-weight: bold">IF</span> <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #007020; font-weight: bold">EXISTS</span> <span style="color: #06287e">tblArtworks</span> (
	pmkArtworkId <span style="color: #902000">int</span>(<span style="color: #40a070">5</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span> <span style="color: #007020">AUTO_INCREMENT</span>,
	fldPhoto <span style="color: #902000">varchar</span>(<span style="color: #40a070">100</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldTitle <span style="color: #902000">varchar</span>(<span style="color: #40a070">20</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	fldMedium <span style="color: #902000">varchar</span>(<span style="color: #40a070">50</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,	
	fldPrice <span style="color: #902000">int</span>(<span style="color: #40a070">10</span>) <span style="color: #007020; font-weight: bold">DEFAULT</span> <span style="color: #60add5">NULL</span>,
	fnkArtistId <span style="color: #902000">int</span>(<span style="color: #40a070">5</span>) <span style="color: #007020; font-weight: bold">NOT</span> <span style="color: #60add5">NULL</span>,
	<span style="color: #007020; font-weight: bold">PRIMARY</span> <span style="color: #007020; font-weight: bold">KEY</span> (pmkArtworkId),
	<span style="color: #007020; font-weight: bold">FOREIGN</span> <span style="color: #007020; font-weight: bold">KEY</span> (fnkArtistId) <span style="color: #007020; font-weight: bold">REFERENCES</span> <span style="color: #06287e">tblArtists</span>(pmkArtistId)
);
</pre></div>


 
<?php
include 'footer.php';
print '</body></html>';
?>