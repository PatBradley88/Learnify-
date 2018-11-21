<?php
//PHP code to add 12 random audio content (lectures) to the playing bar section
$lectureQuery = mysqli_query($con, "SELECT id FROM lecture ORDER BY RAND() LIMIT 12");

$resultArray = array();

while($row = mysqli_fetch_array($lectureQuery)) {
	array_push($resultArray, $row['id']);
}

//converting the PHP array into jSon and store it in there to be interpreted by javaScript
$jsonArray = json_encode($resultArray);

?>

<!-- Script below shows under dev tools the array of 12 elements -->
<!-- <script>
	console.log(<?php //echo $jsonArray; ?>);
</script> -->


<!-- script to make currentContent play -->
<script>
		
	//this code will only be executed when everything is ready
	$(document).ready(function(){
		currentContentlist = <?php echo $jsonArray; ?>;
		audioElement = new Audio();
		
		setTrack(currentContentlist[0], currentContentlist, false);

	});

	function setTrack(trackId, newContentlist, play){

		// audioElement.setTrack("assets/audio/Bonde_Do_Role_-_01_-_Gasolina__Contamida.mp3");

//Impement Ajax to call databse throught php even after the page is loaded
		$.post("includes/handlers/ajax/getLectureJson.php", {lectureId: trackId}, function(data){
			//ajax code to get lecture id -> lecture name to return to the page from database
			var lectureTrack = JSON.parse(data);

			//code to return the Lecture Track Name from database everytime the song changes 
			$(".trackName span").text(lectureTrack.lectureTitle)


			$.post("includes/handlers/ajax/getLecturerJson.php", {lecturerId: lectureTrack.lecturer}, function(data){
			//ajax code to get lecturer id -> lecturer name to return to the page from database
				var lecturerTrack = JSON.parse(data);
				// console.log(lecturerTrack.name);
				$(".artistName span").text(lecturerTrack.name);
			});

			$.post("includes/handlers/ajax/getModuleJson.php", {moduleId: lectureTrack.module}, function(data){
			//ajax code to get lecturer id -> lecturer name to return to the page from database
				var moduleTrack = JSON.parse(data);
				// console.log(lecturerTrack.name);
				$(".albumLink img").attr("src", moduleTrack.artworkPath);
			});

			audioElement.setTrack(lectureTrack.path);
			audioElement.play();
		})

		if(play == true) {
			audioElement.play();
		}
		
	}

	function playLecture(){
		$(".controlButton.play").hide();
		$(".controlButton.pause").show();
		audioElement.play();
	}

	function pauseLecture(){
		$(".controlButton.play").show();
		$(".controlButton.pause").hide();
		audioElement.pause();
	}




</script>

<div id="nowPlayingBarContainer">
	<div id="nowPlayingBar">
		<div id=nowPlayingLeft>

			<div class="content">
				<span class="albumLink">
					<img class="albumArtWork">
				</span>

				<div class="trackInfo">
					
					<span class="trackName">
						<span></span>
					</span>

					<span class="artistName">
						<span></span>
					</span>

				</div>
			</div>

		</div>

		<div id=nowPlayingCenter>

			<div class="content playerControls">

				<div class="buttons">

					<button class="controlButton shuffle" title="Shuffle button">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button">
						<img src="assets/images/icons/previous.png" alt="previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playLecture()">
						<img src="assets/images/icons/play.png" alt="play">
					</button>

					<button class="controlButton pause" title="Pause play" style="display: none;" onclick="pauseLecture()">
						<img src="assets/images/icons/pause.png" alt="pause">
					</button>

					<button class="controlButton next" title="Next button">
						<img src="assets/images/icons/next.png" alt="next">
					</button>

					<button class="controlButton repeat" title="Repeat button">
						<img src="assets/images/icons/repeat.png" alt="repeat">
					</button>

				</div>
				
				<div class="playbackBar">

					<span class="progressTime current">0.00</span>

					<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>

					<span class="progressTime remaining">0.00</span>

				</div>


			</div>
			
		</div>

		<div id=nowPlayingRight>

			<div class="volumeBar">

				<button class="controlButton volume" title="Volume button">
					<img src="assets/images/icons/volume.png" alt="Volume">						
				</button>

				<div class="progressBar">
						<div class="progressBarBg">
							<div class="progress"></div>
						</div>
					</div>
				
			</div>
		</div>
	</div>
		
</div>