<?php 
    // I use combine php-securit function. 
    function security($password){
        $key = pack('H*', "bcb04b7e103a0cd8b54763051cef08bc55abe029fdebae5e1d417e2ffb2a00a3");
        $key_size =  strlen($key);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,
                                 $password, MCRYPT_MODE_CBC, $iv);
        $pwd = md5($ciphertext);//password_bcrypt is powerful secure method. Laravel 7.0 framework use this methods.
        return $pwd;
    }
?>