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
composer require "iamapen/dmimage-plugin" "demouth/dmimage:dev-master#cf14053c5a57fc001eb124802f0e824bf0f19803"
```

[DmImage](https://github.com/demouth/DmImage) にタグが打たれていない。  
安定バージョンの存在しないライブラリは、利用側(ルートパッケージ) でコミットを指定する必要がある。 
 
現時点(2016-10-20) での最新のコミット [cf14053](https://github.com/demouth/DmImage/commit/cf14053c5a57fc001eb124802f0e824bf0f19803)
であり、当ライブラリはこれを前提に作成されている。  
DmImage 側のAPIに変更がない限りは `@dev` 指定でもよいのだが、それは保証されていない。


# Usage

### 水平反転
```php
$filters = [];
$filters[] = new \Iamapen\DmImagePlugin\DmImage\Filter\HFlip();

$image = new \Dm_Image_File($src);
$image->applyFilters($filters)->saveTo($dest, 'jpg', 90);
```

### 垂直反転
```php
$filters = [];
$filters[] = new \Iamapen\DmImagePlugin\DmImage\Filter\VFlip();

$image = new \Dm_Image_File($src);
$image->applyFilters($filters)->saveTo($dest, 'jpg', 90);
```

### 回転
右回転もしくは左回転の角度を指定してフィルタを作る。

```php
$filters = [];
// 右180度回転
$filters[] = \Iamapen\DmImagePlugin\DmImage\Filter\Rotate::createByRightAngle(180);
// 左90度回転
$filters[] = \Iamapen\DmImagePlugin\DmImage\Filter\Rotate::createByLeftAngle(90);

$image = new \Dm_Image_File($src);
$image->applyFilters($filters)->saveTo($dest, 'jpg', 90);
```

### Exif Orientation に基づく 回転/反転
`FactoryExif::createFilters($orientation)` で、相応しいフィルタ群を生成できる。

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
