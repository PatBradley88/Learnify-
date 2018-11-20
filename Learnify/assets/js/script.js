//creating a playlist variable

var currentContentlist = array();
var audioElement;



//this is a function to play the audio in the Module, the content.
//the object is called AUDIO here, but should be changed to content?!
function Audio(){

	this.currentlyPlaying;
	this.audio = document.createElement('audio');

	this.setTrack = function(src){
		this.audio.src = src;
	}

}