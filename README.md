# class.upload.php

Homepage : [http://www.verot.net/php_class_upload.htm](http://www.verot.net/php_class_upload.htm)

Demo : [http://www.verot.net/php_class_upload_samples.htm](http://www.verot.net/php_class_upload_samples.htm)

Donations: [http://www.verot.net/php_class_upload_donate.htm](http://www.verot.net/php_class_upload_donate.htm)

Commercial use: [http://www.verot.net/php_class_upload_license.htm](http://www.verot.net/php_class_upload_license.htm)


## What does it do?


This class manages file uploads for you. In short, it manages the uploaded file, and allows you to do whatever you want with the file, especially if it is an image, and as many times as you want.

It is the ideal class to quickly integrate file upload in your site. If the file is an image, you can convert, resize, crop it in many ways. You can also apply filters, add borders, text, watermarks, etc... That's all you need for a gallery script for instance. Supported formats are PNG, JPG, GIF, WEBP and BMP.

You can also use the class to work on local files, which is especially useful to use the image manipulation features. The class also supports Flash uploaders and XMLHttpRequest.

The class works with PHP 5.3+, PHP 7 and PHP 8 (use version 1.x for PHP 4 support), and its error messages can be localized at will.


## Install via composer

Edit your composer.json file to include the following:

```
    {
       "require": {
           "verot/class.upload.php": "*"
       }
    }
```

Or install it directly:

```
    composer require verot/class.upload.php
```

## Demo and examples

Check out the `test/` directory, which you can load in your browser. You can test the class and its different ways to instantiate it, see some code examples, and run some tests.



## How to use it?

Create a simple HTML file, with a form such as:
```html
<form enctype="multipart/form-data" method="post" action="upload.php">
  <input type="file" size="32" name="image_field" value="">
  <input type="submit" name="Submit" value="upload">
</form>
```
Create a file called upload.php (into which you have first loaded the class):
```php
$handle = new \Verot\Upload\Upload($_FILES['image_field']);
if ($handle->uploaded) {
  $handle->file_new_name_body   = 'image_resized';
  $handle->image_resize         = true;
  $handle->image_x              = 100;
  $handle->image_ratio_y        = true;
  $handle->process('/home/user/files/');
  if ($handle->processed) {
    echo 'image resized';
    $handle->clean();
  } else {
    echo 'error : ' . $handle->error;
  }
}
```


### How does it work?

You instanciate the class with the `$_FILES['my_field']` array where _my_field_ is the field name from your upload form. The class will check if the original file has been uploaded to its temporary location (alternatively, you can instanciate the class with a local filename).

You can then set a number of processing variables to act on the file. For instance, you can rename the file, and if it is an image, convert and resize it in many ways. You can also set what will the class do if the file already exists.

Then you call the function `process()` to actually perform the actions according to the processing parameters you set above. It will create new instances of the original file, so the original file remains the same between each process. The file will be manipulated, and copied to the given location. The processing variables will be reset once it is done.

You can repeat setting up a new set of processing variables, and calling `process()` again as many times as you want. When you have finished, you can call `clean()` to delete the original uploaded file.

If you don't set any processing parameters and call `process()` just after instanciating the class. The uploaded file will be simply copied to the given location without any alteration or checks.

Don't forget to add `enctype="multipart/form-data"` in your form tag `<form>` if you want your form to upload the file.

### Namespacing

The class is now namespaced in the `Verot/Upload` namespace. If you have the error *Fatal error:  Class 'Upload' not found*, then make sure your file belongs to the namespace, or instantiate the class with its fully qualified name:

```php
namespace Verot\Upload;
$handle = new Upload($_FILES['image_field']);
```
or

```php
$handle = new \Verot\Upload\Upload($_FILES['image_field']);
```

### How to process local files?

Instantiate the class with the local filename, as following:

```php
$handle = new Upload('/home/user/myfile.jpg');
```


### How to process a file uploaded via XMLHttpRequest?

Instantiate the class with the special _php:_ keyword, as following:

```php
$handle = new Upload('php:'.$_SERVER['HTTP_X_FILE_NAME']);
```

Prefixing the argument with _php:_ tells the class to retrieve the uploaded data in _php://input_, and the rest is the stream's filename, which is generally in `$_SERVER['HTTP_X_FILE_NAME']`. But you can use any other name you see fit:

```php
$handle = new Upload('php:mycustomname.ext');
```

### How to process raw file data?

Instantiate the class with the special _data:_ keyword, as following:

```php
$handle = new Upload('data:'.$file_contents);
```

If your data is base64-encoded, the class provides a simple _base64:_ keyword, which will decode your data prior to using it:

```php
$handle = new Upload('base64:'.$base64_file_contents);
```

### How to set the language?

Instantiate the class with a second argument being the language code:

```php
$handle = new Upload($_FILES['image_field'], 'fr_FR');
$handle = new Upload('/home/user/myfile.jpg', 'fr_FR');
```

### How to output the resulting file or picture directly to the browser?

Simply call `process()` without an argument (or with null as first argument):

```php
$handle = new Upload($_FILES['image_field']);
header('Content-type: ' . $handle->file_src_mime);
echo $handle->process();
die();
```

Or if you want to force the download of the file:

```php
$handle = new Upload($_FILES['image_field']);
header('Content-type: ' . $handle->file_src_mime);
header("Content-Disposition: attachment; filename=".rawurlencode($handle->file_src_name).";");
echo $handle->process();
die();
```


### Troubleshooting

If the class doesn't do what you want it to do, you can display the log, in order to see in details what the class does. To obtain the log, just add this line at the end of your code:
```php
echo $handle->log;
```

Your problem may have been already discussed in the Frequently Asked Questions : [http://www.verot.net/php_class_upload_faq.htm](http://www.verot.net/php_class_upload_faq.htm)

Failing that, you can search in the forums, and ask a question there:  [http://www.verot.net/php_class_upload_forum.htm](http://www.verot.net/php_class_upload_forum.htm). Please don't use Github issues to ask for help.



## Processing parameters


> Note: all the parameters in this section are reset after each process.


### File handling

* **file_new_name_body** replaces the name body (default: null)
```php
$handle->file_new_name_body = 'new name';
```
* **file_name_body_add** appends to the name body (default: null)
```php
$handle->file_name_body_add = '_uploaded';
```
* **file_name_body_pre** prepends to the name body (default: null)
```php
$handle->file_name_body_pre = 'thumb_';
```
* **file_new_name_ext** replaces the file extension (default: null)
```php
$handle->file_new_name_ext = 'txt';
```
* **file_safe_name** formats the filename (spaces changed to _, etc...) (default: true)
```php
$handle->file_safe_name = true;
```
* **file_force_extension** forces an extension if there isn't any (default: true)
```php
$handle->file_force_extension = true;
```
* **file_overwrite** sets behaviour if file already exists (default: false)
```php
$handle->file_overwrite = true;
```
* **file_auto_rename** automatically renames file if it already exists (default: true)
```php
$handle->file_auto_rename = true;
```
* **dir_auto_create** automatically creates destination directory if missing (default: true)
```php
$handle->dir_auto_create = true;
```
* **dir_auto_chmod** automatically attempts to chmod the destination directory if not writeable (default: true)
```php
$handle->dir_auto_chmod = true;
```
* **dir_chmod** chmod used when creating directory or if directory not writeable (default: 0777)
```php
$handle->dir_chmod = 0777;
```
* **file_max_size** sets maximum upload size (default: _upload_max_filesize_ from php.ini)
```php
$handle->file_max_size = '1024'; // 1KB
```
* **mime_check** sets if the class check the MIME against the `allowed` list (default: true)
```php
$handle->mime_check = true;
```
* **no_script** sets if the class turns scripts into text files (default: true)
```php
$handle->no_script = false;
```
* **allowed** array of allowed mime-types (or one string). wildcard accepted, as in _image/*_ (default: check `init()`)
```php
$handle->allowed = array('application/pdf','application/msword', 'image/*');
```
* **forbidden** array of forbidden mime-types (or one string). wildcard accepted, as in _image/*_  (default: check `init()`)
```php
$handle->forbidden = array('application/*');
```


### Image handling


* **image_convert** if set, image will be converted (possible values : ''|'png'|'webp'|'jpeg'|'gif'|'bmp'; default: '')
```php
$handle->image_convert = 'jpg';
```
* **image_background_color** if set, will forcibly fill transparent areas with the color, in hexadecimal (default: null)
```php
$handle->image_background_color = '#FF00FF';
```
* **image_default_color** fallback color background color for non alpha-transparent output formats, such as JPEG or BMP, in hexadecimal (default: #FFFFFF)
```php
$handle->image_default_color = '#FF00FF';
```
* **png_compression** sets the compression level for PNG images, between 1 (fast but large files) and 9 (slow but smaller files) (default: null (Zlib default))
```php
$handle->png_compression = 9;
```
* **webp_quality** sets the compression quality for WEBP images (default: 85)
```php
$handle->webp_quality = 50;
```
* **jpeg_quality** sets the compression quality for JPEG images (default: 85)
```php
$handle->jpeg_quality = 50;
```
* **jpeg_size** if set to a size in bytes, will approximate `jpeg_quality` so the output image fits within the size (default: null)
```php
$handle->jpeg_size = 3072;
```
* **image_interlace** if set to true, the image will be saved interlaced (if it is a JPEG, it will be saved as a progressive PEG)  (default: false)
```php
$handle->image_interlace = true;
```

### Image checking


The following eight settings can be used to invalidate an upload if the file is an image (note that _open_basedir_ restrictions prevent the use of these settings)

* **image_max_width** if set to a dimension in pixels, the upload will be invalid if the image width is greater (default: null)
```php
$handle->image_max_width = 200;
```
* **image_max_height** if set to a dimension in pixels, the upload will be invalid if the image height is greater (default: null)
```php
$handle->image_max_height = 100;
```
* **image_max_pixels** if set to a number of pixels, the upload will be invalid if the image number of pixels is greater (default: null)
```php
$handle->image_max_pixels = 50000;
```
* **image_max_ratio** if set to a aspect ratio (width/height), the upload will be invalid if the image apect ratio is greater (default: null)
```php
$handle->image_max_ratio = 1.5;
```
* **image_min_width** if set to a dimension in pixels, the upload will be invalid if the image width is lower (default: null)
```php
$handle->image_min_width = 100;
```
* **image_min_height** if set to a dimension in pixels, the upload will be invalid if the image height is lower (default: null)
```php
$handle->image_min_height = 500;
```
* **image_min_pixels** if set to a number of pixels, the upload will be invalid if the image number of pixels is lower (default: null)
```php
$handle->image_min_pixels = 20000;
```
* **image_min_ratio** if set to a aspect ratio (width/height), the upload will be invalid if the image apect ratio is lower (default: null)
```php
$handle->image_min_ratio = 0.5;
```

### Image resizing


* **image_resize** determines is an image will be resized (default: false)
```php
$handle->image_resize = true;
```

The following variables are used only if _image_resize_ == true

* **image_x** destination image width (default: 150)
```php
$handle->image_x = 100;
```
* **image_y** destination image height (default: 150)
```php
$handle->image_y = 200;
```

Use either one of the following

* **image_ratio** if true, resize image conserving the original sizes ratio, using `image_x` **AND** `image_y` as max sizes if true (default: false)
```php
$handle->image_ratio = true;
```
* **image_ratio_crop** if true, resize image conserving the original sizes ratio, using `image_x` AND `image_y` as max sizes, and cropping excedent to fill the space. setting can also be a string, with one or more from 'TBLR', indicating which side of the image will be kept while cropping (default: false)
```php
$handle->image_ratio_crop = true;
```
* **image_ratio_fill** if true, resize image conserving the original sizes ratio, using `image_x` AND `image_y` as max sizes, fitting the image in the space and coloring the remaining space. setting can also be a string, with one or more from 'TBLR', indicating which side of the space the image will be in (default: false)
```php
$handle->image_ratio_fill = true;
```
* **image_ratio_x** if true, resize image, calculating `image_x` from `image_y` and conserving the original sizes ratio (default: false)
```php
$handle->image_ratio_x = true;
```
* **image_ratio_y** if true, resize image, calculating `image_y` from `image_x` and conserving the original sizes ratio (default: false)
```php
$handle->image_ratio_y = true;
```
* **image_ratio_pixels** if set to a long integer, resize image, calculating `image_y` and `image_x` to match a the number of pixels (default: false)
```php
$handle->image_ratio_pixels = 25000;
```

And eventually prevent enlarging or shrinking images

* **image_no_enlarging** cancel resizing if the resized image is bigger than the original image, to prevent enlarging (default: false)
```php
$handle->image_no_enlarging = true;
```
* **image_no_shrinking** cancel resizing if the resized image is smaller than the original image, to prevent shrinking (default: false)
```php
$handle->image_no_shrinking = true;
```

### Image effects

The following image manipulations require GD2+

* **image_brightness** if set, corrects the brightness. value between -127 and 127 (default: null)
```php
$handle->image_brightness = 40;
```
* **image_contrast** if set, corrects the contrast. value between -127 and 127 (default: null)
```php
$handle->image_contrast = 50;
```
* **image_opacity** if set, changes the image opacity. value between 0 and 100 (default: null)
```php
$handle->image_opacity = 50;
```
* **image_tint_color** if set, will tint the image with a color, value as hexadecimal #FFFFFF (default: null)
```php
$handle->image_tint_color = '#FF0000';
```
* **image_overlay_color** if set, will add a colored overlay, value as hexadecimal #FFFFFF (default: null)
```php
$handle->image_overlay_color = '#FF0000';
```
* **image_overlay_opacity** used when `image_overlay_color` is set, determines the opacity (default: 50)
```php
$handle->image_overlay_opacity = 20;
```
* **image_negative** inverts the colors in the image (default: false)
```php
$handle->image_negative = true;
```
* **image_greyscale** transforms an image into greyscale (default: false)
```php
$handle->image_greyscale = true;
```
* **image_threshold** applies a threshold filter. value between -127 and 127 (default: null)
```php
$handle->image_threshold = 20;
```
* **image_pixelate** pixelate an image, value is block size (default: null)
```php
$handle->image_pixelate = 10;
```
* **image_unsharp** applies an unsharp mask, with alpha transparency support (default: false)
```php
$handle->image_unsharp = true;
```
* **image_unsharp_amount** unsharp mask amount, typically 50 - 200 (default: 80)
```php
$handle->image_unsharp_amount = 120;
```
* **image_unsharp_radius** unsharp mask radius, typically 0.5 - 1 (default: 0.5)
```php
$handle->image_unsharp_radius = 1;
```
* **image_unsharp_threshold** unsharp mask threshold, typically 0 - 5 (default: 1)
```php
$handle->image_unsharp_threshold = 0;
```

### Image text

* **image_text** creates a text label on the image, value is a string, with eventual replacement tokens (default: null)
```php
$handle->image_text = 'test';
```
* **image_text_direction** text label direction, either 'h' horizontal or 'v' vertical (default: 'h')
```php
$handle->image_text_direction = 'v';
```
* **image_text_color** text color for the text label, in hexadecimal (default: #FFFFFF)
```php
$handle->image_text_color = '#FF0000';
```
* **image_text_opacity** text opacity on the text label, integer between 0 and 100 (default: 100)
```php
$handle->image_text_opacity = 50;
```
* **image_text_background** text label background color, in hexadecimal (default: null)
```php
$handle->image_text_background = '#FFFFFF';
```
* **image_text_background_opacity** text label background opacity, integer between 0 and 100 (default: 100)
```php
$handle->image_text_background_opacity = 50;
```
* **image_text_font** built-in font for the text label, from 1 to 5. 1 is the smallest (default: 5). Value can also be a string, which represents the path to a GDF or TTF font (TrueType).
```php
$handle->image_text_font = 4; // or './font.gdf' or './font.ttf'
```
* **image_text_size** font size for TrueType fonts, in pixels (GD1) or points (GD1) (default: 16) (TrueType fonts only)
```php
$handle->image_text_size = 24;
```
* **image_text_angle** text angle for TrueType fonts, in degrees, with 0 degrees being left-to-right reading text(default: null) (TrueType fonts only)
```php
$handle->image_text_angle = 45;
```
* **image_text_x** absolute text label position, in pixels from the left border. can be negative (default: null)
```php
$handle->image_text_x = 5;
```
* **image_text_y** absolute text label position, in pixels from the top border. can be negative (default: null)
```php
$handle->image_text_y = 5;
```
* **image_text_position** text label position withing the image, a combination of one or two from 'TBLR': top, bottom, left, right (default: null)
```php
$handle->image_text_position = 'LR';
```
* **image_text_padding** text label padding, in pixels. can be overridden by `image_text_padding_x` and `image_text_padding_y` (default: 0)
```php
$handle->image_text_padding = 5;
```
* **image_text_padding_x** text label horizontal padding (default: null)
```php
$handle->image_text_padding_x = 2;
```
* **image_text_padding_y** text label vertical padding (default: null)
```php
$handle->image_text_padding_y = 10;
```
* **image_text_alignment** text alignment when text has multiple lines, either 'L', 'C' or 'R' (default: 'C') (GD fonts only)
```php
$handle->image_text_alignment = 'R';
```
* **image_text_line_spacing** space between lines in pixels, when text has multiple lines (default: 0) (GD fonts only)
```php
$handle->image_text_line_spacing = 3;
```

### Image transformations


* **image_auto_rotate** automatically rotates the image according to EXIF data (JPEG only) (default: true, applies even if there is no image manipulations)
```php
$handle->image_auto_rotate = false;
```
* **image_flip** flips image, wither 'h' horizontal or 'v' vertical (default: null)
```php
$handle->image_flip = 'h';
```
* **image_rotate** rotates image. Possible values are 90, 180 and 270 (default: null)
```php
$handle->image_rotate = 90;
```
* **image_crop** crops image. accepts 4, 2 or 1 values as 'T R B L' or 'TB LR' or 'TBLR'. dimension can be 20, or 20px or 20% (default: null)
```php
$handle->image_crop = array(50,40,30,20); OR '-20 20%'...
```
* **image_precrop** crops image, before an eventual resizing. accepts 4, 2 or 1 values as 'T R B L' or 'TB LR' or 'TBLR'. dimension can be 20, or 20px or 20% (default: null)
```php
$handle->image_precrop = array(50,40,30,20); OR '-20 20%'...
```

### Image borders


* **image_bevel** adds a bevel border to the image. value is thickness in pixels (default: null)
```php
$handle->image_bevel = 20;
```
* **image_bevel_color1** top and left bevel color, in hexadecimal (default: #FFFFFF)
```php
$handle->image_bevel_color1 = '#FFFFFF';
```
* **image_bevel_color2** bottom and right bevel color, in hexadecimal (default: #000000)
```php
$handle->image_bevel_color2 = '#000000';
```
* **image_border** adds a unicolor border to the image. accepts 4, 2 or 1 values as 'T R B L' or 'TB LR' or 'TBLR'. dimension can be 20, or 20px or 20% (default: null)
```php
$handle->image_border = '3px'; OR '-20 20%' OR array(3,2)...
```
* **image_border_color** border color, in hexadecimal (default: #FFFFFF)
```php
$handle->image_border_color = '#FFFFFF';
```
* **image_border_opacity** border opacity, integer between 0 and 100 (default: 100)
```php
$handle->image_border_opacity = 50;
```
* **image_border_transparent** adds a fading-to-transparent border to the image. accepts 4, 2 or 1 values as 'T R B L' or 'TB LR' or 'TBLR'. dimension can be 20, or 20px or 20% (default: null)
```php
$handle->image_border_transparent = '3px'; OR '-20 20%' OR array(3,2)...
```
* **image_frame** type of frame: 1=flat 2=crossed (default: null)
```php
$handle->image_frame = 2;
```
* **image_frame_colors** list of hex colors, in an array or a space separated string (default: '#FFFFFF #999999 #666666 #000000')
```php
$handle->image_frame_colors = array('#999999',  '#FF0000', '#666666', '#333333', '#000000');
```
* **image_frame_opacity** frame opacity, integer between 0 and 100 (default: 100)
```php
$handle->image_frame_opacity = 50;
```


### Image watermark

* **image_watermark** adds a watermark on the image, value is a local filename. accepted files are GIF, JPG, BMP, WEBP, PNG and PNG alpha (default: null)
```php
$handle->image_watermark = 'watermark.png';
```
* **image_watermark_x** absolute watermark position, in pixels from the left border. can be negative (default: null)
```php
$handle->image_watermark_x = 5;
```
* **image_watermark_y** absolute watermark position, in pixels from the top border. can be negative (default: null)
```php
$handle->image_watermark_y = 5;
```
* **image_watermark_position** watermark position withing the image, a combination of one or two from 'TBLR': top, bottom, left, right (default: null)
```php
$handle->image_watermark_position = 'LR';
```
* **image_watermark_no_zoom_in** prevents the watermark to be resized up if it is smaller than the image (default: true)
```php
$handle->image_watermark_no_zoom_in = false;
```
* **image_watermark_no_zoom_out** prevents the watermark to be resized down if it is bigger than the image (default: false)
```php
$handle->image_watermark_no_zoom_out = true;
```


### Image reflections

* **image_reflection_height** if set, a reflection will be added. Format is either in pixels or percentage, such as 40, '40', '40px' or '40%' (default: null)
```php
$handle->image_reflection_height = '25%';
```
* **image_reflection_space** space in pixels between the source image and the reflection, can be negative (default: null)
```php
$handle->image_reflection_space = 3;
```
* **image_reflection_color** reflection background color, in hexadecimal. Now deprecated in favor of `image_default_color` (default: #FFFFFF)
```php
$handle->image_default_color = '#000000';
```
* **image_reflection_opacity** opacity level at which the reflection starts, integer between 0 and 100 (default: 60)
```php
$handle->image_reflection_opacity = 60;
```



## Values that can be read before calling `process()`

* **file_src_name** Source file name
* **file_src_name_body** Source file name body
* **file_src_name_ext** Source file extension
* **file_src_pathname** Source file complete path and name
* **file_src_mime** Source file mime type
* **file_src_size** Source file size in bytes
* **file_src_error** Upload error code
* **file_is_image** Boolean flag, true if the file is a supported image type

If the file is a supported image type (and _open_basedir_ restrictions allow it)

* **image_src_x** Source file width in pixels
* **image_src_y** Source file height in pixels
* **image_src_pixels** Source file number of pixels
* **image_src_type** Source file type (png, webp, jpg, gif or bmp)
* **image_src_bits** Source file color depth


## Values that can be read after calling `process()`

* **file_dst_path** Destination file path
* **file_dst_name_body** Destination file name body
* **file_dst_name_ext** Destination file extension
* **file_dst_name** Destination file name
* **file_dst_pathname** Destination file complete path and name

If the file is a supported image type

* **image_dst_type** Destination file type (png, webp, jpg, gif or bmp)
* **image_dst_x** Destination file width
* **image_dst_y** Destination file height



## Requirements

Most of the image operations require GD. GD2 is greatly recommended

Version 1.x supports PHP 4, 5 and 7, but is not namespaced. Use it if you need support for PHP <5.3

Version 2.x supports PHP 5.3+ and PHP 7.

