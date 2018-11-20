
<?php
//PHP code to add 12 random audio content (lectures) to the playing bar section
$lectureQuery = mysqli_query($con, "SELECT id FROM lecture ORDER BY RAND() LIMIT 12");

$resultArray = array();

while($row = msqli_fetch_array($lectureQuery)) {
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
		currentContenlist = <?php echo $jsonArray; ?>
		audioElement = new Audio();
		setTrack(currentContentlist[0], currentContentlist, false);

	});

	function setTrack(lectureId, newContentlist, play){

		audioElement.setTrack("assets/audio/Bonde_Do_Role_-_01_-_Gasolina__Contamida.mp3");
		audioElement.play();
	}


</script>

<div id="nowPlayingBarContainer">
	<div id="nowPlayingBar">
		<div id=nowPlayingLeft>

			<div class="content">
				<span class="albumLink">
					<img src="assets/images/icons/music.png" class="albumArtWork">
				</span>

				<div class="trackInfo">
					
					<span class="trackName">
						<span>Team Project Class</span>
					</span>

					<span class="artistName">
						<span>Year 3</span>
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

					<button class="controlButton play" title="Play button">
						<img src="assets/images/icons/play.png" alt="play">
					</button>

					<button class="controlButton pause" title="Pause play" style="display: none;">
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