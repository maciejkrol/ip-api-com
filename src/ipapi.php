<?php 

namespace maciejkrol\ipapicom;

/**
 * Represents all what is known about the ad viewer and its viewing context.
 * Data is represented as nestes array.
 */
class ipapi {
    
    private $key = null;

    /**
     * Creates new instance of the ipapi class initialized with the
     * provided API key.
     * @param string $_key 
     */ 
    public function __construct ($_key) {
        $this->key = $_key;
    }
    
    /**
     * Returs localization data for the specified IP or null
     * if there was a problem.
     * @param string $_ip
     * @return array|null
     */    
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
    
    /**
     * Builds and API request url.
     * @param string $_ipAddress
     * @return string
     */
    private function buildURL ($_ipAddress) {
        
        $url = 'https://pro.ip-api.com/'
            .'json/'
            .$_ipAddress
            .'?key='.$this->key;
            
        return $url;
    }
}


				