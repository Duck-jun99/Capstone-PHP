<?php

    $host = 'MY_IP'; # IP 주소
    $username = 'MY_NAME'; # MariaDB 계정 아이디
    $password = 'MY_PASSWORD'; # MariaDB 계정 패스워드
    $dbname = 'MY_DATABASE';  # DATABASE 이름


    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8');
    
    try {

        $con = new PDO("mysql:host={$host};dbname={$dbname};charset=utf8",$username, $password);
    }  
    
    
    catch(PDOException $e) {

	    die("Failed to connect to the database: " . $e->getMessage());
	   echo "접속실패"; 
    }


    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);


if (isset($_SERVER['HTTP_REFERER'])) {
    $ref_url = $_SERVER['HTTP_REFERER'];
} else {
    $ref_url = '';
}

if (strpos($ref_url, $_SERVER['SERVER_NAME']) === false) {
    function stripslashes_deep($value) {
        $value = is_array($value) ?
            array_map('stripslashes_deep', $value) :
            stripslashes($value);

        return $value;
    }

    $_POST = array_map('stripslashes_deep', $_POST);
    $_GET = array_map('stripslashes_deep', $_GET);
    $_COOKIE = array_map('stripslashes_deep', $_COOKIE);
}

header('Content-Type: text/html; charset=utf-8');
#session_start();
?>
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');
    echo json_encode($_POST);
}

?>
