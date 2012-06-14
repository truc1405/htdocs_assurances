<?php

class myMailer extends PHPMailer
{
    public $priority = 3;
    public $to_name;
    public $to_email;
    public $From = null;
    public $FromName = null;
    public $Sender = null;

    function __construct()
    {
        global $site;

        // Comes from config.php $site array		
        if($site['smtp_mode'] == 'enabled')
        {
			$this->IsSMTP();
            $this->Host = $site['smtp_host'];
            $this->Port = $site['smtp_port'];
            if($site['smtp_username'] != '')
            {
                $this->SMTPAuth = true;
				$this->SMTPSecure = $site['smtp_secure'];
                $this->Username = $site['smtp_username'];
                $this->Password = $site['smtp_password'];
            }
            $this->Mailer = "smtp";
        }
        if(!$this->From)
        {
            $this->From = $site['from_email'];
        }
        if(!$this->FromName)
        {
            $this->FromName = $site['from_name'];
        }
        if(!$this->Sender)
        {
            $this->Sender = $site['from_email'];
        }
        $this->Priority = $this->priority;
		
    }


}
?>
