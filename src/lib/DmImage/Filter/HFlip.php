<?php
namespace Iamapen\DmImagePlugin\DmImage\Filter;

/**
 * 水平反転フィルタ
 * @uses demouth/dmimage dev-master#cf14053c5a57fc001eb124802f0e824bf0f19803
 */
class HFlip extends \Dm_Image_Filter_Abstract
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
        for ($i=($w-1); $i>=0; $i--) {
            for ($j=0; $j<$h; $j++) {
                $colorIndex = imagecolorat($srcResource, $i, $j);
                $colors = imagecolorsforindex($srcResource, $colorIndex);
                imagesetpixel(
                    $dstResource,
                    abs($i-$w+1),
                    $j,
                    imagecolorallocate($dstResource, $colors['red'], $colors['green'], $colors['blue'])
                );
            }
        }
        return $dstResource;
    }
}
