<?php

function shareCount($url, $site)
{

	function getJson($url){
		$shareCountData = file_get_contents($url);
		$result = json_decode($shareCountData);
		return $result;
	}

	if($site == 'facebook'){
		$result = getJson('http://graph.facebook.com/?id='.$url);
		return intval($result->shares);
	}

	if($site == 'twitter'){
		$result = getJson('http://cdn.api.twitter.com/1/urls/count.json?url='.$url);
		return intval($result->count);
	}

	if($site == 'linkedin'){
		$result = getJson('http://www.linkedin.com/countserv/count/share?url='.$url.'&format=json');
		return intval($result->count);
	}
	
	if($site == 'pinterest'){
		$result = file_get_contents('http://api.pinterest.com/v1/urls/count.json?url='.$url);
		$result = json_decode(preg_replace('/^receiveCount\((.*)\)$/', "\\1", $result));
		return intval($result->count);
	}

	if($site == 'googleplus'){
		$curl = curl_init();
        curl_setopt( $curl, CURLOPT_URL, "https://clients6.google.com/rpc" );
        curl_setopt( $curl, CURLOPT_POST, 1 );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, '[{"method":"pos.plusones.get","id":"p","params":{"nolog":true,"id":"' . $url . '","source":"widget","userId":"@viewer","groupId":"@self"},"jsonrpc":"2.0","key":"p","apiVersion":"v1"}]' );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-type: application/json' ) );
        $result = curl_exec( $curl );
        curl_close( $curl );
        $json = json_decode( $result, true );

        return intval( $json[0]['result']['metadata']['globalCounts']['count'] );
	}

	if($site == 'stumbleupon'){
		$result = getJson('http://www.stumbleupon.com/services/1.01/badge.getinfo?url='.$url);
		return $result->result->views;
	}

	return "invalid request";
}

?>