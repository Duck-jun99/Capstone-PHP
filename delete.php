<?php 
    header("Content-type:application/json");
    error_reporting(E_ALL); 
    ini_set('display_errors',1); 

    include('dbconnect.php');

    $android = strpos($_SERVER['HTTP_USER_AGENT'], "Android");

    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {

        // * JSON 형식으로 변환해서 안드로이드에 응답을 보낸다.
        echo json_encode("20 column Delete");
     
        try{
            // SQL문을 실행하여 sensor 테이블의 데이터를 삭제.
            $stmt = $con->prepare('DELETE FROM sensor LIMIT 20;');
            
            if($stmt->execute())
            {
                $successMSG = "데이터 삭제.";
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
