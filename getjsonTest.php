<?php 

    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbconnect.php');
        

    $stmt = $con->prepare('select * from sensor');
    $stmt->execute();

    if ($stmt->rowCount() > 0)
    {
        $data = array(); 

        while($row=$stmt->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
    
            array_push($data, 
                array("log_ID"=>"$Log_ID",
		"Sensor_x"=>"$Sensor_x",
		"Sensor_y"=>"$Sensor_y",
		"Sensor_z"=>"$Sensor_z"
            ));
        }
        
	//$obj = (object) $data;
	$data = array_values($data);

        header('Content-Type: application/json; charset=utf8');
        $json = json_encode($data, JSON_PRETTY_PRINT+JSON_UNESCAPED_UNICODE);
        echo $json;
    }

?>
