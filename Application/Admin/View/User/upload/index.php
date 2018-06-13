<?php
/*
 * jQuery File Upload Plugin PHP Example
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */

error_reporting(E_ALL | E_STRICT);
require('UploadHandler.php');

$save_path = dirname(dirname(__FILE__)) . '/files/';
$upload_url = "http://localhost/tfamily/Application/Admin/View/User/files/";

$options = array(
	'upload_dir' => $save_path,
	'upload_url' => $upload_url,
	'image_versions' => array(
			'thumbnail' => array(
				'max_width' =>100,
				'max_height' =>100
			)
	)
);

$upload_handler = new UploadHandler($options);

