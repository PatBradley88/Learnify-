<?php
	class Lecturer {

		private $con;
		private $id;
		
		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}

    public function getId() {
      return $this->id;
    }
    
    // function to retrieve the lecturer's name
    // pass ID into the sql Query to artists table.
    public function getName() {
      $lecturerQuery = mysqli_query($this->con, "SELECT name FROM lecturers WHERE id='$this->id'");
      $lecturer = mysqli_fetch_array($lecturerQuery);
      return $lecturer['name'];
    }

    public function getLectureIds() {
      //select all the lectures from the table where the ID is the ID of this module
      $query = mysqli_query($this->con, "SELECT id FROM lecture WHERE lecturer='$this->id'");
      
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