<?php
// +------------------------------------------------------------------------+
// | class.upload.sv_SE.php                                                 |
// +------------------------------------------------------------------------+
// | Copyright (c) Mikael Andersson 2007. All rights reserved.              |
// | Version       0.25                                                     |
// | Last modified 24/11/2007                                               |
// | Email         mikael@familjenmartinsson.com                            |
// | Web           http://www.familjenmartinsson.com                        |
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
 * Class upload swedish translation
 *
 * @version   0.25
 * @author    Mikael Andersson (mikael@familjenmartinsson.com)
 * @license   http://opensource.org/licenses/gpl-license.php GNU Public License
 * @copyright Mikael Andersson
 * @package   cmf
 * @subpackage external
 */

    $translation = array();
    $translation['file_error']                  = 'Fil fel. Försök igen.';
    $translation['local_file_missing']          = 'Lokal fil hittades inte.';
    $translation['local_file_not_readable']     = 'Gick inte att skriva till lokal fil.';
    $translation['uploaded_too_big_ini']        = 'Uppladdningsfel (Den uppladdade filen överskrider upload_max_filesize direktivet i php.ini).';
    $translation['uploaded_too_big_html']       = 'Uppladdningsfel (Den uppladdade filen överskrider MAX_FILE_SIZE direktivet specificerat i html formuläret).';
    $translation['uploaded_partial']            = 'Uppladdningsfel (Filen blev bara delvis uppladdad).';
    $translation['uploaded_missing']            = 'Uppladdningsfel (Ingen fil blev uppladdad).';
    $translation['uploaded_unknown']            = 'Uppladdningsfel (Okänt fel).';
    $translation['try_again']                   = 'Uppladdningsfel. Försök igen.';
    $translation['file_too_big']                = 'Filen är förstor.';
    $translation['no_mime']                     = 'MIME typen kan inte hittas.';
    $translation['incorrect_file']              = 'Inkorrekt fil typ.';
    $translation['image_too_wide']              = 'Bilden är för bred.';
    $translation['image_too_narrow']            = 'Bilden är för smal.';
    $translation['image_too_high']              = 'Bilden är för hög.';
    $translation['image_too_short']             = 'Bilden är för liten.';
    $translation['ratio_too_high']              = 'Bild förhållandet är för stort (Bilden är för bred).';
    $translation['ratio_too_low']               = 'Bild förhållandet är för litet (Bilden är för hög).';
    $translation['too_many_pixels']             = 'Bilden har för många pixlar.';
    $translation['not_enough_pixels']           = 'Bilden har inte tillräckligt med pixlar.';
    $translation['file_not_uploaded']           = 'Bilden är inte uppladdad kan inte fortsätta förloppet.';
    $translation['already_exists']              = '%s finns redan. Ändra filnamnet.';
    $translation['temp_file_missing']           = 'Fel temporär kälfil. Kan inte fortsätta förloppet.';
    $translation['source_missing']              = 'Fel uppladdad temporär kälfil. Kan inte fortsätta förloppet.';
    $translation['destination_dir']             = 'Mål katalogen kan inte skapas. Kan inte fortsätta förloppet.';
    $translation['destination_dir_missing']     = 'Mål katalogen finns inte. Kan inte fortsätta förloppet.';
    $translation['destination_dir_write']       = 'Mål katalogen kan inte göras skrivbar. Kan inte fortsätta förloppet.';
    $translation['destination_path_write']      = 'Mål katalogen är inte skrivbar. Kan inte fortsätta förloppet.';
    $translation['temp_file']                   = 'Kan inte skapa den temporära filen. Kan inte fortsätta förloppet.';
    $translation['source_not_readable']         = 'Käll filen är inte skrivbar. Kan inte fortsätta förloppet.';
    $translation['no_create_support']           = 'Inget stöd för skapandet av %s.';
    $translation['create_error']                = 'Fel vid skapandet av %s bilden.';
    $translation['source_invalid']              = 'Kan inte läsa bilden. Är det en bild?.';
    $translation['gd_missing']                  = 'GD Biblioteket verkar inte vara installerat på servern.';
    $translation['watermark_no_create_support'] = 'Inget stöd för skapandet av %s, Kan inte läsa vattenstämpeln.';
    $translation['watermark_create_error']      = 'Inget stöd för läsandet av %s, kan inte skapa vattenstämplen.';
    $translation['watermark_invalid']           = 'Okänt bild format, kan inte läsa vattenstämplen.';
    $translation['file_create']                 = 'Inget stöd för skapandet av %s.';
    $translation['no_conversion_type']          = 'Ingen förvandlings typ bestämd.';
    $translation['copy_failed']                 = 'Fel vid kopieringen utav filen. copy() misslyckades.';
    $translation['reading_failed']              = 'Fel vid inläsningen utav filen.';   
        
?>