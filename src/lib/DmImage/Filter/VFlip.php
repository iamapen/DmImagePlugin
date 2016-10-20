<?php
namespace Iamapen\DmImagePlugin\DmImage\Filter;

/**
 * 垂直反転フィルタ
 * @uses demouth/dmimage dev-master#cf14053c5a57fc001eb124802f0e824bf0f19803
 */
class VFlip extends \Dm_Image_Filter_Abstract
{

    /**
     * @param \Dm_Image $image
     * @return resource
     */
    public function execute(\Dm_Image $image)
    {
        $w = $image->getWidth();
        $h = $image->getHeight();

        $dstResource = @imagecreatetruecolor($w, $h);
        $srcResource = $image->getImageResource();

        // 逆側から色を取得
        for ($i=0; $i<$w; $i++) {
            for ($j=($h-1); $j>=0; $j--) {
                $colorIndex = imagecolorat($srcResource, $i, $j);
                $colors = imagecolorsforindex($srcResource, $colorIndex);
                imagesetpixel(
                    $dstResource,
                    $i,
                    abs($j-$h+1),
                    imagecolorallocate($dstResource, $colors['red'], $colors['green'], $colors['blue'])
                );
            }
        }
        return $dstResource;
    }
}
