<?php
	class Module {

		private $con;
		private $id;
    
    private $title;
    private $course;
    private $lecturer;
    private $artworkPath;
		
		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
      
      $query = mysqli_query($this->con, "SELECT * FROM modules WHERE id='$this->id'");
      $module = mysqli_fetch_array($query);
      
      $this->title = $module['moduleTitle'];
      $this->course = $module['course'];
      $this->lecturer = $module['lecturer'];
      $this->artworkPath = $module['artworkPath'];
      
		}
    
    // function to retrieve the lecturer's name
    // pass ID into the sql Query to artists table.
    public function getTitle() {
      
      return $this->title;
    }
    
    public function getLecturer() {
      return new Lecturer($this->con, $this->lecturer);
    }
    
    public function getArtworkPath() {
      return $this->artworkPath;
    }
    
    public function getCourse() {
      return $this->course;
    }
    
    public function getVideoCount() {
      $query = mysqli_query($this->con, "SELECT id FROM lecture WHERE module='$this->id'");
      return mysqli_num_rows($query);
    }
    
    // create a list of all lecture IDs
    public function getLectureIds() {
      //select all the lectures from the table where the ID is the ID of this module
      $query = mysqli_query($this->con, "SELECT id FROM lecture WHERE module='$this->id'");
      
      $array = array();
      
      while($row = mysqli_fetch_array($query)) {
        // first item is the array we want to link the lecture videos to, 
        // the second parameter is the item that we want to push
        array_push($array, $row['id']);
      }
      
      return $array;
    }
    
  }
?>