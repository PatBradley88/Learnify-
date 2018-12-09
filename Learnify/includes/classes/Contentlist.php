<?php
	class Contentlist {

		private $con;
		private $id;
		private $name;
		private $owner;

		public function __construct($con, $data) {
      
      if(!is_array($data)) {
        //if data is an id (string)
        $query = mysqli_query($con, "SELECT * FROM contentlists WHERE id='$data'");
        $data = mysqli_fetch_array($query);
      }
      
			$this->con = $con;
			$this->id = $data['id'];
			$this->name = $data['name'];
			$this->owner = $data['owner'];
		}

		public function getId() {
			return $this->id;
		}

		public function getName() {
			return $this->name;
		}

		public function getOwner() {
			return $this->owner;
		}
    
    public function getNumberOfVideos() {
      $query = mysqli_query($this->con, "Select id FROM contentlists WHERE id='$this->id'");
      return mysqli_num_rows($query);
    }
	}

?>