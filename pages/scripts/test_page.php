<?php
class test_page extends Page{
	
	
	public function customize(){
		global $smarty;
		
		global $config_mail;
		$config_mail = array(
						'auth' => 'login',
		                'username' => "info@credit-conseil.ch",
		                'password' => cc2011,
						//'ssl' => SMTP_SECURE,
						//'port' => SMTP_PORT
					);

		
		$this->external_template = EXTERNAL_AVEC_SOUSMENU;
		$this->layout = LAYOUT_DEUX_COLONNES;

		// envoi client
		$transport = new Zend_Mail_Transport_Smtp('mail.infomaniak.ch', $config_mail);
		$mail = new Zend_Mail('utf-8');
		$mail->setSubject('test envoi de mail sujet 3');
		$mail->setBodyHtml('test envoi de mail');
		$mail->setFrom('info@credit-conseil.ch');
		$mail->addTo('sam.baptista@net-lead.ch', 'Samuel Baptista');
		$mail->send($transport);

		return 'envoyé';
		
	}
		
		
		
	
	
}
?>