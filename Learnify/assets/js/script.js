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
var timer;

//event that hides menu when clicking away
$(document).click(function(click) {
	var target = $(click.target);

	//condition to the click
	if(!target.hasClass("item") && !target.hasClass("optionsButton")) {
		hideOptionsMenu();
	}
});

//event that hides menu on scrowling
$(window).scroll(function() {
	hideOptionsMenu();
});

function openPage(url){

	if(timer != null) {
		clearTimeout(timer);
	}

	//adds a "?" to the url if it doesn't find one
	if(url.indexOf("?") == -1){
		url = url + "?";
	}

	//translates url by translating characters it doesn't like into characters it does like
	var encodedUrl = encodeURI(url + "&userLoggedIn=" + userLoggedIn);
	$("#mainContent").load(encodedUrl);
	//scrolls automatically to the top when we change page
	$("body").scrollTop(0);
	//puts the url into the history(address bar)
	history.pushState(null, null, url);
}

function updateEmail(emailClass) {
	var emailValue = $("." + emailClass).val();

	$.post("includes/handlers/ajax/updateEmail.php", { email: emailValue, username: userLoggedIn})
	.done(function(response) {
		$("." +emailClass).nextAll(".message").text(response);
	})
}

function updatePassword(oldPasswordClass, newPasswordClass1, newPasswordClass2) {
	var oldPassword = $("." + oldPasswordClass).val();
	var newPassword1 = $("." + newPasswordClass1).val();
	var newPassword2 = $("." + newPasswordClass2).val();

	$.post("includes/handlers/ajax/updatePassword.php", { oldPassword: oldPassword, 
		newPassword1: newPassword1, 
		newPassword2: newPassword2, 
		username: userLoggedIn})

	.done(function(response) {
		$("." +oldPasswordClass).nextAll(".message").text(response);
	})
}


//Logout function from settings page
function logout() {
$.post("includes/handlers/ajax/logout.php", function() {
 		location.reload();
 	});
}
 
 
//function to hide the options menu, add to the window.scroll so when scroll disapears
function hideOptionsMenu(){
	var menu = $(".optionsMenu");
	if(menu.css("display") != "none"){
		menu.css("display", "none");
	}
}
 

// >>>>>>> cae6cccb260c4824604bd3465fcd5c5f970f14f3
// //function to make the menu appear beside the "..."

function showOptionsMenu(button){
	var menu = $(".optionsMenu");
	var menuWidth = menu.width();
	//scroll top takes the position (distance) from the top and how far is from the top of the start of the page
	var scrollTop = $(window).scrollTop();
	//gets the position of the button from the top of the document
	var elementOffset = $(button).offset().top;
	//calculating the position to place the menu
	var top = elementOffset - scrollTop
	//calculates the distance from the left
	var left = $(button).position().left;

	menu.css({"top":top + "px", "left":left - menuWidth +"px", "display":"inline"});
// >>>>>>> 9592fd7015fb92342822655c57411569aae92586
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

function playFirstSong(){
	setTrack(tempContentlist[0], tempContentlist, true);
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