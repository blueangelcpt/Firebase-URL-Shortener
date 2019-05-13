<?php
class FirebaseURLAPI { 

	public function generateShortURL($url) {
		$key = Configure::read('FirebaseURLAPIServerKey');
		$curlObj = curl_init();
		$jsonData = json_encode(array(
			'longDynamicLink' => 'https://paytoday.page.link/?link=' . $url,
			'suffix' => array('option' => 'SHORT')
		));
		curl_setopt($curlObj, CURLOPT_URL, 'https://firebasedynamiclinks.googleapis.com/v1/shortLinks?key='.$key);
		curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($curlObj, CURLOPT_HEADER, 0);
		curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));
		curl_setopt($curlObj, CURLOPT_POST, 1);
		curl_setopt($curlObj, CURLOPT_POSTFIELDS, $jsonData);
		$response = curl_exec($curlObj);
		$json = json_decode($response);
		curl_close($curlObj);
		return $json;
	}
}