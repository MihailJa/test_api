<?php


class Courses

{   //return array of books or authors   
	

	public static function courses_by_student($data) {        
        // vars
		$courses=[];
        $user_id = isset($data['student_id']) && is_numeric($data['student_id']) ? $data['student_id'] : 0;
        
        // where
        if ($user_id) $where = "stud_cours.student_id='".$user_id."'";       
        else return [];
        // info
        $q = DB::query("SELECT courses.course_id, course_name FROM courses  INNER JOIN stud_cours 
		ON courses.course_id = stud_cours.course_id  WHERE ".$where.";") or die (DB::error());
        if ($result = DB::fetch_all($q)) {            
            $courses = $result;
        } else {
            $courses = [
                'course_id' => '',
                'course_name' => ''               
                
            ];
        }

        return $courses;
    }	
	
}

?>