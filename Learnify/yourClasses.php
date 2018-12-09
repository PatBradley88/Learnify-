<?php
include("includes/includedFiles.php");
?>

<div class="contentlistContainer">

	<div class="gridViewContainer">
		<h2>LECTURES</h2>

		<div class="buttonItems">
			<button class="button blue" onclick="createContentlist()">New Mix</button>
		</div>


		<?php
			$username = $userLoggedIn->getUsername();
      echo "<p>" . $username . "</p>";

		    $contentlistQuery = mysqli_query($con, "SELECT * FROM contentlists WHERE owner='$username'");

		    if(mysqli_num_rows($contentlistQuery) == 0) {
		        echo "<span class='noResults'>You don't have any contentlists yet.</span>";
		    }

		    while($row = mysqli_fetch_array($contentlistQuery)) {

		    	$contentlist = new Contentlist($con, $row);
		    
		      echo "<div class = 'gridViewItem' role='link' tabindex='0' onclick='openPage(\"contentlist.php?id=" . $contentlist->getId() .  "\")'>

		      		<div class='playlistImage'>
		      			<img src='assets/images/icons/contentlist.png'>
		      		</div>

		      		<div class='gridViewInfo'>"

		              . $contentlist->getName() .

		            "</div> 
		          
		        </div>";
		    }
		  ?>


		
	</div>


</div>