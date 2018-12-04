<?php
include("includes/includedFiles.php");

if(isset($_GET['term'])) {
	$term = urldecode($_GET['term']);
}
else {
	$term = "";
}
?>

<div class="searchContainer">
	
	<h4>Search for a lecturer, module or lecture</h4>
	<input type="text" class="searchInput" value="<?php echo $term; ?>" placeholder="Start typing..." onfocus="this.value = this.value">

</div>

<script>


$(".searchInput").focus();
	
$(function() {
	var timer;

	$(".searchInput").keyup(function() {
		clearTimeout(timer);

		timer = setTimeout(function() {
			var val = $(".searchInput").val();
			openPage("search.php?term=" + val);
		}, 2000)
	})
})

</script>

<?php if($term == "") exit(); ?>


<div class="lectureContainer borderBottom">
	<h2>LECTURES</h2>
  <ul class="lectureList">
    
    <?php
    $lectureQuery = mysqli_query($con, "SELECT id FROM lecture WHERE lectureTitle LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($lectureQuery) == 0) {
    	echo "<span class='noresults'>No lectures found matching " . $term . "</span>";
    }

    $lectureIdArray = array();
    
    $i=1;
    // place each lecture ID into the array
    while($row = mysqli_fetch_array($lectureQuery)) {

    	if($i > 15){
    		break;
    	}

    	array_push($lectureIdArray, $row['id']);
        
      $moduleLecture = new Lecture($con, $row['id']);
      $moduleLecturer = $moduleLecture->getLecturer();
      
      echo "<li class='lectureListRow'>
              <div class='lectureCount'> 
                <img class='play' src='assets/images/icons/play-white.png' onclick='setTrack(\"" . $moduleLecture->getId() ."\", tempContentlist, true)'>
                <span class='lectureNumber'>$i</span>
              </div>
              
              <div class='lectureInfo'> 
                <span class='lectureTitle'>" . $moduleLecture->getLectureTitle() . "</span>
                <span class='lecturerName'>" . $moduleLecturer->getName() . "</span>
              </div>
              
              <div class='lectureOptions'>
                <img class='optionsButton' src='assets/images/icons/more.png'>
              </div>
              
              <div class='lectureDuration'>
                <span class='duration'>" . $moduleLecture->getDuration() ."</span>
              </div>
              
            </li>";
      //increase the lecture count
      $i++;
      
    }
    
    ?>

<!--convert php array into json format
    convert json format into an object to access -->
    <script>
      var tempLectureIds = '<?php echo json_encode($lectureIdArray); ?>';
      tempContentlist = JSON.parse(tempLectureIds);
    </script>
  
  </ul>
</div>


<div class="lecturersContainer borderBottom">
  
    <h2>LECTURERS</h2>

    <?php
    $lecturerQuery = mysqli_query($con, "SELECT id FROM lecturers WHERE name LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($lecturerQuery) == 0) {
      echo "<span class='noresults'>No lecturers found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($lecturerQuery)) {
      $lecturerFound = new Lecturer($con, $row['id']);

      echo "<div class='searchResultRow'>
                <div class='lecturerName'>

                    <span role='link' tabindex='0' onclick'openPage(\"lecturer.php?id=" . $lecturerFound->getId() ."\")'>
                      "
                      .$lecturerFound->getName() .
                      "
                    </span>

                </div>
            </div>";

    }

    ?>


</div>


<div class="gridViewContainer">

  <h2>MODULES</h2>

  <?php
    $moduleQuery = mysqli_query($con, "SELECT * FROM modules WHERE lectureTitle LIKE '$term%' LIMIT 10");

    if(mysqli_num_rows($moduleQuery) == 0) {
        echo "<span class='noResults'>No modules found matching " . $term . "</span>";
    }

    while($row = mysqli_fetch_array($moduleQuery)) {
    
      echo "<div class = 'gridViewItem'>
          <span role='link' tabindex='0' onclick='openPage(\"module.php?id=" . $row['id'] . "\")'>
            <img src='" . $row['artworkPath'] ."'>

            <div class='gridViewInfo'>"

              . $row['moduleTitle'] .

            "</div>
          </span>
        </div>";
    }
  ?>
  

</div>











