<?php $rootdir = $this->config->item("base_url") ; ?>
<?php
	$student_id = $this->AppUser->getUserId();
	
	$student_matric_no = "" ;
	$s_bio = array() ;
	$s_birth_date = "" ;
	
	/** student_id, first_name, surname, other_name, entry_year, entry_mode, entry_level, 
		gender, birth_date, dept_id, passport_image_id, record_status **/
	
	if($student_id !== false){
		// Get Student Matric No
		$student_matric_no = $this->StudBio->getStudentMatricNo($student_id);
		
		// Get Student Basic Info
		$s_bio = $this->StudBio->getStudentBasicInfo($student_id);
		
		// Format Student Birth Date
		$s_birth_date = $this->StudBio->getStudentBirthDate($s_bio['birth_date']);
	}else{
		die("StudentID Conflict!");
	}

?>
        <div id="right">
            
            <div class="well well-sm">
                <ul class="list-unstyled">
                	<small>
                        <li><h5><i class="icon-user"></i> Matric No: <?php echo $student_matric_no; ?></h5></li>
                        <li><h6><i class="icon-lemon"></i> Surname: <?php echo $s_bio['surname']; ?></h6></li>
                        <li><h6><i class="icon-check-empty"></i> First Name: <?php echo $s_bio['first_name']; ?></h6></li>
                        <li><h6><i class="icon-circle-blank"></i> Middle Name: <?php echo $s_bio['other_name']; ?></h6></li>
                        <li><h5><i class="icon-male"></i> Gender: <?php echo $s_bio['gender']; ?></h5></li>
                        <li><h5><i class="icon-time"></i> Birth Date: <?php echo $s_birth_date; ?></h5></li>
                        <li><h6><i class="icon-building"></i> Dept: Agricultural and Environmental Engineering</h6></li>
                        <li><h5><i class="icon-level-up"></i> Level: 100</h5></li>
                        <li><h5><i class="icon-signin"></i> Entry Mode: <?php echo $s_bio['entry_mode']; ?></h5></li>
                    </small>
                </ul>
            </div>
          
        </div>