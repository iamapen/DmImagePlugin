<?php
require __DIR__ .'/../../vendor/autoload.php';

$tmpDir = realpath(__DIR__.'/tmp');
$fixtureDir = realpath(__DIR__.'/fixtures/exifOrientation');

$sampleImages = array(
    'up.jpg', 'up-mirrored.jpg',
    'down.jpg', 'down-mirrored.jpg',
    'left.jpg', 'left-mirrored.jpg',
    'right.jpg', 'right-mirrored.jpg',
);

foreach($sampleImages as $f) {
    $dest = sprintf('%s/%s', $tmpDir, $f);
    if(is_file($dest)) {
        unlink($dest);
    }
}

foreach($sampleImages as $f) {
    $src = sprintf('%s/%s', $fixtureDir, $f);
    $dest = sprintf('%s/%s', $tmpDir, $f);

    echo sprintf("creating %s\n", $dest);

    $exif = exif_read_data($src);
    $filters = \Iamapen\DmImagePlugin\DmImage\Filter\FactoryExif::createFilters($exif['Orientation']);

    $image = new \Dm_Image_File($src);
    $image->applyFilters($filters)->saveTo($dest, 'jpg', 90);

    echo sprintf("done %s\n", $dest);
}

echo "finished!\n";
echo sprintf("check directory %s \n", $tmpDir);
