<?php
session_start();
include("connection.php");


/// for get ip  add and otherss////

$host_name =  gethostbyaddr($_SERVER['REMOTE_ADDR']);
ob_start(); // Turn on output buffering
system('ipconfig /all'); //Execute external program to display output
$mycom=ob_get_contents(); // Capture the output into a variable
ob_clean(); // Clean (erase) the output buffer

$findme = "Physical";
$pmac = strpos($mycom, $findme); // Find the position of Physical text
$mac=substr($mycom,($pmac+36),17); // Get Physical Address

$local_ip = get_client_ip();

$con = connect();
 putenv("TZ=Asia/Dacca");
 //$date = date('Y/m/d H:i:s');
  $pc_date=date('Y-m-d'); 
 
  $pc_time=date('H:i:s a');


/////////------ ------///////////


/**
 * Created by Joe of ExchangeCore.com
 */
if(isset($_POST['username']) && isset($_POST['password']))
{

   // $adServer = "ldap://domaincontroller.mydomain.com";
	$adServer = "192.168.1.2";
	
    $ldap = ldap_connect($adServer);
    $username = $_POST['username'];
    $password = $_POST['password'];

    $ldaprdn = 'pbl' . "\\" . $username;

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);


    if ($bind) {
        $filter="(sAMAccountName=$username)";
        $result = ldap_search($ldap,"dc=pbl,dc=COM",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
            if($info['count'] > 1)
                break;
           // echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
           // echo '<pre>';
           // var_dump($info);
          //  echo '</pre>';
            $userDn = $info[$i]["distinguishedname"][0]; 

            $_SESSION['fullname']=$info[$i]["givenname"][0] ." " . $info[$i]["sn"][0];
            $_SESSION['username']=$info[$i]["samaccountname"][0];
        }
        @ldap_close($ldap);

       /// echo "<br /> ".$_SESSION['fullname'];
       // echo "<br /> ".$_SESSION['username'];

      ///----- login history entry -----
        $insert = "insert into login_history_db (id,username,lan_ip, lan_mac, wan_ip, login_time, login_date,login_status) 
                                values('".$id."','".$_SESSION['username']."','".trim($local_ip)."','".$mac."','".$host_name."','".$pc_time."','".$pc_date."','1')";
                                
        $insertresults = mysql_query($insert) or die(mysql_error());
        $_SESSION["insert_id"]=mysql_insert_id();   

        header('location:menu.php');  
        exit();



    } else {
        $msg = "Invalid email address / password";
        echo $msg;
    }

}  
else
    {  
        echo "Some error happend!!!!!";
    } 



function get_client_ip() {
     $ipaddress = '';
     if ($_SERVER['HTTP_CLIENT_IP'])
         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
     else if($_SERVER['HTTP_X_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
     else if($_SERVER['HTTP_X_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
     else if($_SERVER['HTTP_FORWARDED_FOR'])
         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
     else if($_SERVER['HTTP_FORWARDED'])
         $ipaddress = $_SERVER['HTTP_FORWARDED'];
     else if($_SERVER['REMOTE_ADDR'])
         $ipaddress = $_SERVER['REMOTE_ADDR'];
     else
         $ipaddress = 'UNKNOWN';

     return $ipaddress; 
}

?> 