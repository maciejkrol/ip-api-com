<?php 

namespace maciejkrol\ipapicom;

class ipapi {
    
    private $key = null;

    public function __construct ($_key) {
        $this->key = $_key;
    }
    
    public function locate ($_ipAddress, $_raw = false) {
                
        $url = $this->buildURL($_ipAddress); 
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
	    
        $data = curl_exec($curl);
        curl_close($curl);
        
        if ($_raw) {
            return $data;
        }
        
        $result = json_decode ($data, true);
        
        if ($result === null || !isset($result['status'])) {
            return null;
        }
        
        if ($result['status'] === 'fail') {
            return null;
        }
        
        unset ($result['status']);
        return $result;
    }
    
    private function buildURL ($_ipAddress) {
        
        $url = 'https://pro.ip-api.com/'
            .'json/'
            .$_ipAddress
            .'?key='.$this->key;
            
        return $url;
    }
}


				