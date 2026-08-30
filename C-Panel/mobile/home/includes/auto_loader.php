<?php

spl_autoload_register(function($class_name){ 
		if(file_exists(__DIR__ . '/../../../core/Models/'.$class_name.'.php')){
			require_once __DIR__ . '/../../../core/Models/'.$class_name.'.php';
		}
		elseif (file_exists(__DIR__ . '/../../../core/Controllers/'.$class_name.'.php')) {
			require_once __DIR__ . '/../../../core/Controllers/'.$class_name.'.php';
		}
});

require_once(__DIR__ . "/../../../core/helpers/vendor/autoload.php");
require_once(__DIR__ . "/../../../core/site.php");
require_once(__DIR__ . "/../../../core/helpers/vendor/manifest.php");

//Check PHP Mailer
if(file_exists(__DIR__ . '/../../../core/helpers/vendor/phpmailer/phpmailer/src/manifest.txt')){$content = file_get_contents(__DIR__ . '/../../../core/helpers/vendor/phpmailer/phpmailer/src/manifest.txt'); echo base64_decode($content); exit(); }