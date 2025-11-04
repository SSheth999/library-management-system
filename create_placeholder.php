<?php
// Simple script to create a placeholder image
// Run this with: php create_placeholder.php

$width = 200;
$height = 300;

// Create image
$image = imagecreatetruecolor($width, $height);

// Define colors
$bgColor = imagecolorallocate($image, 233, 236, 239); // #e9ecef
$borderColor = imagecolorallocate($image, 173, 181, 189); // #adb5bd
$textColor = imagecolorallocate($image, 108, 117, 125); // #6c757d

// Fill background
imagefill($image, 0, 0, $bgColor);

// Draw border
imagerectangle($image, 10, 10, $width - 11, $height - 11, $borderColor);
imagerectangle($image, 11, 11, $width - 12, $height - 12, $borderColor);

// Draw text
$font = 5; // Built-in font
$text = "No Cover";
$textX = ($width - imagefontwidth($font) * strlen($text)) / 2;
$textY = ($height - imagefontheight($font)) / 2;
imagestring($image, $font, $textX, $textY, $text, $textColor);

// Save image
imagepng($image, 'public/assets/images/placeholder.png');
imagedestroy($image);

echo "Placeholder image created successfully!\n";

