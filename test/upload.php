<?php
namespace Verot\Upload;

error_reporting(E_ALL);
@ini_set("display_errors", 1);

// we first include the upload class, as we will need it here to deal with the uploaded file
include('../src/class.upload.php');

// set variables
$dir_dest = (isset($_GET['dir']) ? $_GET['dir'] : 'tmp');
$dir_pics = (isset($_GET['pics']) ? $_GET['pics'] : $dir_dest);

$log = '';

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<meta http-equiv=content-type content="text/html; charset=UTF-8">
<head>
    <title>class.php.upload test forms</title>

    <style>
        body {
        }
        p.result {
          width: 50%;
          margin: 15px 0px 25px 0px;
          padding: 0px;
          clear: right;
        }
        img {
          float: right;
          background: url(bg.gif);
        }
        fieldset {
          width: 50%;
          margin: 15px 0px 25px 0px;
          padding: 15px;
        }
        legend {
          font-weight: bold;
        }
        fieldset p {
          font-size: 70%;
          font-style: italic;
        }
        .button {
          text-align: right;
        }
        .button input {
          font-weight: bold;
        }
    </style>
</head>

<body>

    <h1>class.upload.php test forms</h1>

<?php


// we have several forms on the test page, so we redirect accordingly
$action = (isset($_POST['action']) ? $_POST['action'] : (isset($_GET['action']) ? $_GET['action'] : ''));

