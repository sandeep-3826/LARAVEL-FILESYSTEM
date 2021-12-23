<?php

namespace App\Traits;

trait RandomStringTrait {

	public function generateRandomString(int $length) {

		$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool , $length)),0,$length);

	}

	public function generateRandomNumber(int $length) {

		$pool = '0123456789';
        return substr(str_shuffle(str_repeat($pool , $length)),0,$length);
        
	}
	
}
