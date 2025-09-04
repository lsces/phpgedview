<?php
/**
 * Czech texts
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2012  PGV Development Team.  All rights reserved.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 *
 * @author PGV Developers
 * @package PhpGedView
 * @subpackage Languages
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;
$pgv_lang["add_marriage"]			= "Přidat manželství podrobnosti";
$pgv_lang["edit_concurrency_change"] = "Tento záznam byl naposledy změněn <i>#CHANGEUSER#</i> #CHANGEDATE#";
$pgv_lang["edit_concurrency_msg2"]	= "Záznam s ID #PID# byl změněn jiným uživatelem od posledního přístupu ji.";
$pgv_lang["edit_concurrency_msg1"]	= "Došlo k chybě při vytváření formuláře Upravit. Jiný uživatel může změnit tento záznam, protože jste dříve považovali jej.";
$pgv_lang["edit_concurrency_reload"]	= "Načtěte si prosím předchozí stránku, aby se ujistil, že pracujete s nejnovější záznam.";
$pgv_lang["admin_override"]			= "Možnost správce";
$pgv_lang["no_update_CHAN"]			= "Nenechte si aktualizovat CHAN (Poslední změna) záznam";
$pgv_lang["select_events"]			= "Vybrat Události";
$pgv_lang["source_events"]			= "Přidružení akce s tímto zdrojem";
$pgv_lang["advanced_name_fields"]	= "Další jména (přezdívka, jméno po svatbě, atd.)";
$pgv_lang["accept_changes"]		= "Přijmout / Odmítnout změny";
$pgv_lang["replace"]			= "Nahradit záznam";
$pgv_lang["append"]			= "Připojit záznam";
$pgv_lang["review_changes"]		= "Revize změn v GEDCOM souborech";
$pgv_lang["remove_object"]			= "Smazat objektu";
$pgv_lang["remove_links"]			= "Smazat připojení";
$pgv_lang["media_not_deleted"]		= "Adresář média nebudou odstraněny.";
$pgv_lang["thumbs_not_deleted"]		= "Adresář miniatury není odstraněna.";
$pgv_lang["thumbs_deleted"]			= "Adresář miniatury úspěšně odstraněn.";
$pgv_lang["show_thumbnail"]			= "Zobrazit miniatury";
$pgv_lang["link_media"]				= "Připojte mediální soubory do";
$pgv_lang["to_person"]				= "osoby";
$pgv_lang["to_family"]				= "rodinu";
$pgv_lang["to_source"]				= "zdroj";
$pgv_lang["to_note"]				= "sdílené poznámky";
$pgv_lang["to_repository"]			= "repozitáře";
$pgv_lang["edit_fam"]				= "Upravit rodinu";
$pgv_lang["edit_repo"]				= "Upravit repozitáře";
$pgv_lang["copy"]					= "Kopírovat";
$pgv_lang["cut"]					= "Vyjmout";
$pgv_lang["sort_by_birth"]			= "Seřadit podle data narození";
$pgv_lang["reorder_children"]		= "Přeuspořádat děti";
$pgv_lang["reorder_media"]					= "Přeuspořádat médií";
$pgv_lang["reorder_media_title"]			= "Přetáhněte miniatury změnit pořadí mediální položky";
$pgv_lang["reorder_media_window"]			= "Změna pořadí média (okno)";
$pgv_lang["reorder_media_window_title"]		= "Kliknutím na příslušný řádek, pak přetáhněte změnit pořadí média";
$pgv_lang["reorder_media_save"]				= "Uloží seřazené média do databáze";
$pgv_lang["reorder_media_reset"]			= "Obnovit původní sekvence";
$pgv_lang["reorder_media_cancel"]			= "Ukoncit a zpet";
$pgv_lang["add_from_clipboard"]		= "Přidat ze schránky";
$pgv_lang["record_copied"]			= "Záznam zkopírován do schránky";
$pgv_lang["add_unlinked_person"]	= "Přidat nespojené osobě";
$pgv_lang["add_unlinked_source"]	= "Přidat nespojené zdroj";
$pgv_lang["add_unlinked_note"]		= "Přidat nespojené poznámku";
$pgv_lang["add_unlinked"]			= "Nespojené záznamy";
$pgv_lang["server_file"]				= "Název souboru na serveru";
$pgv_lang["server_file_advice"]			= "Neměňte zachovat původní název souboru.";
$pgv_lang["server_file_advice2"]		= "Můžete zadat adresu URL, počínaje &laquo;http://&raquo;..";
$pgv_lang["server_folder_advice"]		= "Můžete zadat až #GLOBALS[MEDIA_DIRECTORY_LEVELS]# názvům adresářů sledovat výchozí &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo;. <br /> Nezadávejte &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo; část názvu cílového adresáře.";
$pgv_lang["server_folder_advice2"]		= "Tato položka je ignorováno, pokud jste zadali adresu URL do pole název souboru.";
$pgv_lang["add_linkid_advice"]			= "Zadejte nebo vyhledejte na ID osoby, rodiny, nebo zdroj, ke kterému tato položka média by měl být připojen.";
$pgv_lang["use_browse_advice"]			= "Použijte &laquo;Procházet&raquo; tlačítka hledat v místním počítači požadovaný soubor.";
$pgv_lang["add_media_other_folder"]		= "Ostatní adresář... prosím, napište";
$pgv_lang["add_media_file"]				= "Stávající média soubor na serveru";
$pgv_lang["main_media_ok1"]				= "Hlavní mediální soubor <b>#GLOBALS[oldMediaName]#</b> úspěšně přejmenován na <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["main_media_ok2"]				= "Hlavní mediální soubor <b>#GLOBALS[oldMediaName]#</b> úspěšně přesunuty z <b>#GLOBALS[oldMediaFolder]#</b> do <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["main_media_ok3"]				= "Hlavní mediální soubor úspěšně přesunuty a přejmenován z <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> do <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b>.";
$pgv_lang["main_media_fail0"]			= "Hlavní mediální soubor <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> neexistuje.";
$pgv_lang["main_media_fail1"]			= "Hlavní mediální soubor <b>#GLOBALS[oldMediaName]#</b> nemohl být přejmenován na <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["main_media_fail2"]			= "Hlavní mediální soubor <b>#GLOBALS[oldMediaName]#</b> nelze přesunout z <b>#GLOBALS[oldMediaFolder]#</b> do <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["main_media_fail3"]			= "Hlavní mediální soubor nelze přesunout, a přejmenován z <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> do <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b>.";
$pgv_lang["resn_disabled"]				= "Poznámka: Musíte povolit 'Užití GEDCOM (RESN) ochrany osobních omezení' funkci tohoto nastavení se projeví až po";
$pgv_lang["thumb_media_ok1"]			= "Miniatury soubor <b>#GLOBALS[oldMediaName]#</b> úspěšně přejmenován na <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["thumb_media_ok2"]			= "Miniatury soubor <b>#GLOBALS[oldMediaName]#</b> úspěšně přesunuty z <b>#GLOBALS[oldMediaFolder]#</b> do <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["thumb_media_ok3"]			= "Miniatury soubor úspěšně přesunuty a přejmenován z <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> do <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b>.";
$pgv_lang["thumb_media_fail0"]			= "Miniatury soubor <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> neexistuje.";
$pgv_lang["thumb_media_fail1"]			= "Miniatury soubor <b>#GLOBALS[oldMediaName]#</b> nemohl být přejmenován na <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["thumb_media_fail2"]			= "Miniatury soubor <b>#GLOBALS[oldMediaName]#</b> nelze přesunout z <b>#GLOBALS[oldMediaFolder]#</b> do <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["thumb_media_fail3"]			= "Miniatury soubor nelze přesunout, a přejmenován z <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> do <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b>.";
$pgv_lang["add_asso"]				= "Přidat nový spolupracovník";
$pgv_lang["edit_sex"]				= "Upravit Pohlaví";
$pgv_lang["add_obje"]			= "Přidat nový multimediální soubor";
$pgv_lang["add_name"]				= "Přidat nové jméno";
$pgv_lang["edit_raw"]			= "Upravit přímo záznam GEDCOM";
$pgv_lang["label_add_remote_link"]  = "Přidat spojení";
$pgv_lang["label_gedcom_id"]        = "ID databáze";
$pgv_lang["label_local_id"]         = "ID osoby";
$pgv_lang["accept"]				= "Přijmout";
$pgv_lang["accept_all"]			= "Přijmout všechny změny";
$pgv_lang["accept_gedcom"]		= "U každé změny se rozhodněte, zda ji chcete přijmout, nebo zamítnout.<br />Chcete-li přijmout všechny změny najednou, klikněte na \"Přijmout všechny změny\" v políčku dole.<br />Jestliže chcete více informací k některé úpravě, klikněte na \"Zobrazit rozdíly\" a uvidíte rozdíly mezi starou a novou verzí, <br /> nebo klikněte na \"Zobrazit přímo záznam GEDCOM\" a uvidíte novou verzi zapsanou přímo ve fromátu GEDCOM.";
$pgv_lang["accept_successful"]	= "Změny byly přijaty a nové údaje zapsány do databáze";
$pgv_lang["add_child"]			= "Přidat dítě";
$pgv_lang["add_child_to_family"]	= "Přidat dítě k této rodině";
$pgv_lang["add_fact"]			= "Přidat nový údaj";
$pgv_lang["add_father"]			= "Přidat nového otce";
$pgv_lang["add_husb"]			= "Přidat manžela";
$pgv_lang["add_opf_child"]				= "Přidat dítě vytvořit rodinu pouze s jedním rodičem";
$pgv_lang["add_husb_to_family"]		= "Přidat manžela k této rodině";
$pgv_lang["add_media"]			= "Přidat do médií novou položku";
$pgv_lang["add_media_lbl"]		= "Přidat média";
$pgv_lang["add_mother"]			= "Přidat novou matku";
$pgv_lang["add_new_chil"] 		= "Přidat novou dítě";
$pgv_lang["add_new_husb"]		= "Přidat nového manžela";
$pgv_lang["add_new_wife"]		= "Přidat novou manželku";
$pgv_lang["add_note"]			= "Přidat novou poznámku";
$pgv_lang["add_note_lbl"]		= "Přidat poznámku";
$pgv_lang["add_shared_note"]		= "Přidat nový sdílený poznámka";
$pgv_lang["add_shared_note_lbl"]	= "Přidat sdílená poznámka";
$pgv_lang["add_sibling"]		= "Přidat bratra nebo sestru";
$pgv_lang["add_son_daughter"]		= "Přidat syna nebo dceru";
$pgv_lang["add_source"]			= "Přidat nový citace zdroje";
$pgv_lang["add_source_lbl"]		= "Přidat citace zdroje";
$pgv_lang["add_wife"]			= "Přidat manželku";
$pgv_lang["add_wife_to_family"]		= "Přidat manželku k této rodině";
$pgv_lang["advanced_search_discription"] = "Rozšířené vyhledávání na webu";
$pgv_lang["auto_thumbnail"]			= "Automatické miniatury";
$pgv_lang["basic_search"]			= "hledání";
$pgv_lang["basic_search_discription"] = "Základní hledání stránek";
$pgv_lang["birthdate_search"]		= "Datum narození:";
$pgv_lang["birthplace_search"]		= "Místo narození:";
$pgv_lang["change"]					= "Změnit";
$pgv_lang["change_family_instr"]	= "Pomocí této stránky změnit nebo odebrat členy rodiny.<br /><br />Pro každého člena v rodině, můžete použít odkaz Změnit vybrat jinou osobu vyplnit tuto úlohu v rodině. Můžete také použít odkaz Odstranit odstranit tuto osobu z rodiny.<br /><br />Po dokončení změny rodinné příslušníky, klikněte na tlačítko Uložit uložte změny.<br />";
$pgv_lang["change_family_members"]	= "Změna rodinní příslušníci";
$pgv_lang["changes_occurred"]		= "U této osoby byly provedeny následující změny:";
$pgv_lang["confirm_remove"]			= "Jste si jisti, že chcete odstranit tuto osobu z rodiny?";
$pgv_lang["confirm_remove_object"]	= "Jste si jisti, že chcete odstranit tento objekt z databáze?";
$pgv_lang["create_repository"]		= "Vytvořit repozitáře";
$pgv_lang["shared_note_assisted"]	= "Sdílené Poznámka pomocí Asistent";
$pgv_lang["create_shared_note"]				= "Vytvořit novou Sdílenou Poznámka";
$pgv_lang["create_shared_note_assisted"]	= "Vytvořit novou Sdílenou Poznámka pomocí Asistent";
$pgv_lang["add_new_event_assisted"]			= "Vytvořit novou událost pomocí Asistent";
$pgv_lang["create_source"]		= "Vytvořit nový zdroj";
$pgv_lang["current_person"]         = "Stejné jako aktuální";
$pgv_lang["date"]			= "Datum";
$pgv_lang["deathdate_search"]		= "Datum úmrtí:";
$pgv_lang["deathplace_search"]		= "Místo Úmrtí :";
$pgv_lang["delete_dir_success"]		= "Média a miniatury adresáře byl úspěšně odstraněn.";
$pgv_lang["delete_file"]			= "Smazat soubor";
$pgv_lang["delete_repo"]			= "Smazat repozitáře";
$pgv_lang["directory_not_empty"]	= "Adresář není prázdný.";
$pgv_lang["directory_not_exist"]	= "Adresář neexistuje.";
$pgv_lang["error_remote"]           = "Vybrali jste vzdálené webové místo.";
$pgv_lang["error_same"]             = "Vybrali jste stejné stránky.";
$pgv_lang["external_file"]			= "Tento objekt média neexistuje jako soubor na tomto serveru. To nemůže být odstraněn, přesunut nebo přejmenován.";
$pgv_lang["file_missing"]		= "Žádný soubor dodán. Nahrajte jej znovu";
$pgv_lang["file_partial"]		= "Soubor byl nahrán jen částečně, prosím zkuste to znovu";
$pgv_lang["file_success"]		= "Soubor byl úspěšně nahrán";
$pgv_lang["file_too_big"]		= "Nahraný soubor přesáhl povolenou velikost";
$pgv_lang["file_no_temp_dir"]		= "Chybí PHP dočasného adresáře";
$pgv_lang["file_cant_write"]		= "PHP nepodařilo napsat na disku";
$pgv_lang["file_bad_extension"]		= "PHP blokován soubor potažmo";
$pgv_lang["file_unkown_err"]		= "Neznámý soubor nahrát kód chyby #pgv_lang[global_num1]#. Prosím oznamte to jako chybu.";
$pgv_lang["folder"]		 			= "Adresář na serveru";
$pgv_lang["gedrec_deleted"]		= "GEDCOM záznam úspěšně smazána.";
$pgv_lang["gen_thumb"]				= "Vytvořit miniaturu";
$pgv_lang["gen_missing_thumbs"]		= "Vytvořit chybějící miniatury";
$pgv_lang["gen_missing_thumbs_lbl"]	= "Chybějící miniatury";
$pgv_lang["gender_search"]			= "Pohlaví: ";
$pgv_lang["generate_thumbnail"]		= "Vytvořit miniaturu automaticky ";
$pgv_lang["hebrew_givn"]			= "Hebrejština křestní jména";
$pgv_lang["hebrew_surn"]			= "Hebrejština Příjmení";
$pgv_lang["hide_changes"]		= "Chcete-li skrýt změny, klikněte sem.";
$pgv_lang["highlighted"]		= "Zvýrazněný obrázek";
$pgv_lang["illegal_chars"]			= "Prázdné jméno nebo nepovolené znaky v názvu";
$pgv_lang["invalid_search_multisite_input"] = "Prosím, zadejte jeden z následujících: jméno, datum narození, místo narození, datum úmrtí, místo úmrtí, a pohlaví";
$pgv_lang["invalid_search_multisite_input_gender"] = "Prosím vyhledat znovu více informací než jen pohlaví";
$pgv_lang["label_diff_server"]      = "Nový dálkový stránky";
$pgv_lang["label_location"]         = "Umístění stránek";
$pgv_lang["label_password_id2"]		= "Heslo: ";
$pgv_lang["label_rel_to_current"]   = "Vztah k aktuální osobě";
$pgv_lang["label_same_server"]      = "Místní stránky";
$pgv_lang["label_site"]             = "Stránky";
$pgv_lang["label_site_url"]         = "URL stránky";
$pgv_lang["label_username_id2"]		= "Uživatelské jméno: ";
$pgv_lang["lbl_server_list"]        = "Stávající vzdálený stránky.";
$pgv_lang["lbl_type_server"]		= "Zadejte v novém stránky.";
$pgv_lang["link_as_child"]			= "Připojte tuto osobu do stávající rodiny jako dítě";
$pgv_lang["link_as_husband"]		= "Připojte tuto osobu do stávající rodiny jako manžel";
$pgv_lang["link_success"]			= "Úspěšně přidáno připojení";
$pgv_lang["link_to_existing_media"]	= "Připojení k existující média položky";
$pgv_lang["max_media_depth"]		= "Můžete zadat více než #GLOBALS[MEDIA_DIRECTORY_LEVELS]# podadresáře";
$pgv_lang["max_upload_size"]		= "Maximální velikost nahrávaných souborů: ";
$pgv_lang["media_deleted"]			= "Adresář média úspěšně odstraněn.";
$pgv_lang["media_exists"]			= "Soubory médií již existuje.";
$pgv_lang["media_file"]			= "Soubory médií nahrát";
$pgv_lang["media_file_deleted"]		= "Soubory médií úspěšně smazána.";
$pgv_lang["media_file_moved"]		= "Soubory médií přesunut.";
$pgv_lang["media_file_not_moved"]	= "Soubory médií nelze přesunout.";
$pgv_lang["media_file_not_renamed"]	= "Soubory médií nemůže být přesunut nebo přejmenován.";
$pgv_lang["media_thumb_exists"]		= "Miniaturní již existuje.";
$pgv_lang["multiple_gedcoms"]		= "Tento soubor je připojen k jiné genealogické databáze na tomto serveru. To nemůže být odstraněn, přesunut nebo přejmenován, dokud tato připojení byly odstraněny.";
$pgv_lang["must_provide"]		= "Musíte poskytnout ";
$pgv_lang["name_search"]			= "Jméno: ";
$pgv_lang["new_repo_created"]		= "Nová repozitáře vytvořen";
$pgv_lang["new_shared_note_created"] 	= "Sdílené Poznámka úspěšně vytvořen.";
$pgv_lang["shared_note_updated"] 	= "Sdílená poznámka úspěšně aktualizována.";
$pgv_lang["new_source_created"]	= "Nový zdroj úspěšně vytvořen.";
$pgv_lang["no_changes"]			= "Zatím nebyly provedeny žádné změny, které by se měly přezkoumat.";
$pgv_lang["no_known_servers"]		= "Nejsou známy žádné servery<br />Žádné výsledky budou nalezeny";
$pgv_lang["no_temple"]			= "No Temple - Living Ordinance";
$pgv_lang["no_upload"]				= "Nahrávání souborů médií není povolena, protože multi-mediální položek byly zakázány, nebo proto, že adresář média není zapisovatelný.";
$pgv_lang["paste_id_into_field"]= "Vložte toto ID pramene do poliček, z nichž se chcete odvolávat na tento pramen.";
$pgv_lang["paste_rid_into_field"]	= "Vložte následující ID do e-editační pole odkázání se na tento repozitáře";
$pgv_lang["record_marked_deleted"]		= "Tento záznam byl označen pro odstranění po schválení správcem.";
$pgv_lang["replace_with"]			= "Vyměňte za";
$pgv_lang["show_changes"]		= "Tento záznam byl aktualizován. Klikněte sem pro zobrazení změn.";
$pgv_lang["thumb_genned"]			= "Miniatura #thumbnail# generována automaticky.";
$pgv_lang["thumbgen_error"]			= "Miniatura #thumbnail# nelze generovat automaticky.";
$pgv_lang["thumbnail"]			= "Zmenšenina";
$pgv_lang["title_remote_link"]      = "Přidat vzdálené připojení";
$pgv_lang["undo"]			= "Zpět";
$pgv_lang["undo_all"]				= "Vrátit všechny změny";
$pgv_lang["undo_all_confirm"]		= "Jste si jisti, že chcete zrušit všechny změny pro tento GEDCOM?";
$pgv_lang["undo_successful"]		= "Návrat byl úspěšný";
$pgv_lang["update_successful"]		= "Aktualizace byla úspěšná";
$pgv_lang["upload"]					= "Nahrávej";
$pgv_lang["upload_error"]		= "Během nahrávání vašeho souboru se objevila chyba.";
$pgv_lang["copy_error"]				= "Soubor #GLOBALS[whichFile2]# nemohl být zkopírován z #GLOBALS[whichFile1]#";
$pgv_lang["upload_media"]		= "Nahrát mediální soubory";
$pgv_lang["upload_media_help"]		= "~#pgv_lang[upload_media]#~<br /><br />Vyberte soubory z místního počítače nahrát na server. Všechny soubory budou nahrány do adresáře <b>#MEDIA_DIRECTORY#</b> nebo na jedné ze svých podadresářů.<br /><br />Názvy složek, které nastavíte bude připojen k #MEDIA_DIRECTORY#. Například, #MEDIA_DIRECTORY#rodiny. Pokud thumbnail adresář neexistuje, bude vytvořen automaticky.";
$pgv_lang["upload_successful"]		= "Nahrání bylo úspěšné";
$pgv_lang["view_change_diff"]		= "Prohlédnout si změny";

?>
