# DmImagePlugin

gdラッパの画像処理ライブラリ [DmImage](https://github.com/demouth/DmImage) 用の拡張。

- Filters
  - 水平反転フィルタ
  - 垂直反転フィルタ
  - 度数指定による回転フィルタ

- FilterFactories
  - Exif orientation に基づく 回転/反転 フィルタ群


# Install

```bash
composer require "iamapen/dmimage-plugin"
```


# 注意点
[DmImage](https://github.com/demouth/DmImage) にタグが打たれていないので、現時点(2016-10-20) での最新のコミット `cf14053` を対象としている。

# Usage

```php

// Exif情報取得
$exif = exif_read_data($src);

// Orientation からふさわしいフィルタ群生成
$filters = [];
if(array_key_exists('Orientation', $exif)) {
  $filters = \Iamapen\DmImagePlugin\DmImage\Filter\FactoryExif::createFilters($exif['Orientation']);
}

// フィルタ適用
$image = new \Dm_Image_File($src);
$image->applyFilters($filters)->saveTo($dest, 'jpg', 90);
```


# ライセンス
MIT License
