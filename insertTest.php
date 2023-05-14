<?php 
    header("Content-type:application/json");
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbconnect.php');

   
    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        // 안드로이드 코드의 postParameters 변수에 적어준 이름을 가지고 값을 전달 받음.
       $log_ID = $_POST['log_ID'];
       $sensor_x = $_POST['sensor_x'];
       $sensor_y = $_POST['sensor_y'];
       $sensor_z = $_POST['sensor_z']; 

        // JSON 형식으로 변환해서 안드로이드에 응답을 보냄.
        echo json_encode(array("log_ID" => "$log_ID" , "sensor_x" => "$sensor_x", "sensor_y" => "$sensor_y", "sensor_z" => "$sensor_z"));
        
        if(empty($log_ID)){
            $errMSG = "ID 입력해주세요.";
        }
        else if(empty($sensor_x)){
            $errMSG = "센서값 x를 입력해주세요.";
	}
	else if(empty($sensor_y)){
	    $errMSG = "센서값 y를 입력해주세요.";
	}
	else if(empty($sensor_z)){
	    $errMSG = "센서값 z를 입력해주세요.";
	}

        if(!isset($errMSG)) // 모두 정상적으로 post 받았다면
        {
            try{
                // SQL문을 실행하여 데이터를 MariaDB 서버의 sensor 테이블에 저장. 
                $stmt = $con->prepare('INSERT INTO sensor(Log_ID, Sensor_x, Sensor_y, Sensor_z)  VALUES(:Log_ID, :Sensor_x, :Sensor_y, :Sensor_z)');
                $stmt->bindParam(':Log_ID', $log_ID);
		$stmt->bindParam(':Sensor_x', $sensor_x);
		$stmt->bindParam(':Sensor_y', $sensor_y);
		$stmt->bindParam(':Sensor_z', $sensor_z);

                if($stmt->execute())
                {
                    $successMSG = "새로운 센서값 추가";
                }
                else
                {
                    $errMSG = "센서값 추가 에러";
                }

            } catch(PDOException $e) {
                die("Database error: " . $e->getMessage()); 
            }
        }
    }


?>


<?php 
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;
?>
