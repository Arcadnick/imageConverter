<?php
include "ImageConverter.php";

$imageConverter = new ImageConverter();
$newHTML = $imageConverter->convertImagesToPlaceholder('index.html');

file_put_contents('out.html', $newHTML);