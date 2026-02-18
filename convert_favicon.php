<?php

$source = __DIR__ . '/public/favicon.svg';
$tempPng = __DIR__ . '/public/favicon_temp.png';
$destination = __DIR__ . '/public/favicon.ico';

if (!file_exists($source)) {
  echo "Error: Source file not found at $source\n";
  exit(1);
}

if (!extension_loaded('imagick')) {
  echo "Error: Imagick extension not loaded\n";
  exit(1);
}

// 1. Convert SVG to high-res PNG using sharp-cli (preserves gradients/colors)
echo "Converting SVG to PNG using sharp-cli...\n";
// sharp-cli syntax: sharp -i input -o output [operations...]
$command = "npx -y sharp-cli -i " . escapeshellarg($source) . " -o " . escapeshellarg($tempPng) . " resize 512 512";
exec($command, $output, $returnCode);

if ($returnCode !== 0 || !file_exists($tempPng)) {
  echo "Error: Failed to convert SVG to PNG using sharp-cli.\n";
  if (!empty($output)) {
    echo implode("\n", $output) . "\n";
  }
  exit(1);
}

try {
  $sizes = [16, 32, 48, 64];
  $icon = new Imagick();
  $icon->setFormat('ico');

  // 2. Read the high-quality PNG
  $pngContent = file_get_contents($tempPng);

  foreach ($sizes as $size) {
    $image = new Imagick();
    $image->setBackgroundColor(new ImagickPixel('transparent'));

    $image->readImageBlob($pngContent);

    // Resize using Lanczos for high quality downscaling
    $image->resizeImage($size, $size, Imagick::FILTER_LANCZOS, 1);

    $icon->addImage($image);
    $image->clear();
  }

  $icon->writeImages($destination, true);
  $icon->clear();

  echo "Successfully converted $source to $destination using sharp-cli -> Imagick.\n";

  // 3. Cleanup
  unlink($tempPng);

} catch (Exception $e) {
  echo "Error: " . $e->getMessage() . "\n";
  if (file_exists($tempPng)) {
    unlink($tempPng);
  }
  exit(1);
}
