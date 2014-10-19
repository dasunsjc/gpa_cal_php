<style>
	div{
		font-size: 40px;
		background-color: #D8D8D8;
		width: 200px;
		
		border-color: #848484;
		border: 2px solid navy;
	}
</style>

<?php
	$con=mysqli_connect("localhost","root","","gpaa");
	
	if(mysqli_connect_errno()){
		echo "Database connection failed.";
	}
	
	
	/// read number of credits and store them in an array
	$readCredits=mysqli_query($con,"SELECT id,value FROM Credits");
	$subjectCredits=array();
	
	while($row=mysqli_fetch_assoc($readCredits)){
		$subjectCredits[$row['id']]=$row['value'];
	}
	
	
	/// read grades for each subject and store them in an array
	$readGrades=mysqli_query($con,"SELECT subid,grade FROM User");
	$subjectGrades=array();
	
	while($row=mysqli_fetch_assoc($readGrades)){
		$subjectGrades[$row['subid']]=$row['grade'];
	}	
	
	/// calculate GP value and total credits
	$gradePoints=0.0; $totalCredits=0;
	foreach($subjectGrades as $key => $index){ 
		//echo $index." ";
		//echo $subjectCredits[$key]." ";
		if($index=='A+'){$gradePoints += 4.25*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='A'){$gradePoints += 4*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='A-'){$gradePoints += 3.75*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='B+'){$gradePoints += 3.25*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='B'){$gradePoints += 3*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='B-'){$gradePoints += 2.75*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='C+'){$gradePoints += 2.25*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='C'){$gradePoints += 2*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='C-'){$gradePoints += 1.75*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='D+'){$gradePoints += 1.25*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='D'){$gradePoints += 1*$subjectCredits[$key]; $totalCredits += $subjectCredits[$key];}
		else if($index=='F'){$gradePoints += 0; $totalCredits += $subjectCredits[$key];}
		else if($index=='AB'){$gradePoints += 0; $totalCredits += $subjectCredits[$key];}
		else{$gradePoints += 0;} //echo $gradePoints." ". $totalCredits;
	}
	
	/// calculate gpa
	$gpa=($gradePoints/$totalCredits);
	
	echo "<div>$gpa</div>";
?>
