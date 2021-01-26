<?php

namespace App\Helpers;

/** 
 *  @method static getMacAddress(string $ip) will return array contains ip and mac address optmized for db insertion
*/
class Network
{
    /**
     * will return array contains ip and mac address optimized for db insertion
     * @param string $ip
     * @return array
     */
    public static function getMacAddress(string $ip){
      
        $macAddr=false;
        #run the external command, break output into lines
        $arp=`arp -a $ip`;
        $lines=explode("\n", $arp);

        #look for the output line describing our IP address
        foreach($lines as $line)
        {
            $cols=preg_split('/\s+/', trim($line));
            if ($cols[0]==$ip)
            {
                $macAddr=$cols[1];
            }
        }
        return ['ip'=>$ip, 'mac_address'=>$macAddr ];
    }
}
