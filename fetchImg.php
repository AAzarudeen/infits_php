<?php

$imageName = "IMG_20210206_162645";
$image = 'upload/';
$type = pathinfo($image, PATHINFO_EXTENSION);
$data = file_get_contents($image);

$dataUri = [];

$dataUri["Azar"] = base64_encode($data);

echo json_encode($dataUri);


?>