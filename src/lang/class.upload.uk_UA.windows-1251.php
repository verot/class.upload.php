<?php
// +------------------------------------------------------------------------+
// | class.upload.uk_UA.windows-1251.php                                    |
// +------------------------------------------------------------------------+
// | Copyright (c) S.Galashyn 2009. All rights reserved.                    |
// | Version       0.25                                                     |
// | Last modified 01/04/2009                                               |
// | Email         trovich@gmail.com                                        |
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
 * Class upload Ukrainian translation
 *
 * @version   0.25
 * @author    S.Galashyn (trovich@gmail.com)
 * @codepage  windows-1251
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Free to modify
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = '�������� �������. ����-�����, ��������� �� ���.';
    $translation['local_file_missing']          = '�� ���� ������ ��������� ����.';
    $translation['local_file_not_readable']     = '�� ���� ��������� ��������� ����.';
    $translation['uploaded_too_big_ini']        = '������� ������������ ����� (����� ����� ��������� ��������� upload_max_filesize � php.ini).';
    $translation['uploaded_too_big_html']       = '������� ������������ ����� (����� ����� ��������� ��������� MAX_FILE_SIZE � �����).';
    $translation['uploaded_partial']            = '������� ������������ ����� (���� ���� ����������� ���� ��������).';
    $translation['uploaded_missing']            = '������� ������������ ����� (���� �� ���� �����������).';
    $translation['uploaded_unknown']            = '������� ������������ ����� (�������� ��� �������).';
    $translation['try_again']                   = '������� ������������ �����. ����-�����, ��������� �� ���.';
    $translation['file_too_big']                = '���� ���������.';
    $translation['no_mime']                     = '�� ���� ��������� MIME-��� �����.';
    $translation['incorrect_file']              = '���������� ��� �����.';
    $translation['image_too_wide']              = '������� ������� �������.';
    $translation['image_too_narrow']            = '������� ������� �������.';
    $translation['image_too_high']              = '������� ������� �������.';
    $translation['image_too_short']             = '������� ������� �������.';
    $translation['ratio_too_high']              = '������������ ������ �������� (������� ������� �������).';
    $translation['ratio_too_low']               = '������������ ������ ������ (������� ������� �������).';
    $translation['too_many_pixels']             = '������� �� �������� ������.';
    $translation['not_enough_pixels']           = '������� �� ������ ������.';
    $translation['file_not_uploaded']           = '���� �� �����������.';
    $translation['already_exists']              = '%s ��� ����. ����-�����, ������������ ����.';
    $translation['temp_file_missing']           = '������� ���������� ���� �������.';
    $translation['source_missing']              = '������� ������������ ���� �������.';
    $translation['destination_dir']             = '�� ���� �������� ���� �����������.';
    $translation['destination_dir_missing']     = '���� ����������� �� ����.';
    $translation['destination_path_not_dir']    = '���� ����������� �� � �����.';
    $translation['destination_dir_write']       = '�� ���� ������� ���� ����������� ��������� �� ������.';
    $translation['destination_path_write']      = '���� ����������� �� �������� ��� ������.';
    $translation['temp_file']                   = '�� ���� �������� ���������� ����.';
    $translation['source_not_readable']         = '�� ���� ��������� ���������� ����.';
    $translation['no_create_support']           = '�� ����������� ��������� � %s.';
    $translation['create_error']                = '������� ��� ������� %s � �������.';
    $translation['source_invalid']              = '�� ���� ��������� �������. �� �� �������?';
    $translation['gd_missing']                  = '��������� GD �������.';
    $translation['watermark_no_create_support'] = '�� ����������� ��������� � %s, �� ���� ��������� watermark.';
    $translation['watermark_create_error']      = '�� ����������� ������� � %s, �� ���� �������� watermark.';
    $translation['watermark_invalid']           = '�������� ������ �������, �� ���� ��������� watermark.';
    $translation['file_create']                 = '�� ����������� ��������� � %s.';
    $translation['no_conversion_type']          = '�� ������� ��� �������������.';
    $translation['copy_failed']                 = '������� ��������� ����� �� ������. ³����� copy().';
    $translation['reading_failed']              = '������� ������� �����.';