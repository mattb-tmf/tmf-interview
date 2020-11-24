<?php
class Stock{
	
	public $longSymbol;
	public $shortSymbol;
	public $companyInfo;
	private $cacheDir;
	private $apiUrl;


	function __construct($symbol){

		$this->longSymbol 	= strtoupper($symbol);
		$this->shortSymbol = $this->getShortSymbol();
		$this->cacheDir 	= $this->getCacheDir();
		$this->apiUrl 		= "https://financialmodelingprep.com/api/v3/profile/".$this->shortSymbol."?apikey=4b0f42d24281561ce8dc8f4e2ec69fc3";
		
		$this->setCompanyInfo();
	
	}

	public function getShortSymbol($symbol = null){
		if($symbol == null){ $symbol = $this->longSymbol; }

		$sArr = explode(":", $symbol); 
		
		//use position 1 unless someone sends a short symbol, then pass back position 0
		if(sizeof($sArr) != 2){
			return $sArr[0];
		} return $sArr[1];

	}

	private function setCompanyInfo(){
		$expires	= 900; // 15min
		$CACHE_FILE	= $this->cacheDir . $this->shortSymbol . ".txt";

		if(file_exists($CACHE_FILE) && !$this->isCacheExpired($CACHE_FILE, $expires)){
			$this->companyInfo = json_decode(file_get_contents($CACHE_FILE));
		}
		else{
			$this->companyInfo = json_decode(file_get_contents($this->apiUrl));
			if(!empty($this->companyInfo)){
				$this->createCache($CACHE_FILE, json_encode($this->companyInfo));
			}
		}
	}

	//Check if a cache file has expired
	private function isCacheExpired($f, $e){
		$expired = false;

		if((filectime($f) + $e) < time()) {
		  //cache is invalid: recreate it
			$expired = true;
		} 

		return $expired;
	}

	//Creates a cache file
	private function createCache($f, $c){
		if($file = fopen($f,'w')){
			fwrite($file, $c);
			fclose($file);

			return true;
		}
		else return false;
	}

	private function getCacheDir(){
		$uploads = wp_get_upload_dir();

		return $uploads['basedir'].'/companyinfo/';
	}

	public function getColorClass(float $amt){
		if($amt < 0){ return ' class="text-danger"'; }
		if($amt > 0){ return ' class="text-success"'; }
	}

	public function formatRange($range){
		$parts = explode("-", $range);

		return '$'.number_format($parts[0],2).' - $'.number_format($parts[1],2);
	}

	public function formatDividend(float $num){
		if(!$num){ return "N/A"; }

		return "$".number_format($num,2);
	}

	public function getPercentage(float $change, float $price){
		return round($change / (($price - $change) / 100),2);
	}
}