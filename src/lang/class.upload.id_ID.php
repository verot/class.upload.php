<?php
// +------------------------------------------------------------------------+
// | class.upload.id_ID.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) Irwan Butar Butar 2008. All rights reserved.             |
// | Version       0.1                                                      |
// | Last modified 07/07/2008                                               |
// | Email         irwansah.putra@gmail.com                                 |
// | Web           http://www.kupluk.com                                    |
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
 * Class upload Indonesian (Bahasa) translation.
 * Based on class.upload version 0.25
 *
 * @version   0.1 (2008-07-07)
 * @author    Irwan Butar Butar (irwansah.putra@gmail.com)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Irwan Butar Butar 2008. All rights reserved.
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = 'Berkas mengalami kerusakan. Mohon coba lagi.';
    $translation['local_file_missing']          = 'Berkas yang akan diunggah tidak ditemukan.';
    $translation['local_file_not_readable']     = 'berkas yang akan diunggah tidak dapat dibaca.';
    $translation['uploaded_too_big_ini']        = 'Pengunggahan tidak berhasil (ukuran berkas melebihi ukuran upload_max_filesize dalam php.ini).';
    $translation['uploaded_too_big_html']       = 'Pengunggahan tidak berhasil (ukuran berkas melebihi ukuran MAX_FILE_SIZE yang disebutkan dalam form di html).';
    $translation['uploaded_partial']            = 'Pengunggahan tidak berhasil (berkas yang terunggah baru sebahagian saja).';
    $translation['uploaded_missing']            = 'Pengunggahan tidak berhasil (tidak ada berkas yang berhasil terunggah).' ;
    $translation['uploaded_unknown']            = 'Pengunggahan tidak berhasil (kode kesalahan tidak dikenali).' ;
    $translation['try_again']                   = 'Pengunggahan tidak berhasil. Mohon coba lagi.';
    $translation['file_too_big']                = 'Ukuran berkas terlalu besar.';
    $translation['no_mime']                     = 'Tipe MIME tidak dapat dideteksi.';
    $translation['incorrect_file']              = 'Tipe berkas tidak sesuai.';
    $translation['image_too_wide']              = 'Ukuran gambar terlalu lebar.';
    $translation['image_too_narrow']            = 'Ukuran gambar terlalu sempit.';
    $translation['image_too_high']              = 'Ukuran gambar terlalu tinggi.';
    $translation['image_too_short']             = 'Ukuran gambar terlalu pendek.';
    $translation['ratio_too_high']              = 'Ukuran rasio gambar terlalu tinggi (ukuran gambar terlalu lebar).';
    $translation['ratio_too_low']               = 'Ukuran rasio gambar terlalu rendah (ukuran gambar terlalu tinggi).';
    $translation['too_many_pixels']             = 'Pixel pada gambar terlalu banyak.';
    $translation['not_enough_pixels']           = 'Pixel pada gambar terlalu sedikit.';
    $translation['file_not_uploaded']           = 'Berkas tidak berhasil diunggah. Tidak dapat meneruskan proses.';
    $translation['already_exists']              = 'Gambar %s sudah ada. Mohon ubah nama berkasnya.';
    $translation['temp_file_missing']           = 'Berkas sementara tidak sesuai. Tidak dapat meneruskan proses.';
    $translation['source_missing']              = 'Berkas yang diunggah tidak sesuai. Tidak dapat meneruskan proses.';
    $translation['destination_dir']             = 'Direktori tujuan tidak dapat dibuat. Tidak dapat meneruskan proses.';
    $translation['destination_dir_missing']     = 'Direktori tujuan tidak ditemukan. Tidak dapat meneruskan proses.';
    $translation['destination_path_not_dir']    = 'Tujuan pengunggahan bukan sebuah direktori. Tidak dapat meneruskan proses.';
    $translation['destination_dir_write']       = 'Direktori tujuan tidak dapat dibuat menjadi dapat ditulisi. Tidak dapat meneruskan proses.';
    $translation['destination_path_write']      = 'Direktori tujuan tidak dapat ditulisi. Tidak dapat meneruskan proses.';
    $translation['temp_file']                   = 'Tidak dapat membuat berkas sementara. Tidak dapat meneruskan proses.';
    $translation['source_not_readable']         = 'Berkas sumber tidak dapat dibaca. Tidak dapat meneruskan proses.';
    $translation['no_create_support']           = 'Tidak dapat membuat dari %s pendukung.';
    $translation['create_error']                = 'Tidak berhasil membuat gambar %s dari sumber.';
    $translation['source_invalid']              = 'Tidak dapat membaca gambar sumber. Bukan merupakan sebuah gambar?';
    $translation['gd_missing']                  = 'Librari pendukung GD tidak ditemukan.';
    $translation['watermark_no_create_support'] = 'Tidak dapat membuat %s, tidak dapat membaca watermark.';
    $translation['watermark_create_error']      = 'Tidak dapat membaca %s, tidak dapat membuat watermark.';
    $translation['watermark_invalid']           = 'Format gambar tidak dikenali, tidak dapat membaca watermark.';
    $translation['file_create']                 = 'Tidak dapat membuat %s.';
    $translation['no_conversion_type']          = 'Tipe percakapan belum didefenisikan.';
    $translation['copy_failed']                 = 'Tidak berhasil menyalin berkas di server. copy() tidak berhasil.';
    $translation['reading_failed']              = 'Tidak berhasil membaca berkas.';
