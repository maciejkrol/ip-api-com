<?php 

namespace maciejkrol\ipapicom;

class ipapi {
    
    private $key = null;

    public function __construct ($_key) {
        $this->key = $_key;
    }
    
    public function locate ($ipAddress) {
                
        $url = $this->buildURL($ipAddress); 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
	    
        $data = curl_exec($curl);
        curl_close($curl);
        
        return json_decode ($data, true);   
    }
    
    private $format = 'json';

    public function format ($_value = null) {
        if ($_value === null) {
            return $this->format;
        } else {
            $this->format = $_value;
            return $this;
        }
    }
    
    private function buildURL ($_ipAddress) {
        
        $url = 'https://pro.ip-api.com/'
            .$this->format ().'/'
            .$_ipAddress
            .'?key='.$this->key;
            
        return $url;
    }
}


				