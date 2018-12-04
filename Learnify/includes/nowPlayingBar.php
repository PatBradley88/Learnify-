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
		var newContentlist = <?php echo $jsonArray; ?>;
		audioElement = new Audio();
		setTrack(newContentlist[0], newContentlist, false);
		updateVolumeProgressBar(audioElement.audio);

		$("#nowPlayingBarContainer").on("mousedown touchstart mousemove touchmove", function(e){
			//prevents the default behavior for above events
			e.preventDefault();
		});

		//Sets mousedown to true when mouse is clicked
		$(".playbackBar .progressBar").mousedown(function() {
			mouseDown = true;
		});

		/*when the mouse is moved sets the time of song depending on mouse position*/
		$(".playbackBar .progressBar").mousemove(function(e) {
			if(mouseDown == true){
				timeFromOffset(e, this);
			}
		});

		$(".playbackBar .progressBar").mouseup(function(e) {
			timeFromOffset(e, this);
		});



		$(".volumeBar .progressBar").mousedown(function() {
			mouseDown = true;
		});

		/*when the mouse is moved sets the time of song depending on mouse position*/
		$(".volumeBar .progressBar").mousemove(function(e) {
			if(mouseDown == true){
				var percentage = e.offsetX / $(this).width();

				/*if percentage is between 1 and 0 then we set the volume to be that*/
				if(percentage >= 0 && percentage <= 1){
					audioElement.audio.volume = percentage;
				}
			}
		});

		$(".volumeBar .progressBar").mouseup(function(e) {
			var percentage = e.offsetX / $(this).width();

				/*if percentage is between 1 and 0 then we set the volume to be that*/
				if(percentage >= 0 && percentage <= 1){
					audioElement.audio.volume = percentage;
				}
		});

		//sets mouseup to false on entire document
		$(document).mouseup(function(){
			mouseDown = false;
		});

	});

	/*gets the time of the audio depending on how far along the mouse is*/
	function timeFromOffset(mouse, progressBar){
		var percentage = mouse.offsetX / $(progressBar).width() * 100;
		var seconds = audioElement.audio.duration * (percentage / 100);
		audioElement.setTime(seconds);
	}

	function prevLecture(){
		//if the lecture is >= 3 seconds or equal to 0 reset the lecture
		if(audioElement.audio.currentTime >= 3 || currentIndex == 0){
			audioElement.setTime(0);
		}
		//else go to the previous lecture
		else {
			currentIndex = currentIndex -1;
			setTrack(currentContentlist[currentIndex], currentContentlist, true);
		}
	}


	function nextLecture(){

		//if repeat, set lecture time to 0 and play
		if(repeat == true){
			audioElement.setTime(0);
			playLecture();
			return;
		}
		//if the current index is at the last element in the array return to the first song
		if(currentIndex == currentContentlist.length - 1){
			currentIndex = 0;
		}
		//increment through the array or lectures
		else{
			currentIndex = currentIndex + 1;
		}

		//the next track will either come from the shuffled content list or the normal content list
		var trackToPlay = shuffle ? shuffleContentlist[currentIndex] : currentContentlist[currentIndex];
		setTrack(trackToPlay, currentContentlist, true);
	}

	function setRepeat(){
		//if repeat true change to false
		//if repeat false chnage to true
		repeat = !repeat;

		//set the repeat button image
		var imageName = repeat ? "repeat-active.png" : "repeat.png";
		$(".controlButton.repeat img").attr("src", "assets/images/icons/" +imageName);
	}

	function setMute(){
		//if mute true change to false
		//if mute false chnage to true
		audioElement.audio.muted = !audioElement.audio.muted;

		//set the volume button image
		var imageName = audioElement.audio.muted ? "volume-mute.png" : "volume.png";
		$(".controlButton.volume img").attr("src", "assets/images/icons/" +imageName);
	}

	function setShuffle(){
		//if mute true change to false
		//if mute false chnage to true
		shuffle = !shuffle;

		//set the volume button image
		var imageName = shuffle ? "shuffle-active.png" : "shuffle.png";
		$(".controlButton.shuffle img").attr("src", "assets/images/icons/" +imageName);

		if(shuffle == true){
			//if true, randomize the lectures
			shuffleArray(shuffleContentlist);
			currentIndex = shuffleContentlist.indexOf(audioElement.currentlyPlaying.id);
		}
		else{
			//else, shuffle is not activated
			//returns to regular content list
			currentIndex = currentContentlist.indexOf(audioElement.currentlyPlaying.id);
		}
	}

	//function to shuffle the array
	function shuffleArray(a){
		var j, x, i;
		for(i = a.length; i; i--){
			j = Math.floor(Math.random() * i);
			x = a[i - 1];
			a[i - 1] = a[j];
			a[j] = x;
		}
	}


	function setTrack(trackId, newContentlist, play){

		//if it is a new content list set the current content list to the new contentlist
		if(newContentlist != currentContentlist){
			currentContentlist = newContentlist;
			//slice() creates a copy of the array
			shuffleContentlist = currentContentlist.slice();
			//copy is shuffled so it does not affect old content list
			shuffleArray(shuffleContentlist);
		}

		//if shuffle is on, set the index to the trackid of the shuffle content list
		if(shuffle == true){
			currentIndex = shuffleContentlist.indexOf(trackId);
		}
		else {
			//set currentIndex to index of trackid
			currentIndex = currentContentlist.indexOf(trackId);
		}
		pauseLecture();

		// audioElement.setTrack("assets/audio/Bonde_Do_Role_-_01_-_Gasolina__Contamida.mp3");

//Impement Ajax to call databse throught php even after the page is loaded
		$.post("includes/handlers/ajax/getLectureJson.php", {lectureId: trackId}, function(data){

			//ajax code to get lecture id -> lecture name to return to the page from database
			var lectureTrack = JSON.parse(data);

			//code to return the Lecture Track Name from database everytime the song changes 
			$(".trackName span").text(lectureTrack.lectureTitle)


			$.post("includes/handlers/ajax/getLecturerJson.php", {lecturerId: lectureTrack.lecturer}, function(data){
			//ajax code to get lecturer id -> lecturer name to return to the page from database
				var lecturer = JSON.parse(data);
				// console.log(lecturerTrack.name);
				$(".lectureInfo .lecturerName span").text(lecturer.name);
				$(".lectureInfo .lecturerName span").attr("onclick", "openPage('lecturer.php?id=" + lecturer.id + "')");
			});

			$.post("includes/handlers/ajax/getModuleJson.php", {moduleId: lectureTrack.module}, function(data){
			//ajax code to get lecturer id -> lecturer name to return to the page from database
				var moduleTrack = JSON.parse(data);
				// console.log(lecturerTrack.name);
				$(".content .moduleLink img").attr("src", moduleTrack.artworkPath);
				$(".content .moduleName img").attr("onclick", "openPage('module.php?id=" + module.id + "')");
				$(".trackName span").attr("onclick", "openPage('module.php?id=" + module.id + "')");
			});

			audioElement.setTrack(lectureTrack.path);

			if(play == true) {
				playLecture();
			}
		});
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
					<img role="link" tabindex="0" src="" class="albumArtWork">
				</span>

				<div class="trackInfo">
					
					<span class="trackName">
						<span role="link" tabindex="0"></span>
					</span>

					<span class="artistName">
						<span role="link" tabindex="0"></span>
					</span>

				</div>
			</div>

		</div>

		<div id=nowPlayingCenter>

			<div class="content playerControls">

				<div class="buttons">

					<button class="controlButton shuffle" title="Shuffle button" onclick="setShuffle()">
						<img src="assets/images/icons/shuffle.png" alt="Shuffle">
					</button>

					<button class="controlButton previous" title="Previous button" onclick="prevLecture()">
						<img src="assets/images/icons/previous.png" alt="previous">
					</button>

					<button class="controlButton play" title="Play button" onclick="playLecture()">
						<img src="assets/images/icons/play.png" alt="play">
					</button>

					<button class="controlButton pause" title="Pause play" style="display: none;" onclick="pauseLecture()">
						<img src="assets/images/icons/pause.png" alt="pause">
					</button>

					<button class="controlButton next" title="Next button" onclick="nextLecture()">
						<img src="assets/images/icons/next.png" alt="next">
					</button>

					<button class="controlButton repeat" title="Repeat button" onclick="setRepeat()">
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

				<button class="controlButton volume" title="Volume button" onclick="setMute()">
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