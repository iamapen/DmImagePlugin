<?php
namespace Iamapen\DmImagePlugin\DmImage\Filter;

/**
 * 水平反転フィルタ
 *
 * PHP < 5.5 環境ではパフォーマンスが落ちる
 * @uses demouth/dmimage dev-master#cf14053c5a57fc001eb124802f0e824bf0f19803
 * @uses gd
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

        $srcResource = $image->getImageResource();

        if(PHP_VERSION_ID >= 50500) {
            imageflip($srcResource, IMG_FLIP_HORIZONTAL);
            $dstResource = $srcResource;
        } else {
            $dstResource = $this->hFlipLegacy($srcResource, $w, $h);
        }

        return $dstResource;
    }

    /**
     * 水平反転のPHP実装。PHP < 5.5 用。
     *
     * imageflip() に比べるとパフォーマンスに大きく劣る。
     * @param resource $srcResource
     * @param int $w
     * @param int $h
     * @return resource
     */
    private function hFlipLegacy($srcResource, $w, $h) {
        $dstResource = @imagecreatetruecolor($w, $h);

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
