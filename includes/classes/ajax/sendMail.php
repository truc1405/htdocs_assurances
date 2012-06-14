<?php

if(isset($_REQUEST['action']) && $_REQUEST['action'] == 'sendMail'){
	define('RACINE', '../../../');
	require_once (RACINE.'config/config.php');

	if(	isset($_REQUEST) &&
		isset($_REQUEST['message']) &&
		isset($_REQUEST['subject']) &&
		isset($_REQUEST['email'])
		){
		
		if(isset($_REQUEST['firstname'])) $firstname=$_REQUEST['firstname'];
		else $firstname = '';
		
		if(isset($_REQUEST['name'])) $name=$_REQUEST['name'];
		else $name = '';
		
		$mailer = new myMailer();
		$mailer->Subject = $_REQUEST['subject'];
		$mailer->Body = $_REQUEST['message'];
		$mailer->AddAddress('sam.baptista@gmail.com', 'Studio Photo');
		$mailer->AddReplyTo($_REQUEST['email'], $firstname ." ".$name);
	
		if(!$mailer->Send()){ 
			echo json_encode(array(
				'erreur' => $mailer->ErrorInfo,
				'message' => "Un problème est survenu ! Vous pouvez nous contacter directement à contact@studio-photo.ch.")); 
		}
		else  echo json_encode(array('message'=>"L'email a été envoyé avec succès !"));
	
		$mailer->ClearAddresses();
		$mailer->ClearAttachments();
	}else{
		
	}
	
}

?>