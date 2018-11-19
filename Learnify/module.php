<?php include("includes/header.php"); 
  
  if(isset($_GET['id'])) {
    $moduleID = $_GET['id'];
  }
  else {
    header("Location: index.php");
  }

// you will need to rename the Modules table to be 'modules'
// $moduleQuery = mysqli_query($con, "SELECT * FROM modules WHERE id='$moduleID'");
// $module = mysqli_fetch_array($moduleQuery);

// get the ID of the lecturer for the module in the modules table. will return an int.
// $lecturerId = $module['lecturer'];

$module = new Module($con, $moduleID);
$lecturer = $module->getLecturer();

// new Lecturer($con, $lecturerId);

// echo $module->getTitle(). "<br>";
// //get name of lecturer for the module
// echo $lecturer->getName();
?>

<div class="entityInfo">
   <div class="leftSection">
     <img src="./<?php echo $module->getArtworkPath(); ?>">
    
  </div>
  <div class="rightSection">
    <h2>
      <?php echo $module->getTitle(); ?>
    </h2>
    <p><?php echo $lecturer->getName(); ?></p>
    <p><?php echo $module->getVideoCount(); ?> Videos</p>
  </div>
</div>

<div class="lectureContainer">
  <ul class="lectureList">
    
    <?php
    $lectureIdArray = $module->getLectureIds();
    
    $i=1;
    // place each lecture ID into the array
    foreach($lectureIdArray as $lectureId) {
        
      $moduleLecture = new Lecture($con, $lectureId);
      $moduleLecturer = $moduleLecture->getLecturer();
      
      echo "<li class='lectureListRow'>
              <div class='lectureCount'> 
                <img class='play' src='assets/images/icons/play-white.png'>
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
  
  </ul>
</div>


<?php include("includes/footer.php"); ?>