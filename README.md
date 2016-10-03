# class.upload.php

Homepage : [http://www.verot.net/php_class_upload.htm](http://www.verot.net/php_class_upload.htm)

Demo : [http://www.verot.net/php_class_upload_samples.htm](http://www.verot.net/php_class_upload_samples.htm)

Commercial use: [http://www.verot.net/php_class_upload_license.htm](http://www.verot.net/php_class_upload_license.htm)


## What does it do?


This class manages file uploads for you. In short, it manages the uploaded file, and allows you to do whatever you want with the file, especially if it is an image, and as many times as you want.

It is the ideal class to quickly integrate file upload in your site. If the file is an image, you can convert, resize, crop it in many ways. You can also apply filters, add borders, text, watermarks, etc... That's all you need for a gallery script for instance. Supported formats are PNG, JPG, GIF and BMP.

You can also use the class to work on local files, which is especially useful to use the image manipulation features. The class also supports Flash uploaders and XMLHttpRequest.

The class works with PHP 4, 5 and 7, and its error messages can be localized at will.




## Install via composer

Edit your composer.json file to include the following:

```
    {
       "require": {
           "verot/class.upload.php": "dev-master"
       }
    }
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
$handle = new upload($_FILES['image_field']);
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



### How to process local files?

Instantiate the class with the local filename, as following:

```php
$handle = new upload('/home/user/myfile.jpg');
```


### How to process a file uploaded via XMLHttpRequest?

Instantiate the class with the special _php:_ keyword, as following:

```php
$handle = new upload('php:'.$_SERVER['HTTP_X_FILE_NAME']);
```

Prefixing the argument with _php:_ tells the class to retrieve the uploaded data in _php://input_, and the rest is the stream's filename, which is generally in `$_SERVER['HTTP_X_FILE_NAME']`. But you can use any other name you see fit:

```php
$handle = new upload('php:mycustomname.ext');
```

### How to process raw file data?

Instantiate the class with the special _data:_ keyword, as following:

```php
$handle = new upload('data:'.$file_contents);
```

If your data is base64-encoded, the class provides a simple _base64:_ keyword, which will decode your data prior to using it:

```php
$handle = new upload('base64:'.$base64_file_contents);
```

### How to set the language?

Instantiate the class with a second argument being the language code:

```php
$handle = new upload($_FILES['image_field'], 'fr_FR');
$handle = new upload('/home/user/myfile.jpg', 'fr_FR');
```

### How to output the resulting file or picture directly to the browser?

Simply call `process()` without an argument (or with null as first argument):

```php
$handle = new upload($_FILES['image_field']);
header('Content-type: ' . $handle->file_src_mime);
echo $handle->Process();
die();
```

Or if you want to force the download of the file:

```php
$handle = new upload($_FILES['image_field']);
header('Content-type: ' . $handle->file_src_mime);
header("Content-Disposition: attachment; filename=".rawurlencode($handle->file_src_name).";");
echo $handle->Process();
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


* **image_convert** if set, image will be converted (possible values : ''|'png'|'jpeg'|'gif'|'bmp'; default: '')
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

* **image_watermark** adds a watermark on the image, value is a local filename. accepted files are GIF, JPG, BMP, PNG and PNG alpha (default: null)
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
* **image_src_type** Source file type (png, jpg, gif or bmp)
* **image_src_bits** Source file color depth


## Values that can be read after calling `process()`

* **file_dst_path** Destination file path
* **file_dst_name_body** Destination file name body
* **file_dst_name_ext** Destination file extension
* **file_dst_name** Destination file name
* **file_dst_pathname** Destination file complete path and name

If the file is a supported image type

* **image_dst_type** Destination file type (png, jpg, gif or bmp)
* **image_dst_x** Destination file width
* **image_dst_y** Destination file height



## Requirements

Most of the image operations require GD. GD2 is greatly recommended

The class requires PHP 4.3+, and is compatible with PHP 5 and PHP 7



## Changelog

**dev**

* added support for UTF-8 text and TrueType fonts
* add support for raw file data and base64 encoded file data
* remove deprecated properties
* better checking of function availability
* added `image_no_enlarging` and `image_no_shrinking` to replace `image_ratio_no_zoom_in` and `image_ratio_no_zoom_out`
* checks JPEG auto-rotate even if there is no image manipulation

**v 0.33** 16/07/2016

* added PHP7 compatibility
* fixed filesize when using XMLHttpRequest
* added Hungarian translation
* added Tamil translation
* added Finnish translation
* fixed Turkish translation
* updated regex rules for MIME detection
* added _composer.json_
* updated code for GIT publishing
* auto-rotate JPEG according to EXIF data

**v 0.32** 15/01/2013

* add support for XMLHttpRequest uploads
* added `image_pixelate`
* added `image_interlace`
* added `png_compression` to change PNG compressoin level
* deactivate `exec()` if Suhosin is enabled
* add more extension to dangerous scripts detection
* imagejpeg takes null as second argument since PHP 5.4
* default PECL Fileinfo MAGIC path to null
* set gd.jpeg_ignore_warning to true by default
* fixed file name normalization

**v 0.31** 11/04/2011

* added _application/x-rar` MIME type
* make sure `exec()` and `ini_get_all()` function are not disabled if we want to use them
* make sure that we don't divide by zero when calculating JPEG size
* `allowed` and `forbidden` can now accept strings
* try to guess the file extension from the MIME type if there is no file extension
* better class properties when changing the file extension
* added `file_force_extension` to allow extension-less files if needed
* better file safe conversion of the filename
* allow shorthand byte values, such as 1K, 2M, 3G for `file_max_size` and `jpeg_size`
* added `image_opacity` to change picture opacity
* added `image_border_opacity` to allow semi-transparent borders
* added `image_frame_opacity` to allow semi-transparent frames
* added `image_border_transparent` to allow borders fading to transparent
* duplicated `image_overlay_percent` into `image_overlay_opacity`
* duplicated `image_text_percent` into `image_text_opacity`
* duplicated `image_text_background_percent` into `image_text_background_opacity`

**v 0.30** 05/09/2010

* implemented an unsharp mask, with alpha transparency support, activated if `image_unsharp` is true. added `image_unsharp_amount`, `image_unsharp_radius`, and `image_unsharp_threshold`
* added _text/rtf_ MIME type, and no_script exception
* corrected bug when `no_script` is activated and several `process()` are called
* better error handling for finfo
* display _upload_max_filesize_ information from php.ini in the log
* automatic extension for extension-less images
* fixed `image_ratio_fill` top and left filling
* fixed alphablending issue when applying a transparent PNG watermark on a transparent PNG
* added `image_watermark_no_zoom_in` and `image_watermark_no_zoom_out` to allow the watermark to be resized down (or up) to fit in the image. By default, the watermark may be resized down, but not up.

**v 0.29** 03/02/2010

* added protection against malicious images
* added zip and torrent MIME type
* replaced `split()` with `explode()`
* initialise `image_dst_x/y` with `image_src_x/y`
* removed `mime_fileinfo`, `mime_file`, `mime_magic` and `mime_getimagesize` from the docs since they are used before `process`
* added more extensions and MIME types
* improved MIME type validation
* improved logging

**v 0.28** 10/08/2009

* replaced ereg functions to be compatible with PHP 5.3
* added flv MIME type
* improved MIME type detection
* added `file_name_body_pre` to prepend a string to the file name
* added `mime_fileinfo`, `mime_file`, `mime_magic` and `mime_getimagesize` so that it is possible to deactivate some MIME type checking method
* use `exec()` rather than `shell_exec()`, to play better with safe mode
* added some error messages
* fix bug when checking on conditions, `processed` wasn't propagated properly

**v 0.27** 14/05/2009

* look for the language files directory from `_FILE__
* deactivate `file_auto_rename` if `file_overwrite` is set
* improved transparency replacement for true color images
* fixed calls to newer version of UNIX file utility
* fixed error when using PECL Fileinfo extension in SAFE MODE, and when using the finfo class
* added `image_precrop` to crop the image before an eventual resizing

**v 0.26** 13/11/2008

* rewrote conversion from palette to true color to handle transparency better
* fixed imagecopymergealpha() when the overlayed image is of wrong dimensions
* fixed imagecreatenew() when the image to create have less than 1 pixels width or height
* rewrote MIME type detection to be more secure and not rely on browser information; now using _Fileinfo PECL_ extension, UNIX `file()` command, _MIME magic_, and `getimagesize()`, in that order
* added support for Flash uploaders
* some bug fixing and error handling

**v 0.25** 17/11/2007

* added translation files and mechanism to instantiate the class with a language different from English
* added `forbidden` to set an array of forbidden MIME types
* implemented support for simple wildcards in `allowed` and `forbidden`, such as image/*
* preset the file extension to the desired conversion format when converting an image
* added read and write support for BMP images
* added a flag `file_is_image` to determine if the file is a supported image type
* the class now provides some information about the image, before calling `process()`. Available are `image_src_x`, `image_src_y` and the newly introduced `image_src_bits`, `image_src_pixels` and `image_src_type`. Note that this will not work if `open_basedir` restrictions are in place
* improved logging; now provides useful system information
* added some more pre-processing checks for files that are images: `image_max_width`, `image_max_height`, `image_max_pixels`, `image_max_ratio`, `image_min_width`, `image_min_height`, `image_min_pixels` and `image_min_ratio`
* added `image_ratio_pixels` to resize an image to a number of pixels, keeping aspect ratio
* added `image_is_palette` and `image_is_transparent` and `image_transparent_color` for GIF images
* added `image_default_color` to define a fallback color for non alpha-transparent output formats, such as JPEG or BMP
* changed `image_background_color`, which now forces transparent areas to be painted
* improved reflections and color overlays so that it works with alpha transparent images
* `image_reflection_color` is now deprecated in favour of `image_default_color`
* transparent PNGs are now processed in true color, and fully preserving the alpha channel when doing merges
* transparent GIFs are now automatically detected. `preserve_transparency` is deprecated
* transparent true color images can be saved as GIF while retaining transparency, semi transparent areas being merged with `image_default_color`
* transparent true color images can be saved as JPG/BMP with the semi transparent areas being merged with `image_default_color`
* fixed conversion of images to true color
* the class can now output the uploaded files content as the return value of `process()` if the function is called with an empty or null argument, or no argument

**v 0.24** 25/05/2007

* added `image_background_color`, to set the default background color of an image
* added possibility of using replacement tokens in text labels
* changed default JPEG quality to 85
* fixed a small bug when using greyscale filter and associated filters
* added `image_ratio_fill` in order to fit an image within some dimensions and color the remaining space. Very similar to `image_ratio_crop`
* improved the recursive creation of directories
* the class now converts palette based images to true colors before doing graphic manipulations

**v 0.23** 23/12/2006

* fixed a bug when processing more than once the same uploaded file. If there is an _open_basedir_ restriction, the class now creates a temporary file for the first call to `process()`. This file will be used for subsequent processes, and will be deleted upon calling `clean()`

**v 0.22** 16/12/2006

* added automatic creation of a temporary file if the upload directory is not within open_basedir
* fixed a bug which was preventing to work on a local file by overwriting it with its processed copy
* added MIME types _video/x-ms-wmv_ and _image/x-png_ and fixed PNG support for IE weird MIME types
* modified `image_ratio_crop` so it can accept one or more from string 'TBLR', determining which side of the image is kept while cropping
* added support for multiple lines in the text, using "\n" as a line break
* added `image_text_line_spacing` which allow to set the space between several lines of text
* added `image_text_alignment` which allow to set the alignment when text has several lines
* `image_text_font` can now be set to the path of a GDF font to load external fonts
* added `image_reflection_height` to create a reflection of the source image, which height is in pixels or percentage
* added `image_reflection_space` to set the space in pixels between the source image and the reflection
* added `image_reflection_color` to set the reflection background color
* added `image_reflection_opacity` to set the initial level of opacity of the reflection

**v 0.21** 30/09/2006

* added `image_ratio_crop` which resizes within `image_x` and `image_y`, keeping ratio, but filling the space by cropping excedent of image
* added `mime_check`, which default is true, to set checks against `allowed` MIME list
* if MIME is empty, the class now triggers an error
* color #000000 is OK for `image_text_color`, and related text transparency bug fixed
* `gd_version()` now uses `gd_info()`, or else `phpinfo()`
* fixed path issue when the destination path has no trailing slash on Windows systems
* removed inline functions to be fully PHP5 compatible

**v 0.20** 11/08/2006

* added some more error checking and messages (GD presence, permissions...)
* fix when uploading files without extension
* changed values for `image_brightness` and `image_contrast` to be between -127 and 127
* added `dir_auto_create` to automatically and recursively create destination directory if missing.
* added `dir_auto_chmod` to automatically chmod the destination directory if not writeable.
* added `dir_chmod` to set the default chmod to use.
* added `image_crop` to crop images
* added `image_negative` to invert the colors on the image
* added `image_greyscale` to turn the image into greyscale
* added `image_threshold` to apply a threshold filter on the image
* added `image_bevel`, `image_bevel_color1` and `image_bevel_color2` to add a bevel border
* added `image_border` and `image_border_color` to add a single color border
* added `image_frame` and `image_frame_colors` to add a multicolored frame

**v 0.19** 29/03/2006

* class is now compatible i18n (thanks Sylwester).
* the class can mow manipulate local files, not only uploaded files (instanciate the class with a local filename).
* `file_safe_name` has been improved a bit.
* added `image_brightness`, `image_contrast`, `image_tint_color`, `image_overlay_color` and `image_overlay_percent` to do color manipulation on the images.
* added `image_text` and all derivated settings to add a text label on the image.
* added `image_watermark` and all derivated settings to add a watermark image on the image.
* added `image_flip` and `image_rotate` for more image manipulations
* added `jpeg_size` to calculate the JPG compression quality in order to fit within one filesize.

**v 0.18** 02/02/2006

* added `no_script` to turn dangerous scripts into text files.
* added `mime_magic_check` to set the class to use mime_magic.
* added `preserve_transparency` *experimental*. Thanks Gregor.
* fixed size and mime checking, wasn't working :/ Thanks Willem.
* fixed memory leak when resizing images.
* when resizing, it is not necessary anymore to set `image_convert`.
* il is now possible to simply convert an image, with no resizing.
* sets the default `file_max_size` to _upload_max_filesize_ from php.ini. Thanks Edward

**v 0.17** 28/05/2005

* the class can be used with any version of GD.
* added security check on the file with a list of mime-types.
* changed the license to GPL v2 only

**v 0.16** 19/05/2005

* added `file_auto_rename` automatic file renaming if the same filename already exists.
* added `file_safe_name` safe formatting of the filename (spaces to underscores so far).
* added some more error reporting to avoid crash if GD is not present

**v 0.15** 16/04/2005

* added JPEG compression quality setting. Thanks Vad

**v 0.14** 14/03/2005

* reworked the class file to allow parsing with phpDocumentor

**v 0.13** 07/03/2005

* fixed a bug with `image_ratio`. Thanks Justin.
* added `image_ratio_no_zoom_in` and `image_ratio_no_zoom_out`

**v 0.12** 21/01/2005

* added `image_ratio` to resize within max values, keeping image ratio

**v 0.11** 22/08/2003

* update for GD2 (changed `imageresized()` into `imagecopyresampled()` and `imagecreate()` into `imagecreatetruecolor()`)
