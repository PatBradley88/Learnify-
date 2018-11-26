<?php 
include("includes/includedFiles.php"); 

// this is a comment
?>

<h1 class="pageHeadingBig">You Might Also Need</h1>

<div class="gridViewContainer">

	<?php
		$moduleQuery = mysqli_query($con, "SELECT * FROM modules ORDER BY RAND() LIMIT 10");
		
		while($row = mysqli_fetch_array($moduleQuery)) {
		
			echo "<div class = 'gridViewItem'>
					<a href='module.php?id=" . $row['id'] . "'>
						<img src='" . $row['artworkPath'] ."'>

						<div class='gridViewInfo'>"

							. $row['moduleTitle'] .

						"</div>
					</a>
				</div>";
		}
	?>
	

</div>



    		