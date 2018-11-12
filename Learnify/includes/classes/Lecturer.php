<?php
	class Lecturer {

		private $con;
		private $id;
		
		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
		}
    
    // function to retrieve the lecturer's name
    // pass ID into the sql Query to artists table.
    public function getName() {
      $lecturerQuery = mysqli_query($this->con, "SELECT name FROM lecturers WHERE id='$this->id'");
      $lecturer = mysqli_fetch_array($lecturerQuery);
      return $lecturer['name'];
    }
  }
?>