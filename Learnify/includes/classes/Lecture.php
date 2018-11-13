<?php
	class Lecture {
		private $con;
		private $id;
    private $mysqliData;
    private $lectureTitle;
    private $moduleId;
    private $lecturerId;
    private $duration;
    private $path;
		
		public function __construct($con, $id) {
			$this->con = $con;
			$this->id = $id;
      
      $query = mysqli_query($this->con, "SELECT * FROM lecture WHERE id='$this->id'");
      $this->mysqliData = mysql_fetch_array($query);
      $this->lectureTitle = $this->mysqliData['lectureTitle'];
      $this->moduleId = $this->mysqliData['module'];
      $this->lecturerId = $this->mysqliData['lecturer'];
      $this->duration = $this->mysqliData['duration'];
      $this->path = $this->mysqliData['path'];
      
      
		}
    
    public function getLectureTitle() {
      return $this->lectureTitle;
    } 
    
    public function getModule() {
      return new Module($this->con, $this->moduleId);
    } 
    
    public function getLecturer() {
      return new Lecturer($this->con, $this->lecturerId);
    } 
    
    public function getDuration() {
      return $this->duration;
    } 
    
    public function getPath() {
      return $this->path;
    } 
    
    public function getMysqliData() {
      return $this->mysqliData;
    } 
    
  }
?>