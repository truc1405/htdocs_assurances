<?php

class Log{
	
	private $activated;
	private $flushActivated;
	private $printActivated;
	private $selectActivated;
	private $exceptionColor = 'blue';
	private $initColor = "red";
	private $initSymbol = ">>";
	private $color = "white";
	private $showTime = false;
	private $time;
	
	public function __construct(){
		ob_start();
		$this->time = microtime(true);
	}
	
	private function t(){
		$time = microtime(true)-$this->time;
		return round($time,3)."\t::\t";
	}
	
	
	// fonction print_r(...)
	public function p($obj, $pre=false, $exception = false){
		if($this->activated && $this->printActivated){
			if($pre){
				$preStart = '<pre>';
				$preEnd = '</pre>';			
			}else{
				$preStart = '';
				$preEnd = '';
			}
			$exception ? $textColor = $this->exceptionColor : $textColor = $this->color;
			
			echo "<div style='font-family:Courrier New;color:".$textColor.";text-align:left'> ".$preStart."<span style='color:".$this->initColor."'>".$this->initSymbol."</span> ";
			if($this->showTime ) echo $this->t() ;
			
			// imprime le corps
			if($pre) print_r($obj);
			else echo $obj;
			
			echo $preEnd."</div>";
		}
	}

	// fonction <pre>print_r(...)</pre>
	public function pr($obj){
		if($this->activated && $this->printActivated){
			$this->p($obj, true);
		}
	}
	
	// fonction print une exception. 
	// Particularité : attribue une couleur particulière à cette ligne
	//<pre>print_r(...)</pre>
	public function pre($obj){
		if($this->activated && $this->printActivated){
			$this->p($obj, true, true);
		}
	}

	// fonction flush
	public function f($chaine){
		if($this->activated && $this->flushActivated){
			$this->p($chaine);
			ob_flush();
			flush();
		}
	}
	
	// fonction flush
	public function fr($chaine){
		if($this->activated && $this->flushActivated){
			$this->pr($chaine);
			ob_flush();
			flush();
		}
	}
	
	// fonction r pour "request"
	public function r($chaine){
		if($this->activated && $this->selectActivated){
			$this->p($chaine);
			ob_flush();
			flush();
		}
	}
	
	
	public function setActivated($bool=true){
		if(is_bool($bool)){
			$this->activated = $bool;
		}
	}
	
	public function setFlushActivated($bool){
		if(is_bool($bool)){
			$this->flushActivated = $bool;
		}
	}
	
	public function setPrintActivated($bool){
		if(is_bool($bool)){
			$this->printActivated = $bool;
		}
	}
	
	public function setSelectActivated($bool){
		if(is_bool($bool)){
			$this->selectActivated = $bool;
		}
	}
	
	public function setColor($color){
		$this->color = $color;
	}
	
	public function setShowTime($bool){
		if(is_bool($bool)){
			$this->setShowTime = $bool;
		}
	}



	
}
?>