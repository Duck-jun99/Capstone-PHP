<?php 
    header("Content-type:application/json");
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbconnect.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        echo json_encode("All Delete");
     
        try{
            // SQL문을 실행하여 sensor 테이블의 모든 데이터를 삭제.
            $stmt = $con->prepare('TRUNCATE sensor');
            
            if($stmt->execute())
            {
                $successMSG = "모든 데이터 삭제.";
            }
            else
            {
                $errMSG = "데이터 삭제 오류 발생.";
            }

        } catch(PDOException $e) {
            die("Database error: " . $e->getMessage()); 
        }

    }


?>

<?php 
    if (isset($errMSG)) echo $errMSG;
    if (isset($successMSG)) echo $successMSG;
?>