if ($action == 'simple') {

    // ---------- SIMPLE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->process('/home/www/my_uploads/');
        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
            echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }

    $log .= $handle->log . '<br />';


} else if ($action == 'base64') {

    // ---------- BASE64 FILE ----------

    // we create an instance of the class, giving as argument the data string
    $handle = new Upload((isset($_POST['my_field']) ? $_POST['my_field'] : (isset($_GET['file']) ? $_GET['file'] : '')));

    // check if a temporary file has been created with the file data
    if ($handle->uploaded) {

        // yes, the file is on the server
        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
            echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the file failed for some reasons
        echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }

    $log .= $handle->log . '<br />';

} else if ($action == 'image') {

    // ---------- IMAGE UPLOAD ----------

    // we create an instance of the class, giving as argument the PHP object
    // corresponding to the file field from the form
    // All the uploads are accessible from the PHP object $_FILES
    $handle = new Upload($_FILES['my_field']);

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // below are some example settings which can be used if the uploaded file is an image.
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 300;

        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->process('/home/www/my_uploads/');
        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] .' -  ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we now process the image a second time, with some other settings
        $handle->image_resize            = true;
        $handle->image_ratio_y           = true;
        $handle->image_x                 = 300;
        $handle->image_reflection_height = '25%';
        $handle->image_contrast          = 50;

        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  <img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
            $info = getimagesize($handle->file_dst_pathname);
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a><br/>';
            echo '   (' . $info['mime'] . ' - ' . $info[0] . ' x ' . $info[1] .' - ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }

    $log .= $handle->log . '<br />';

} else if ($action == 'xhr') {

    // ---------- XMLHttpRequest UPLOAD ----------

    // we first check if it is a XMLHttpRequest call
    if (isset($_SERVER['HTTP_X_FILE_NAME']) && isset($_SERVER['CONTENT_LENGTH'])) {

        // we create an instance of the class, feeding in the name of the file
        // sent via a XMLHttpRequest request, prefixed with 'php:'
        $handle = new Upload('php:'.rawurldecode($_SERVER['HTTP_X_FILE_NAME']));

    } else {
        // we create an instance of the class, giving as argument the PHP object
        // corresponding to the file field from the form
        // This is the fallback, using the standard way
        $handle = new Upload($_FILES['my_field']);
    }

    // then we check if the file has been uploaded properly
    // in its *temporary* location in the server (often, it is /tmp)
    if ($handle->uploaded) {

        // yes, the file is on the server
        // now, we start the upload 'process'. That is, to copy the uploaded file
        // from its temporary location to the wanted location
        // It could be something like $handle->process('/home/www/my_uploads/');
        $handle->process($dir_dest);

        // we check if everything went OK
        if ($handle->processed) {
            // everything was fine !
            echo '<p class="result">';
            echo '  <b>File uploaded with success</b><br />';
            echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
            echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
            echo '</p>';
        } else {
            // one error occured
            echo '<p class="result">';
            echo '  <b>File not uploaded to the wanted location</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        // we delete the temporary files
        $handle-> clean();

    } else {
        // if we're here, the upload file failed for some reasons
        // i.e. the server didn't receive the file
        echo '<p class="result">';
        echo '  <b>File not uploaded on the server</b><br />';
        echo '  Error: ' . $handle->error . '';
        echo '</p>';
    }

    $log .= $handle->log . '<br />';

} else if ($action == 'multiple') {

    // ---------- MULTIPLE UPLOADS ----------

    // as it is multiple uploads, we will parse the $_FILES array to reorganize it into $files
    $files = array();
    foreach ($_FILES['my_field'] as $k => $l) {
        foreach ($l as $i => $v) {
            if (!array_key_exists($i, $files))
                $files[$i] = array();
            $files[$i][$k] = $v;
        }
    }

    // now we can loop through $files, and feed each element to the class
    foreach ($files as $file) {

        // we instanciate the class for each element of $file
        $handle = new Upload($file);

        // then we check if the file has been uploaded properly
        // in its *temporary* location in the server (often, it is /tmp)
        if ($handle->uploaded) {

            // now, we start the upload 'process'. That is, to copy the uploaded file
            // from its temporary location to the wanted location
            // It could be something like $handle->process('/home/www/my_uploads/');
            $handle->process($dir_dest);

            // we check if everything went OK
            if ($handle->processed) {
                // everything was fine !
                echo '<p class="result">';
                echo '  <b>File uploaded with success</b><br />';
                echo '  File: <a href="'.$dir_pics.'/' . $handle->file_dst_name . '">' . $handle->file_dst_name . '</a>';
                echo '   (' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB)';
                echo '</p>';
            } else {
                // one error occured
                echo '<p class="result">';
                echo '  <b>File not uploaded to the wanted location</b><br />';
                echo '  Error: ' . $handle->error . '';
                echo '</p>';
            }

        } else {
            // if we're here, the upload file failed for some reasons
            // i.e. the server didn't receive the file
            echo '<p class="result">';
            echo '  <b>File not uploaded on the server</b><br />';
            echo '  Error: ' . $handle->error . '';
            echo '</p>';
        }

        $log .= $handle->log . '<br />';
    }

} else if ($action == 'local' || isset($_GET['file'])) {

    // ---------- LOCAL PROCESSING ----------


    //error_reporting(E_ALL ^ (E_NOTICE | E_USER_NOTICE | E_WARNING | E_USER_WARNING));
    @ini_set("max_execution_time",0);

    // we don't upload, we just send a local filename (image)
    $handle = new Upload((isset($_POST['my_field']) ? $_POST['my_field'] : (isset($_GET['file']) ? $_GET['file'] : '')));

    // then we check if the file has been "uploaded" properly
    // in our case, it means if the file is present on the local file system
    if ($handle->uploaded) {

        // now, we start a serie of processes, with different parameters
        // we use a little function TestProcess() to avoid repeting the same code too many times
        function TestProcess(&$handle, $title = 'test', $details='') {
            global $dir_pics, $dir_dest;

            $handle->process($dir_dest);

            if ($handle->processed) {
                echo '<fieldset class="classuploadphp">';
                echo '  <legend>' . $title . '</legend>';
                echo '  <div class="classuploadphppic"><img src="'.$dir_pics.'/' . $handle->file_dst_name . '" />';
                $info = getimagesize($handle->file_dst_pathname);
                echo '  <p>' . $info['mime'] . ' &nbsp;-&nbsp; ' . $info[0] . ' x ' . $info[1] .' &nbsp;-&nbsp; ' . round(filesize($handle->file_dst_pathname)/256)/4 . 'KB</p></div>';
                if ($details) echo '  <pre class="code php">' . htmlentities($details) . '</pre>';
                echo '</fieldset>';
            } else {
                echo '<fieldset class="classuploadphp">';
                echo '  <legend>' . $title . '</legend>';
                echo '  Error: ' . $handle->error . '';
                if ($details) echo '  <pre class="code php">' . htmlentities($details) . '</pre>';
                echo '</fieldset>';
            }
        }
        if (!file_exists($dir_dest)) mkdir($dir_dest);

        // -----------
        TestProcess($handle, 'original file', '');

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_y         = true;
        $handle->image_x               = 50;
        TestProcess($handle, 'width 50, height auto', "\$foo->image_resize          = true;\n\$foo->image_ratio_y         = true;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_x         = true;
        $handle->image_y               = 50;
        TestProcess($handle, 'height 50, width auto', "\$foo->image_resize          = true;\n\$foo->image_ratio_x         = true;\n\$foo->image_y               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        TestProcess($handle, 'height 50, width 50', "\$foo->image_resize          = true;\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio           = true;
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        TestProcess($handle, 'height 50, width 50, keeping ratio', "\$foo->image_resize          = true;\n\$foo->image_ratio           = true;\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_crop      = true;
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        TestProcess($handle, '50x50, keeping ratio, cropping excedent', "\$foo->image_resize          = true;\n\$foo->image_ratio_crop      = true;\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_crop      = 'L';
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        TestProcess($handle, '50x50, keeping ratio, cropping right excedent', "\$foo->image_resize          = true;\n\$foo->image_ratio_crop      = 'L';\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_crop      = 'R';
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        TestProcess($handle, '50x50, keeping ratio, cropping left excedent', "\$foo->image_resize          = true;\n\$foo->image_ratio_crop      = 'R';\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_fill      = true;
        $handle->image_y               = 50;
        $handle->image_x               = 150;
        TestProcess($handle, '150x50, keeping ratio, filling in', "\$foo->image_resize          = true;\n\$foo->image_ratio_fill      = true;\n\$foo->image_y               = 50;\n\$foo->image_x               = 150;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_fill      = 'L';
        $handle->image_y               = 50;
        $handle->image_x               = 150;
        TestProcess($handle, '150x50, keeping ratio, filling left side', "\$foo->image_resize          = true;\n\$foo->image_ratio_fill      = 'L';\n\$foo->image_y               = 50;\n\$foo->image_x               = 150;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_fill      = 'R';
        $handle->image_y               = 150;
        $handle->image_x               = 100;
        $handle->image_background_color = '#FF00FF';
        TestProcess($handle, '100x150, keeping ratio, filling top and bottom', "\$foo->image_resize          = true;\n\$foo->image_ratio_fill      = 'R';\n\$foo->image_y               = 150;\n\$foo->image_x               = 100;\n\$foo->image_background_color = '#FF00FF';");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_crop      = true;
        $handle->image_y               = 50;
        $handle->image_x               = 50;
        $handle->image_crop            = '0 10';
        TestProcess($handle, 'height 50, width 50, cropped, using ratio_crop', "\$foo->image_resize          = true;\n\$foo->image_ratio_crop      = true;\n\$foo->image_crop            = '0 10';\n\$foo->image_y               = 50;\n\$foo->image_x               = 50;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_pixels    = 25000;
        TestProcess($handle, 'calculates x and y, targeting 25000 pixels', "\$foo->image_resize          = true;\n\$foo->image_ratio_pixels    = 25000;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_pixels    = 10000;
        TestProcess($handle, 'calculates x and y, targeting 10000 pixels', "\$foo->image_resize          = true;\n\$foo->image_ratio_pixels    = 10000;");

        // -----------
        $handle->image_crop            = '20%';
        TestProcess($handle, '20% crop', "\$foo->image_crop            = '20%';");

        // -----------
        $handle->image_crop            = '5 20%';
        TestProcess($handle, '5px vertical and 20% horizontal crop', "\$foo->image_crop            = '5 20%';");

        // -----------
        $handle->image_crop            = '-3px -10%';
        $handle->image_background_color = '#FF00FF';
        TestProcess($handle, 'negative crop with a background color', "\$foo->image_crop            = '-3px -10%';\n\$foo->image_background_color = '#FF00FF';");

        // -----------
        $handle->image_crop            = '5 40 10% -20';
        TestProcess($handle, '5px top, 40px right, 10% bot. and -20px left crop', "\$foo->image_crop            = '5 40 10% -20';");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_y         = true;
        $handle->image_x               = 150;
        $handle->image_precrop         = 15;
        TestProcess($handle, '15px pre-cropping (before resizing 150 wide)', "\$foo->image_resize          = true;\n\$foo->image_ratio_y         = true;\n\$foo->image_x               = 150;\n\$foo->image_precrop         = 15;");

        // -----------
        $handle->image_resize          = true;
        $handle->image_ratio_y         = true;
        $handle->image_x               = 150;
        $handle->image_precrop         = '25 70 10% -20';
        TestProcess($handle, 'diverse pre-cropping (before resizing 150 wide)', "\$foo->image_resize          = true;\n\$foo->image_ratio_y         = true;\n\$foo->image_x               = 150;\n\$foo->image_precrop         = '25 70 10% -20';");

        // -----------
        $handle->image_rotate          = '90';
        TestProcess($handle, '90 degrees rotation', "\$foo->image_rotate          = '90';");

        // -----------
        $handle->image_rotate          = '180';
        TestProcess($handle, '180 degrees rotation', "\$foo->image_rotate          = '180';");

        // -----------
        $handle->image_convert         = 'webp';
        $handle->image_flip            = 'H';
        TestProcess($handle, 'horizontal flip, into WEBP file', "\$foo->image_convert         = 'webp';\n\$foo->image_flip            = 'H';");

        // -----------
        $handle->image_convert         = 'gif';
        $handle->image_flip            = 'V';
        TestProcess($handle, 'vertical flip, into GIF file', "\$foo->image_convert         = 'gif';\n\$foo->image_flip            = 'V';");

        // -----------
        $handle->image_convert         = 'bmp';
        $handle->image_default_color   = '#00FF00';
        $handle->image_rotate          = '180';
        TestProcess($handle, '180 degrees rotation, into BMP, green bg', "\$foo->image_convert         = 'bmp';\n\$foo->image_default_color   = '#00FF00';\n\$foo->image_rotate          = '180';");

        // -----------
        $handle->image_convert         = 'png';
        $handle->image_flip            = 'H';
        $handle->image_rotate          = '90';
        TestProcess($handle, '90 degrees rotation and horizontal flip, into PNG', "\$foo->image_convert         = 'png';\n\$foo->image_flip            = 'H';\n\$foo->image_rotate          = '90';");

        // -----------
        $handle->image_bevel           = 20;
        $handle->image_bevel_color1    = '#FFFFFF';
        $handle->image_bevel_color2    = '#000000';
        TestProcess($handle, '20px black and white bevel', "\$foo->image_bevel           = 20;\n\$foo->image_bevel_color1    = '#FFFFFF';\n\$foo->image_bevel_color2    = '#000000';");

        // -----------
        $handle->image_bevel           = 5;
        $handle->image_bevel_color1    = '#FFFFFF';
        $handle->image_bevel_color2    = '#FFFFFF';
        TestProcess($handle, '5px white bevel (smooth border)', "\$foo->image_bevel           = 5;\n\$foo->image_bevel_color1    = '#FFFFFF';\n\$foo->image_bevel_color2    = '#FFFFFF';");

        // -----------
        $handle->image_border          = 5;
        $handle->image_border_color    = '#FF0000';
        TestProcess($handle, '5px red border', "\$foo->image_border          = 5;\n\$foo->image_border_color    = '#FF0000';");

        // -----------
        $handle->image_border          = 5;
        $handle->image_border_color    = '#00FF00';
        $handle->image_border_opacity  = 50;
        TestProcess($handle, '5px green semi-transparent border', "\$foo->image_border          = 5;\n\$foo->image_border_color    = '#00FF00';\n\$foo->image_border_opacity  = 50;");

        // -----------
        $handle->image_border          = '5 20 1 25%';
        $handle->image_border_color    = '#0000FF';
        TestProcess($handle, '5px top, 20px right, 1px bot. and 25% left blue border', "\$foo->image_border          = '5 20 1 25%';\n\$foo->image_border_color    = '#0000FF';");

        // -----------
        $handle->image_frame           = 1;
        $handle->image_frame_colors    = '#FF0000 #FFFFFF #FFFFFF #0000FF';
        TestProcess($handle, 'flat colored frame, 4 px wide', "\$foo->image_frame           = 1;\n\$foo->image_frame_colors    = '#FF0000 #FFFFFF\n                               #FFFFFF #0000FF';");

        // -----------
        $handle->image_frame           = 2;
        $handle->image_frame_colors    = '#FFFFFF #BBBBBB #999999 #FF0000 #666666 #333333 #000000';
        TestProcess($handle, 'crossed colored frame, 7 px wide', "\$foo->image_frame           = 2;\n\$foo->image_frame_colors    = '#FFFFFF #BBBBBB\n                               #999999 #FF0000\n                               #666666 #333333\n                               #000000';");

        // -----------
        $handle->image_frame           = 1;
        $handle->image_frame_colors    = '#FF0000 #FF00FF #0000FF #000000';
        $handle->image_frame_opacity   = 25;
        TestProcess($handle, 'flat colored frame, 4 px wide, 25% opacity', "\$foo->image_frame           = 1;\n\$foo->image_frame_colors    = '#FF0000 #FF00FF\n                               #0000FF #000000';\n\$foo->image_frame_opacity   = 25;");

        // -----------
        $handle->image_border_transparent = 10;
        TestProcess($handle, '10px fade-to-transparent border', "\$foo->image_border_transparent = 10;");

        // -----------
        $handle->image_border_transparent = '10 50 20 60';
        TestProcess($handle, 'various fade-to-transparent borders', "\$foo->image_border_transparent = '10 50 20 60';");

        // -----------
        $handle->image_border_transparent = array(0, 150, 0, 0);
        TestProcess($handle, 'right fading-out to transparency mask', "\$foo->image_border_transparent = array(0, 150, 0, 0);");

        // -----------
        $handle->image_overlay_color   = '#FFFFFF';
        $handle->image_overlay_opacity = 50;
        $handle->image_rotate          = '180';
        $handle->image_tint_color      = '#FF0000';
        TestProcess($handle, 'tint and 50% overlay and 180\' rotation', "\$foo->image_overlay_color   = '#FFFFFF';\n\$foo->image_overlay_opacity = 50;\n\$foo->image_rotate          = '180';\n\$foo->image_tint_color      = '#FF0000';");

        // -----------
        $handle->image_tint_color      = '#FF0000';
        TestProcess($handle, '#FF0000 tint', "\$foo->image_tint_color      = '#FF0000';");

        // -----------
        $handle->image_overlay_color   = '#FF0000';
        $handle->image_overlay_opacity = 50;
        TestProcess($handle, '50% overlay #FF0000', "\$foo->image_overlay_color   = '#FF0000';\n\$foo->image_overlay_opacity = 50;");

        // -----------
        $handle->image_overlay_color   = '#0000FF';
        $handle->image_overlay_opacity = 5;
        TestProcess($handle, '5% overlay #0000FF', "\$foo->image_overlay_color   = '#0000FF';\n\$foo->image_overlay_opacity = 5;");

        // -----------
        $handle->image_overlay_color   = '#FFFFFF';
        $handle->image_overlay_opacity = 90;
        TestProcess($handle, '90% overlay #FFFFFF', "\$foo->image_overlay_color   = '#FFFFFF';\n\$foo->image_overlay_opacity = 90;");

        // -----------
        $handle->image_brightness      = 25;
        TestProcess($handle, 'brightness 25', "\$foo->image_brightness      = 25;");

        // -----------
        $handle->image_brightness      = -25;
        TestProcess($handle, 'brightness -25', "\$foo->image_brightness      = -25;");

        // -----------
        $handle->image_contrast        = 75;
        TestProcess($handle, 'contrast 75', "\$foo->image_contrast        = 75;");

        // -----------
        $handle->image_opacity         = 75;
        TestProcess($handle, 'opacity 75', "\$foo->image_opacity         = 75;");

        // -----------
        $handle->image_opacity         = 25;
        TestProcess($handle, 'opacity 25', "\$foo->image_opacity         = 25;");

        // -----------
        $handle->image_threshold       = 20;
        TestProcess($handle, 'threshold filter', "\$foo->image_threshold       = 20;");

        // -----------
        $handle->image_greyscale       = true;
        TestProcess($handle, 'greyscale', "\$foo->image_greyscale       = true;");

        // -----------
        $handle->image_negative        = true;
        TestProcess($handle, 'negative', "\$foo->image_negative        = true;");

        // -----------
        TestProcess($handle, 'original file, again', '');

        // -----------
        $handle->image_pixelate        = 3;
        TestProcess($handle, 'pixelate, 3px block size', "\$foo->image_pixelate        = 3;");

        // -----------
        $handle->image_pixelate        = 10;
        TestProcess($handle, 'pixelate, 10px block size', "\$foo->image_pixelate        = 10;");

        // -----------
        $handle->image_unsharp         = true;
        TestProcess($handle, 'unsharp mask, default values', "\$foo->image_unsharp         = true;");

        // -----------
        $handle->image_unsharp         = true;
        $handle->image_unsharp_amount  = 200;
        $handle->image_unsharp_radius  = 1;
        $handle->image_unsharp_threshold = 5;
        TestProcess($handle, 'unsharp mask, different values', "\$foo->image_unsharp         = true;\n\$foo->image_unsharp_amount  = 200;\n\$foo->image_unsharp_radius  = 1;\n\$foo->image_unsharp_threshold = 5;");

        // -----------
        $handle->image_brightness      = 75;
        $handle->image_resize          = true;
        $handle->image_y               = 200;
        $handle->image_x               = 100;
        $handle->image_rotate          = '90';
        $handle->image_overlay_color   = '#FF0000';
        $handle->image_overlay_opacity = 50;
        $handle->image_text            = 'verot.net';
        $handle->image_text_color      = '#0000FF';
        $handle->image_text_background = '#FFFFFF';
        $handle->image_text_position   = 'BL';
        $handle->image_text_padding_x  = 10;
        $handle->image_text_padding_y  = 2;
        TestProcess($handle, 'brightness, resize, rotation, overlay &amp; label', "\$foo->image_brightness      = 75;\n\$foo->image_resize          = true;\n\$foo->image_y               = 200;\n\$foo->image_x               = 100;\n\$foo->image_rotate          = '90';\n\$foo->image_overlay_color   = '#FF0000';\n\$foo->image_overlay_opacity = 50;\n\$foo->image_text            = 'verot.net';\n\$foo->image_text_color      = '#0000FF';\n\$foo->image_text_background = '#FFFFFF';\n\$foo->image_text_position   = 'BL';\n\$foo->image_text_padding_x  = 10;\n\$foo->image_text_padding_y  = 2;");

        // -----------
        $handle->image_text            = 'verot.net';
        $handle->image_text_color      = '#000000';
        $handle->image_text_opacity    = 80;
        $handle->image_text_background = '#FFFFFF';
        $handle->image_text_background_opacity  = 70;
        $handle->image_text_font       = 5;
        $handle->image_text_padding    = 20;
        TestProcess($handle, 'overlayed transparent label', "\$foo->image_text            = 'verot.net';\n\$foo->image_text_color      = '#000000';\n\$foo->image_text_opacity    = 80;\n\$foo->image_text_background = '#FFFFFF';\n\$foo->image_text_background_opacity = 70;\n\$foo->image_text_font       = 5;\n\$foo->image_text_padding    = 20;");

        // -----------
        $handle->image_text            = 'verot.net';
        $handle->image_text_direction  = 'v';
        $handle->image_text_background = '#000000';
        $handle->image_text_font       = 2;
        $handle->image_text_position   = 'BL';
        $handle->image_text_padding_x  = 2;
        $handle->image_text_padding_y  = 8;
        TestProcess($handle, 'overlayed vertical plain label bottom left', "\$foo->image_text            = 'verot.net';\n\$foo->image_text_direction  = 'v';\n\$foo->image_text_background = '#000000';\n\$foo->image_text_font       = 2;\n\$foo->image_text_position   = 'BL';\n\$foo->image_text_padding_x  = 2;\n\$foo->image_text_padding_y  = 8;");

        // -----------
        $handle->image_convert         = 'bmp';
        $handle->image_text            = 'verot.net';
        $handle->image_text_direction  = 'v';
        $handle->image_text_color      = '#FFFFFF';
        $handle->image_text_background = '#000000';
        $handle->image_text_background_opacity = 50;
        $handle->image_text_padding    = 5;
        TestProcess($handle, 'overlayed vertical label, into BMP', "\$foo->image_convert         = 'bmp';\n\$foo->image_text            = 'verot.net';\n\$foo->image_text_direction  = 'v';\n\$foo->image_text_color      = '#FFFFFF';\n\$foo->image_text_background = '#000000';\n\$foo->image_text_background_opacity = 50;\n\$foo->image_text_padding    = 5;");

        // -----------
        $handle->image_text            = 'verot.net';
        $handle->image_text_opacity    = 50;
        $handle->image_text_background  = '#0000FF';
        $handle->image_text_x          = -5;
        $handle->image_text_y          = -5;
        $handle->image_text_padding    = 5;
        TestProcess($handle, 'overlayed label with absolute negative position', "\$foo->image_text            = 'verot.net';\n\$foo->image_text_opacity    = 50;\n\$foo->image_text_background  = '#0000FF';\n\$foo->image_text_x          = -5;\n\$foo->image_text_y          = -5;\n\$foo->image_text_padding    = 5;");

        // -----------
        $handle->image_text            = 'verot.net';
        $handle->image_text_background = '#0000FF';
        $handle->image_text_background_opacity = 25;
        $handle->image_text_x          = 5;
        $handle->image_text_y          = 5;
        $handle->image_text_padding    = 20;
        TestProcess($handle, 'overlayed transparent label with absolute position', "\$foo->image_text            = 'verot.net';\n\$foo->image_text_background = '#0000FF';\n\$foo->image_text_background_opacity = 25;\n\$foo->image_text_x          = 5;\n\$foo->image_text_y          = 5;\n\$foo->image_text_padding    = 20;");

        // -----------
        $handle->image_text    = "verot.net\nclass\nupload";
        $handle->image_text_background = '#000000';
        $handle->image_text_background_opacity = 75;
        $handle->image_text_font       = 1;
        $handle->image_text_padding    = 10;
        TestProcess($handle, 'text label with multiple lines and small font', "\$foo->image_text            = \"verot.net\\nclass\\nupload\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_background_opacity = 75;\n\$foo->image_text_font       = 1;\n\$foo->image_text_padding    = 10;");

        // -----------
        $handle->image_text    = "verot.net\nclass\nupload";
        $handle->image_text_color      = '#000000';
        $handle->image_text_background = '#FFFFFF';
        $handle->image_text_background_opacity = 60;
        $handle->image_text_padding    = 3;
        $handle->image_text_font       = 3;
        $handle->image_text_alignment  = 'R';
        $handle->image_text_direction  = 'V';
        TestProcess($handle, 'vertical multi-lines text, right aligned', "\$foo->image_text            = \"verot.net\\nclass\\nupload\";\n\$foo->image_text_color      = '#000000';\n\$foo->image_text_background = '#FFFFFF';\n\$foo->image_text_background_opacity = 60;\n\$foo->image_text_padding    = 3;\n\$foo->image_text_font       = 3;\n\$foo->image_text_alignment  = 'R';\n\$foo->image_text_direction  = 'V';");

        // -----------
        $handle->image_text    = "verot.net\nclass\nupload";
        $handle->image_text_background = '#000000';
        $handle->image_text_background_opacity = 50;
        $handle->image_text_padding    = 10;
        $handle->image_text_x          = -5;
        $handle->image_text_y          = -5;
        $handle->image_text_line_spacing = 10;
        TestProcess($handle, 'text label with 10 pixels of line spacing', "\$foo->image_text            = \"verot.net\\nclass\\nupload\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_background_opacity = 50;\n\$foo->image_text_padding    = 10;\n\$foo->image_text_x          = -5;\n\$foo->image_text_y          = -5;\n\$foo->image_text_line_spacing = 10;");

        // -----------
        $handle->image_unsharp         = true;
        $handle->image_border          = '0 0 16 0';
        $handle->image_border_color    = '#000000';
        $handle->image_text            = 'verot.net';
        $handle->image_text_font       = 2;
        $handle->image_text_position   = 'B';
        $handle->image_text_padding_y  = 2;
        TestProcess($handle, 'text label in a black line, plus unsharp mask', "\$foo->image_unsharp         = true;\n\$foo->image_border          = '0 0 16 0';\n\$foo->image_border_color    = '#000000';\n\$foo->image_text            = \"verot.net\";\n\$foo->image_text_font       = 2;\n\$foo->image_text_position   = 'B';\n\$foo->image_text_padding_y  = 2;");

        // -----------
        $handle->image_crop            = '-3 -3 -30 -3';
        $handle->image_text            = '[dst_name] [dst_x]x[dst_y]';
        $handle->image_text_background = '#6666ff';
        $handle->image_text_color      = '#ffffff';
        $handle->image_background_color = '#000099';
        $handle->image_text_font       = 2;
        $handle->image_text_y          = -7;
        $handle->image_text_padding_x  = 3;
        $handle->image_text_padding_y  = 2;
        TestProcess($handle, 'using tokens in text labels', "\$foo->image_crop            = '-3 -3 -30 -3';\n\$foo->image_text            = \"[dst_name] [dst_x]x[dst_y]\";\n\$foo->image_text_background = '#6666ff';\n\$foo->image_text_color      = '#ffffff';\n\$foo->image_background_color= '#000099';\n\$foo->image_text_font       = 2;\n\$foo->image_text_y          = -7;\n\$foo->image_text_padding_x  = 3;\n\$foo->image_text_padding_y  = 2;");

        // -----------
        $handle->image_crop            = '-15 -15 -240 -15';
        $handle->image_text            = "token          value\n-------------  ------------------\nsrc_name       [src_name]\nsrc_name_body  [src_name_body]\nsrc_name_ext   [src_name_ext]\nsrc_pathname   [src_pathname]\nsrc_mime       [src_mime]\nsrc_type       [src_type]\nsrc_bits       [src_bits]\nsrc_pixels     [src_pixels]\nsrc_size       [src_size]\nsrc_size_kb    [src_size_kb]\nsrc_size_mb    [src_size_mb]\nsrc_size_human [src_size_human]\nsrc_x          [src_x]\nsrc_y          [src_y]\ndst_path       [dst_path]\ndst_name_body  [dst_name_body]\ndst_name_ext   [dst_name_ext]\ndst_name       [dst_name]\ndst_pathname   [dst_pathname]\ndst_x          [dst_x]\ndst_y          [dst_y]\ndate           [date]\ntime           [time]\nhost           [host]\nserver         [server]\nip             [ip]\ngd_version     [gd_version]";
        $handle->image_text_alignment  = 'L';
        $handle->image_text_font       = 1;
        $handle->image_text_position   = 'B';
        $handle->image_text_padding_y  = 5;
        $handle->image_text_color      = '#000000';
        TestProcess($handle, 'all the tokens available', "\$foo->image_crop            = '-15 -15 -240 -15';\n\$foo->image_text            = \n   \"token          value\\n\n    -------------  ------------------\\n\n    src_name       [src_name]\\n\n    src_name_body  [src_name_body]\\n\n    src_name_ext   [src_name_ext]\\n\n    src_pathname   [src_pathname]\\n\n    src_mime       [src_mime]\\n\n    src_type       [src_type]\\n\n    src_bits       [src_bits]\\n\n    src_pixels     [src_pixels]\\n\n    src_size       [src_size]\\n\n    src_size_kb    [src_size_kb]\\n\n    src_size_mb    [src_size_mb]\\n\n    src_size_human [src_size_human]\\n\n    src_x          [src_x]\\n\n    src_y          [src_y]\\n\n    dst_path       [dst_path]\\n\n    dst_name_body  [dst_name_body]\\n\n    dst_name_ext   [dst_name_ext]\\n\n    dst_name       [dst_name]\\n\n    dst_pathname   [dst_pathname]\\n\n    dst_x          [dst_x]\\n\n    dst_y          [dst_y]\\n\n    date           [date]\\n\n    time           [time]\\n\n    host           [host]\\n\n    server         [server]\\n\n    ip             [ip]\\n\n    gd_version     [gd_version]\";\n\$foo->image_text_alignment  = 'L';\n\$foo->image_text_font       = 1;\n\$foo->image_text_position   = 'B';\n\$foo->image_text_padding_y  = 5;\n\$foo->image_text_color      = '#000000';");

        // -----------
        $handle->image_text    = "verot.net\nclass\nupload";
        $handle->image_text_background  = '#000000';
        $handle->image_text_padding     = 10;
        $handle->image_text_font        = "./foo.gdf";
        $handle->image_text_line_spacing = 2;
        TestProcess($handle, 'text label with external GDF font', "\$foo->image_text            = \"verot.net\\nclass\\nupload\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_padding    = 10;\n\$foo->image_text_font       = \"./foo.gdf\";\n\$foo->image_text_line_spacing = 2;");

        // -----------
        $handle->image_text            = "PHP";
        $handle->image_text_color      = '#FFFF00';
        $handle->image_text_background = '#FF0000';
        $handle->image_text_padding    = 10;
        $handle->image_text_font       = "./foo.gdf";
        TestProcess($handle, 'text label with external GDF font', "\$foo->image_text            = 'PHP';\n\$foo->image_text_color      = '#FFFF00';\n\$foo->image_text_background = '#FF0000';\n\$foo->image_text_padding    = 10;\n\$foo->image_text_font       = \"./foo.gdf\";");

        // -----------
        $handle->image_text            = "àzértyuïôp";
        $handle->image_text_background = '#000000';
        $handle->image_text_padding    = 10;
        $handle->image_text_font       = "./foo.ttf";
        TestProcess($handle, 'UTF-8 text label with external TTF font', "\$foo->image_text            = \"àzértyuïôp\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_padding    = 10;\n\$foo->image_text_font       = \"./foo.ttf\";");

        // -----------
        $handle->image_text    = "άλφα\nβήτα";
        $handle->image_text_color      = '#0033CC';
        $handle->image_text_size       = 28;
        $handle->image_text_font       = "./foo.ttf";
        $handle->image_overlay_color   = '#FFFFFF';
        $handle->image_overlay_opacity = 75;
        TestProcess($handle, 'UTF-8 text label with external TTF font', "\$foo->image_text            = \"άλφα\\nβήτα\";\n\$foo->image_text_color      = '#0033CC';\n\$foo->image_text_size       = 28;\n\$foo->image_text_font       = \"./foo.ttf\";\n\$foo->image_overlay_color   = '#FFFFFF';\n\$foo->image_overlay_opacity = 75;");

        // -----------
        $handle->image_text            = "люблю";
        $handle->image_text_background = '#000000';
        $handle->image_text_padding    = 10;
        $handle->image_text_size       = 20;
        $handle->image_text_angle      = 20;
        $handle->image_text_font       = "./foo.ttf";
        TestProcess($handle, 'UTF-8 text label with external TTF font', "\$foo->image_text            = \"люблю\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_size       = 20;\n\$foo->image_text_angle      = 20;\n\$foo->image_text_padding    = 10;\n\$foo->image_text_font       = \"./foo.ttf\";");

        // -----------
        $handle->image_reflection_height = '40px';
        TestProcess($handle, '40px reflection', "\$foo->image_reflection_height = '40px';");

        // -----------
        $handle->image_reflection_height = '50%';
        $handle->image_text    = "verot.net\nclass\nupload";
        $handle->image_text_background = '#000000';
        $handle->image_text_padding    = 10;
        $handle->image_text_line_spacing = 10;
        TestProcess($handle, 'text label and 50% reflection', "\$foo->image_text            = \"verot.net\\nclass\\nupload\";\n\$foo->image_text_background = '#000000';\n\$foo->image_text_padding    = 10;\n\$foo->image_text_line_spacing = 10;\n\$foo->image_reflection_height = '50%';");

        // -----------
        $handle->image_convert         = 'jpg';
        $handle->image_reflection_height = '40px';
        $handle->image_reflection_space = 10;
        TestProcess($handle, '40px reflection and 10 pixels space, into JPEG', "\$foo->image_convert         = 'jpg';\n\$foo->image_reflection_height = '40px';\n\$foo->image_reflection_space = 10;");

        // -----------
        $handle->image_reflection_height = 60;
        $handle->image_reflection_space = -40;
        TestProcess($handle, '60px reflection and -40 pixels space', "\$foo->image_reflection_height = 60;\n\$foo->image_reflection_space = -40;");

        // -----------
        $handle->image_reflection_height = 50;
        $handle->image_reflection_opacity = 100;
        TestProcess($handle, '50px reflection and 100% opacity', "\$foo->image_reflection_height = 50;\n\$foo->image_reflection_opacity = 100;");

        // -----------
        $handle->image_reflection_height = 50;
        $handle->image_reflection_opacity = 20;
        TestProcess($handle, '50px reflection and 20% opacity', "\$foo->image_reflection_height = 50;\n\$foo->image_reflection_opacity = 20;");

        // -----------
        $handle->image_reflection_height = '50%';
        $handle->image_default_color = '#000000';
        TestProcess($handle, '50% reflection, black background', "\$foo->image_reflection_height = '50%';\n\$foo->image_default_color    = '#000000';");

        // -----------
        $handle->image_convert         = 'gif';
        $handle->image_reflection_height = '50%';
        $handle->image_default_color = '#FF00FF';
        TestProcess($handle, '50% reflection, pink background, into GIF', "\$foo->image_convert         = 'gif';\n\$foo->image_reflection_height = '50%';\n\$foo->image_default_color    = '#000000';");

        // -----------
        $handle->image_watermark       = "watermark.png";
        TestProcess($handle, 'overlayed watermark (alpha transparent PNG)', "\$foo->image_watermark       = 'watermark.png';");

        // -----------
        $handle->image_watermark       = "watermark.png";
        $handle->image_watermark_position = 'R';
        TestProcess($handle, 'overlayed watermark, right position', "\$foo->image_watermark       = 'watermark.png';\n\$foo->image_watermark_position = 'R;");

        // -----------
        $handle->image_watermark       = "watermark.png";
        $handle->image_watermark_x     = 10;
        $handle->image_watermark_y     = 10;
        $handle->image_greyscale       = true;
        TestProcess($handle, 'watermark on greyscale pic, absolute position', "\$foo->image_watermark       = 'watermark.png';\n\$foo->image_watermark_x     = 10;\n\$foo->image_watermark_y     = 10;\n\$foo->image_greyscale       = true;");

        // -----------
        $handle->image_watermark       = "watermark.png";
        $handle->image_watermark_no_zoom_in = false;
        TestProcess($handle, 'watermark, automatic up-resizing activated', "\$foo->image_watermark       = 'watermark.png';\n\$foo->image_watermark_no_zoom_in = false;");

        // -----------
        $handle->image_watermark       = "watermark_large.png";
        TestProcess($handle, 'large watermark automatically reduced (default)', "\$foo->image_watermark       = 'watermark_large.png';");

        // -----------
        $handle->image_watermark       = "watermark_large.png";
        $handle->image_watermark_no_zoom_out = true;
        TestProcess($handle, 'large watermark, automatic down-resizing deactivated', "\$foo->image_watermark       = 'watermark_large.png';\n\$foo->image_watermark_no_zoom_out = true;");

        // -----------
        $handle->image_watermark       = "watermark_large.png";
        $handle->image_watermark_no_zoom_out = true;
        $handle->image_watermark_position = 'TL';
        TestProcess($handle, 'large watermark, down-resizing deactivated, position top-left', "\$foo->image_watermark       = 'watermark_large.png';\n\$foo->image_watermark_no_zoom_out = true;\n\$foo->image_watermark_position = 'TL'");

        // -----------
        $handle->image_watermark       = "watermark_large.png";
        $handle->image_watermark_x     = 20;
        $handle->image_watermark_y     = -20;
        TestProcess($handle, 'large watermark automatically reduced, position 20 -20', "\$foo->image_watermark       = 'watermark_large.png';\n\$foo->image_watermark_x     = 20;\n\$foo->image_watermark_y     = -20;");

        // -----------
        $handle->image_convert         = 'jpg';
        $handle->jpeg_size             = 3072;
        TestProcess($handle, 'desired JPEG size set to 3KB', "\$foo->image_convert         = 'jpg';\n\$foo->jpeg_size             = 3072;");

        // -----------
        $handle->image_convert         = 'jpg';
        $handle->jpeg_quality          = 10;
        TestProcess($handle, 'JPG quality set to 10%', "\$foo->image_convert         = 'jpg';\n\$foo->jpeg_quality          = 10;");

        // -----------
        $handle->image_convert         = 'jpg';
        $handle->jpeg_quality          = 80;
        TestProcess($handle, 'JPG quality set to 80%', "\$foo->image_convert         = 'jpg';\n\$foo->jpeg_quality          = 80;");

        // -----------
        $handle->image_convert         = 'png';
        $handle->png_compression       = 0;
        TestProcess($handle, 'PNG compression set to 0 (fast, large files)', "\$foo->image_convert         = 'png';\n\$foo->png_compression       = 0;");

        // -----------
        $handle->image_convert         = 'png';
        $handle->png_compression       = 9;
        TestProcess($handle, 'PNG compression set to 9 (slow, smaller files)', "\$foo->image_convert         = 'png';\n\$foo->png_compression       = 9;");

        // -----------
        $handle->image_convert         = 'webp';
        $handle->webp_quality          = 10;
        TestProcess($handle, 'WEBP quality set to 10%', "\$foo->image_convert         = 'webp';\n\$foo->webp_quality          = 10;");

        // -----------
        $handle->image_convert         = 'webp';
        $handle->webp_quality          = 80;
        TestProcess($handle, 'WEBP quality set to 80%', "\$foo->image_convert         = 'webp';\n\$foo->webp_quality          = 80;");


    } else {
        // if we are here, the local file failed for some reasons
        echo '<b>local file error</b><br />';
        echo 'Error: ' . $handle->error . '';
    }

    $log .= $handle->log . '<br />';
}

echo '<p class="result"><a href="index.html">do another test</a></p>';

if ($log) echo '<pre>' . $log . '</pre>';

?>
</body>

</html>
