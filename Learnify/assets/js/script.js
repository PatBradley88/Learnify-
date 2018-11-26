//creating a playlist variable

var currentContentlist =[];
var shuffleContentlist =[];
var tempContentlist =[];
var audioElement;
var mouseDown = false;
var currentIndex = 0;
var repeat = false;
var shuffle = false;
var userLoggedIn;

function openPage(url){

	//adds a "?" to the url if it doesn't find one
	if(url.indexOf("?") == -1){
		url = url + "?";
	}

	//translates url by translating characters it doesn't like into characters it does like
	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	console.log(encodedUrl);
	$("#mainContent").load(encodedUrl);
}



//formatting the time remaining
function formatTime(seconds){
	//Math.round is an oparation to round the time
	var time = Math.round(seconds);
	//Math.floor rounds the number down
	var minutes = Math.floor(time / 60);

	var seconds = time - (minutes * 60);

//if seconds are less than 10, add 0. So 3.2 will be 3.02 :)
	var extraZero;
	if(seconds < 10){
		extraZero = "0";
	}
	else {
		extraZero = "";
	}

	return minutes + ":" + extraZero + seconds;
}

function updateTimeProgressBar(audio){
	//shows the time incrasing on the left
	$(".progressTime.current").text(formatTime(audio.currentTime));
	//show the time decreasing on the right
	$(".progressTime.remaining").text(formatTime(audio.duration - audio.currentTime));

	//to increase the bar (calculating the percentage of the bar remaining according to the time)
	var progress = audio.currentTime / audio.duration * 100;
	$("playbackBar .progress").css("width", progress + "%");
}

function updateVolumeProgressBar(audio){
	//audio.volume is a decimal number between 0 and 1 that is multiplied by 100 to get percentage
	var volume = audio.volume * 100;
	$(".volumeBar .progress").css("width", volume + "%");
}


//this is a function to play the audio in the Module, the content.
//the object is called AUDIO here, but should be changed to content?!
function Audio(){

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

//EVENT LISTENER to play next lecture when current lecture has ended
	this.audio.addEventListener("ended", function(){
		nextLecture();
	});

//EVENT LISTENER to load the correct time remaining of the lecture track
	this.audio.addEventListener("canplay", function() {
		//'this' refers to the object that the event was called on
		var duration = formatTime(this.duration);
		$(".progressTime.remaining").text(duration);
	});

//EVENT LISTENER to update the progress bar while song is playing

	this.audio.addEventListener("timeupdate", function(){
		if(this.duration){
			updateTimeProgressBar(this);
		}
	});

//EVENT LISTENER to update the volume bar while song is playing

	this.audio.addEventListener("volumechange", function(){
		updateVolumeProgressBar(this);
	});

	this.setTrack = function(src){
		this.audio.src = src;
	}

//create a "play" function 
	this.play = function(){
		this.audio.play();
	}

//create a "pause" function
	this.pause = function(){
		this.audio.pause();
	}

//create a "setTime" function
	this.setTime = function(seconds){
		//sets current time to be number of seconds passed in
		this.audio.currentTime = seconds;
	}

}