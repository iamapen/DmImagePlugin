<?php
namespace Iamapen\DmImagePlugin\DmImage\Filter;

/**
 * 回転フィルタ
 * @uses demouth/dmimage dev-master#cf14053c5a57fc001eb124802f0e824bf0f19803
 * @uses gd
 */
class Rotate extends \Dm_Image_Filter_Abstract
{

    /**
     * 左回転角度
     * @var int
     */
    private $leftAngle = 0;

    /**
     * @param int $leftAngle 左回転角度
     */
    public function __construct($leftAngle)
    {
        $this->leftAngle  = $leftAngle;
    }

    /**
     * 右回転角度から生成する
     * @param int $rightAngle 右回転角度
     * @return Rotate
     */
    public static function createByRightAngle($rightAngle)
    {
        $leftAngle = abs(360 - $rightAngle);
        return self::createByLeftAngle($leftAngle);
    }

    /**
     * 左回転角度から生成する
     * @param int $leftAngle 左回転角度
     * @return Rotate
     */
    public static function createByLeftAngle($leftAngle)
    {
        return new self($leftAngle);
    }

    /**
     * @param \Dm_Image $image
     * @return resource
     */
    public function execute(\Dm_Image $image)
    {
        if ($this->leftAngle === 0) {
            return $image->getImageResource();
        }
        return imagerotate($image->getImageResource(), $this->leftAngle, 0, 0);
    }
}
