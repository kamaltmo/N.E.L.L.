<?php

require_once('lib/nusoap.php'); 
$server = new nusoap_server;
 
$server->configureWSDL('server', 'urn:server');
 
$server->wsdl->schemaTargetNamespace = 'urn:server';

$server->wsdl->addComplexType(
 'ListArray',
 'complexType',
 'array',
 '',
 'SOAP-ENC:Array',
  array(),
  array(
    array('ref'=>'SOAP-ENC:arrayType','wsdl:arrayType'=>'xsd:string[]')
  ),
  'xsd:string'
);

//SOAP complex type return type (an array/struct)
$server->wsdl->addComplexType(
    'Person',
    'complexType',
    'struct',
    'all',
    '',
    array(
        'lecturer_id' => array('name' => 'lecturer_id', 'type' => 'xsd:string'),
        'username' => array('name' => 'username', 'type' => 'xsd:string'),
        'first_name' => array('name' => 'first_name', 'type' => 'xsd:string'),
        'last_name' => array('name' => 'last_name', 'type' => 'xsd:string')
    )
);
 
//Check user info against server 
$server->register('login',
      array('username' => 'xsd:string', 'password'=>'xsd:string'),  //parameters
      array('return' => 'tns:Person'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Check user login');  //description
 

$server->register('get_modules',
      array('Id' => 'xsd:string'),  //parameters
      array('return' => 'tns:ListArray'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'get user modules');  //description

$server->register('get_questions',
      array('modId' => 'xsd:string'),  //parameters
      array('return' => 'tns:ListArray'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'get module questions');  //description

$server->register('get_glossory',
      array('modId' => 'xsd:string'),  //parameters
      array('return' => 'tns:ListArray'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'get module glossory');  //description

$server->register('activate_question',
      array('modId' => 'xsd:string', 'queId'=>'xsd:string'),  //parameters
      array('return' => 'xsd:string'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Activate a question');  //description

$server->register('activate_term',
      array('modId' => 'xsd:string', 'termId'=>'xsd:string'),  //parameters
      array('return' => 'xsd:string'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Activate a term');  //description

$server->register('deactivate_question',
      array('modId' => 'xsd:string', 'queId'=>'xsd:string'),  //parameters
      array('return' => 'xsd:string'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Deactivate a question');  //description

$server->register('deactivate_term',
      array('modId' => 'xsd:string', 'termId'=>'xsd:string'),  //parameters
      array('return' => 'xsd:string'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Deactivate a term');  //description

$server->register('deactivate_all',
      array('modId' => 'xsd:string'),  //parameters
      array('return' => 'xsd:string'),  //output
      'urn:server',   //namespace
      'urn:server#loginServer',  //soapaction
      'rpc', // style
      'encoded', // use
      'Deactivate all');  //description
 
//Check user info against server 
function login($uName, $pWord) {
  include 'database_info.php';
      $id = ""; 
        $uname = ""; 
        $fname = "";
        $lname = "";


      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        

        $sql = "SELECT * FROM lecturers WHERE username= '$uName' AND password = '$pWord'";
    
        //fill the output into something we can use.
          $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        
        //while i can still get data back         
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
                  $id = $row['lecturer_id']; 
                  $uname = $row['username']; 
                  $fname = $row['first_name']; 
                  $lname = $row['last_name'];
        }
        return array(
    'lecturer_id'=> $id,
    'username'=> $uname,
    'first_name'=> $fname,
    'last_name'=> $lname
  );
}

//Get the lecture module info
function get_modules($Id) {
include 'database_info.php';
    

      $mReturn[0] = "";


      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        

        $sql = "SELECT * FROM modules WHERE lecturer_id = '$Id'";
        

        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        $num_rows = mysql_num_rows($result);
        $rCounter = 0;

        //while i can still get data back         
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
          $mReturn[$rCounter] =  $row["mod_code"];
          $rCounter = $rCounter+1;
        }

    return $mReturn;
}

function get_glossory($modId) {
include 'database_info.php';
    

      $mReturn[0] = "";


      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        

        $sql = "SELECT term_id, term FROM ".$modId."_glossary";
        

        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        $num_rows = mysql_num_rows($result);
        $rCounter = 0;

        //while i can still get data back         
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
          $mReturn[$rCounter] =  $row["term_id"]." - ".$row["term"];
          $rCounter = $rCounter+1;
        }

    return $mReturn;
}

function get_questions($modId) {
include 'database_info.php';
    

      $mReturn[0] = "";


      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        

        $sql = "SELECT question_id, question FROM ".$modId."_multi_questions";
        

        $result = mysql_query($sql) or die('Query failed: ' . mysql_error());
        $num_rows = mysql_num_rows($result);
        $rCounter = 0;

        //while i can still get data back         
        while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) 
        {
          $mReturn[$rCounter] =  $row["question_id"]." - ".$row["question"];
          $rCounter = $rCounter+1;
        }

    return $mReturn;
}

function activate_question($modId, $queId) {
include 'database_info.php';
    

      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        
        
        $sql = "UPDATE ".$modId."_multi_questions SET status='1' WHERE question_id='$queId'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());

}

function activate_term($modId, $termId) {
include 'database_info.php';
    

      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        
        
        $sql = "UPDATE ".$modId."_glossary SET status='1' WHERE term_id='$termId'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());

}

function deactivate_question($modId, $queId) {
include 'database_info.php';
    

      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        
        
        $sql = "UPDATE ".$modId."_multi_questions SET status='0' WHERE question_id='$queId'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());

}

function deactivate_term($modId, $termId) {
include 'database_info.php';
    

      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        
        
        $sql = "UPDATE ".$modId."_glossary SET status='0' WHERE term_id='$termId'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());

}

function deactivate_all($modId) {
include 'database_info.php';
    

      $conn = mysql_connect($servername, $username, $password)
        or die('Could not connect: ' . mysql_error());
        
        mysql_select_db($dbname) or die('Could not select database');        
        
        $sql = "UPDATE ".$modId."_glossary SET status='0'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());

        $sql = "UPDATE ".$modId."_multi_questions SET status='0'";
        mysql_query($sql) or die('Query failed: ' . mysql_error());
}
 
$HTTP_RAW_POST_DATA = isset($HTTP_RAW_POST_DATA) ? $HTTP_RAW_POST_DATA : '';
 
$server->service($HTTP_RAW_POST_DATA);
?>