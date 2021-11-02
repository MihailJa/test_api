<?php

class Students

{   

	public static function students_for_military($data) {
      
        // vars
		$students=[];  
        $student_age = isset($data['student_age']) && is_numeric($data['student_age']) ? $data['student_age'] : 0;
        $student_sex = isset($data['student_sex']) && is_numeric($data['student_sex']) ? $data['student_sex'] : 0;
        // where      
        if ($student_age && $student_sex) $where = "student_age=" .$student_age. " AND student_sex= ".$student_sex;       
       
        else return [];
        // info
        
        $q = DB::query("SELECT student_id, student_firstname, student_lastname, student_patronymic FROM students WHERE ".$where.";") or die (DB::error());
        if ($result = DB::fetch_all($q)) {            
            $courses = $result;
        } else {
            $courses = [
                'student_id' => '',
                'student_firstname' => '',
                'student_lastname' => '',
                'student_patronymic' => '',
                
            ];
        }

        return $courses;
    }	
	
}

?>