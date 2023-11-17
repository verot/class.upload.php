<?php
// +------------------------------------------------------------------------+
// | class.upload.ar_EG.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) Abdelrhman Said 2022. All rights reserved.               |
// | Version       0.25                                                     |
// | Last modified 08/12/2022                                               |
// | Email         abdelrhmansaidzaki@gmail.com                             |
// | Web           http://abdelrhmansaid.me                                 |
// +------------------------------------------------------------------------+
// | This program is free software; you can redistribute it and/or modify   |
// | it under the terms of the GNU General Public License version 2 as      |
// | published by the Free Software Foundation.                             |
// |                                                                        |
// | This program is distributed in the hope that it will be useful,        |
// | but WITHOUT ANY WARRANTY; without even the implied warranty of         |
// | MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the          |
// | GNU General Public License for more details.                           |
// |                                                                        |
// | You should have received a copy of the GNU General Public License      |
// | along with this program; if not, write to the                          |
// |   Free Software Foundation, Inc., 59 Temple Place, Suite 330,          |
// |   Boston, MA 02111-1307 USA                                            |
// |                                                                        |
// | Please give credit on sites that use class.upload and submit changes   |
// | of the script so other people can use them as well.                    |
// | This script is free to use, don't abuse.                               |
// +------------------------------------------------------------------------+

/**
 * Class upload Arabic translation
 *
 * @version   0.28
 * @author    Abdelrhman Said (abdelrhmansaidzaki@gmail.com)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Abdelrhman Said
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = 'خطأ في الملف. الرجاء المحاولة مرة أخرى.';
    $translation['local_file_missing']          = 'الملف المحلي غير موجود.';
    $translation['local_file_not_readable']     = 'الملف المحلي غير قابل للقراءة.';
    $translation['uploaded_too_big_ini']        = 'خطأ في رفع الملف (الملف المرفوع أكبر من الحجم المسموح به في ملف php.ini).';
    $translation['uploaded_too_big_html']       = 'خطأ في رفع الملف (الملف المرفوع أكبر من الحجم المسموح به في ملف HTML).';
    $translation['uploaded_partial']            = 'خطأ في رفع الملف (تم رفع جزء من الملف فقط).';
    $translation['uploaded_missing']            = 'خطأ في رفع الملف (لم يتم رفع الملف).';
    $translation['uploaded_no_tmp_dir']         = 'خطأ في رفع الملف (لا يوجد مجلد مؤقت).';
    $translation['uploaded_cant_write']         = 'خطأ في رفع الملف (فشل في الكتابة على القرص).';
    $translation['uploaded_err_extension']      = 'خطأ في رفع الملف (توقف رفع الملف بسبب امتداد).';
    $translation['uploaded_unknown']            = 'خطأ في رفع الملف (رمز خطأ غير معروف).';
    $translation['try_again']                   = 'خطأ في رفع الملف. الرجاء المحاولة مرة أخرى.';
    $translation['file_too_big']                = 'الملف كبير جداً.';
    $translation['no_mime']                     = 'لا يمكن العثور على نوع MIME.';
    $translation['incorrect_file']              = 'نوع الملف غير صحيح.';
    $translation['image_too_wide']              = 'الصورة عريضة جداً.';
    $translation['image_too_narrow']            = 'الصورة ضيقة جداً.';
    $translation['image_too_high']              = 'الصورة طويلة جداً.';
    $translation['image_too_short']             = 'الصورة قصيرة جداً.';
    $translation['ratio_too_high']              = 'نسبة الصورة غير متوافقة (الصورة عريضة جداً).';
    $translation['ratio_too_low']               = 'نسبة الصورة غير متوافقة (الصورة ضيقة جداً).';
    $translation['too_many_pixels']             = 'الصورة بها عدد كبير جداً من البكسل.';
    $translation['not_enough_pixels']           = 'الصورة بها عدد قليل جداً من البكسل.';
    $translation['file_not_uploaded']           = 'الملف غير مرفوع. لا يمكن الاستمرار.';
    $translation['already_exists']              = '%s موجود مسبقاً. الرجاء تغيير الاسم.';
    $translation['temp_file_missing']           = 'الملف المؤقت غير صحيح. لا يمكن الاستمرار.';
    $translation['source_missing']              = 'الملف المرفوع غير صحيح. لا يمكن الاستمرار.';
    $translation['destination_dir']             = 'لا يمكن إنشاء مجلد الوجهة. لا يمكن الاستمرار.';
    $translation['destination_dir_missing']     = 'مجلد الوجهة غير موجود. لا يمكن الاستمرار.';
    $translation['destination_path_not_dir']    = 'مسار الوجهة ليس مجلد. لا يمكن الاستمرار.';
    $translation['destination_dir_write']       = 'لا يمكن جعل مجلد الوجهة قابل للكتابة. لا يمكن الاستمرار.';
    $translation['destination_path_write']      = 'مسار الوجهة غير قابل للكتابة. لا يمكن الاستمرار.';
    $translation['temp_file']                   = 'لا يمكن إنشاء الملف المؤقت. لا يمكن الاستمرار.';
    $translation['source_not_readable']         = 'الملف المصدر غير قابل للقراءة. لا يمكن الاستمرار.';
    $translation['no_create_support']           = 'لا يوجد دعم لإنشاء %s من المصدر.';
    $translation['create_error']                = 'خطأ في إنشاء %s صورة من المصدر.';
    $translation['source_invalid']              = 'لا يمكن قراءة صورة المصدر. ربما ليست صورة؟';
    $translation['gd_missing']                  = 'يجب تنصيب مكتبة GD لتنفيذ هذه العملية.';
    $translation['watermark_no_create_support'] = 'لا يوجد دعم لإنشاء %s من المصدر، لا يمكن قراءة العلامة المائية.';
    $translation['watermark_create_error']      = 'لا يوجد دعم لقراءة %s، لا يمكن قراءة العلامة المائية.';
    $translation['watermark_invalid']           = 'نوع الملف غير معروف، لا يمكن قراءة العلامة المائية.';
    $translation['file_create']                 = 'لا يوجد دعم لإنشاء %s.';
    $translation['no_conversion_type']          = 'نوع التحويل غير معروف.';
    $translation['copy_failed']                 = 'خطأ في نسخ الملف على الخادم. copy() فشلت.';
    $translation['reading_failed']              = 'خطأ في قراءة الملف.';
