<?php
	$email = 'YOUR EMAIL'; 
    $api_key = 'API KEY FROM INSTAMOJO';
    $api_secret = 'API SECRET FORM INSTAMOJO';
    $api_salt = 'API SALT FFROM INSTAMOJO';
	$webhook_url = 'https://intern.epizy.com/mojo/webhook.php';
	$redirect_url = 'https://intern.epizy.com/mojo/thanks.php';
    $mode = "test"; 
    if($mode == 'live'){
        $mode = 'www';
    }else{
        $mode = 'test';
    }
    
?>