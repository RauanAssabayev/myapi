<?php

// if($_SERVER['HTTP_API_KEY'] == md5('mysduapistatic')){
// 	header('WWW-Authenticate: Basic realm="API MySDU"'); 
// 	header('HTTP/1.0 401 Unauthorized'); 
// 	echo 'API Key incorrect'; 
// 	exit()
// }


// function isMobile() {
//     return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
// }
// if(isMobile()){
// 	header('WWW-Authenticate: Basic realm="API MySDU"'); 
// 	header('HTTP/1.0 401 Unauthorized'); 
// 	echo 'Device incorrect'; 
// 	exit()
// }


use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
require '../src/config/db.php';


$app = new \Slim\App([
    'settings' => [
        'displayErrorDetails' => true
    ]
]);


// if($_SERVER['HTTP_PHP_AUTH_PW'] != $pass || $_SERVER['HTTP_PHP_AUTH_USER'] != $login){ 
//     header('WWW-Authenticate: Basic realm="Test auth"'); 
//     header('HTTP/1.0 401 Unauthorized'); 
//     echo 'Auth failed'; 
//     exit;
// }


$auth = false;
$db = new db();
if($db->doLogin(130107035) === md5(123456)){
	$auth = true;
}	

if($auth){
	//API BODY

	$app->get('/students/{sdu_id}', function (Request $request, Response $response){
		 $id = $request->getAttribute('sdu_id');
		 $sql = "select * from student where sdu_id = ".$id;
		 try{
		 	//Get DB Object;
		 	$db = new db();
		 	//Connect
		 	$db = $db->connect(); 
		 	$stmt = $db->query($sql);
		 	$student = $stmt->fetchAll(PDO::FETCH_OBJ);
		 	$db = null;
		 	echo json_encode($student);
		  }catch(PDOException $e){
		 	echo '{"error":{"text": '.$e->getMessage().'}';
		  }
	});

	$app->get('/grades/{faculty}/{course}/{semestr}/{sdu_id}', function (Request $request, Response $response){
		 $id = $request->getAttribute('sdu_id');
		 $sql = "select * from grades where sdu_id = ".$id;
		 try{
		 	//Get DB Object;
		 	$db = new db();
		 	//Connect
		 	$db = $db->connect(); 
		 	$stmt = $db->query($sql);
		 	$student = $stmt->fetchAll(PDO::FETCH_OBJ);
		 	$db = null;
		 	echo json_encode($student);
		  }catch(PDOException $e){
		 	echo '{"error":{"text": '.$e->getMessage().'}';
		  }
	});

	$app->get('/messages/{course}/{semestr}/{sdu_id}', function (Request $request, Response $response){
		 $id = $request->getAttribute('sdu_id');
		 $sql = "select * from grades where sdu_id = ".$id;
		 try{
		 	//Get DB Object;
		 	$db = new db();
		 	//Connect
		 	$db = $db->connect(); 
		 	$stmt = $db->query($sql);
		 	$student = $stmt->fetchAll(PDO::FETCH_OBJ);
		 	$db = null;
		 	echo json_encode($student);
		  }catch(PDOException $e){
		 	echo '{"error":{"text": '.$e->getMessage().'}';
		  }
	});

	$app->run();
}