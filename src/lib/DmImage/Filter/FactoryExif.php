<?php
namespace Iamapen\DmImagePlugin\DmImage\Filter;

/**
 * Exif の Orientation から、回転/反転フィルタ群を生成する
 */
class FactoryExif {

    /**
     * @param int $exifOrientation
     * @return \Dm_Image_Filter_Abstract[]
     */
    static public function createFilters($exifOrientation)
    {
        $filters = array();

        switch ($exifOrientation) {
            case 2:     // 左右反転
                $filters[] = new HFlip();
                break;
            case 3:     // 180度回転
                $filters[] = Rotate::createByRightAngle(180);
                break;
            case 4:     // 上下反転
                $filters[] = new VFlip();
                break;
            case 5:     // 右に90度回転、左右反転
                $filters[] = Rotate::createByRightAngle(90);
                $filters[] = new HFlip();
                break;
            case 6:     // 右に90度回転
                $filters[] = Rotate::createByRightAngle(90);
                break;
            case 7:     // 左に90度回転、左右反転
                $filters[] = Rotate::createByRightAngle(270);
                $filters[] = new HFlip();
                break;
            case 8:     // 左に90度回転
                $filters[] = Rotate::createByRightAngle(270);
                break;
            case 1:
            default:
                // 回転不要
        }

        return $filters;
    }
}
