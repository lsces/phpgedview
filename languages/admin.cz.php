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
$pgv_lang["analytics_config"]		= "Webová Analytika";
$pgv_lang["google_analytics"]		= "Google Analytika";
$pgv_lang["USE_GOOGLE_ANALYTICS"]	= "Aktivace Google Analytika?";
$pgv_lang["PGV_GOOGLE_ANALYTICS"]	= "Google Analytika číslo účtu";
$pgv_lang["piwik_analytics"]		= "Piwik Analytika";
$pgv_lang["USE_PIWIK_ANALYTICS"]	= "Aktivace Piwik Analytika?";
$pgv_lang["PGV_PIWIK_URL"]			= "Serveru Adresa Piwik Analytika";
$pgv_lang["PGV_PIWIK_SITE"]			= "Tato stránka je číslo v Piwik Analytika";
$pgv_lang["clustrmaps_analytics"]	= "ClustrMaps Analytika";
$pgv_lang["USE_CLUSTRMAPS_ANALYTICS"] = "Aktivace ClustrMaps Analytika?";
$pgv_lang["PGV_CLUSTRMAPS_SITE"] 	= "URL této PhpGedView stránce";
$pgv_lang["PGV_CLUSTRMAPS_SERVER"] 	= "Číslo ClustrMaps serveru";

$pgv_lang["module_admin"]			= "Správa Modulů";
$pgv_lang["mod_admin_installed"]	= "Instalované Moduly";
$pgv_lang["mod_admin_tabs"]			= "Správa Záložek";
$pgv_lang["mod_admin_menus"]		= "Správa Menus";
$pgv_lang["mod_admin_intro"]		= "Níže je seznam všech modulů nainstalovaných v daném případě PhpGedView. Moduly jsou instalovány jejich umístěním v <i>modules</i> adresáře. Zde si můžete nastavit úroveň přístupu na GEDCOM pro každý modul. Pokud modul obsahuje karty pro jednotlivé stránky nebo menu pro seznam nabídky, můžete také nastavit úroveň přístupu a pořadí každého z nich.";
$pgv_lang["mod_admin_active"]		= "Činný";
$pgv_lang["mod_admin_name"]			= "Název Modulu";
$pgv_lang["mod_admin_description"]	= "Popis";
$pgv_lang["mod_admin_version"]		= "Verze / PGV";
$pgv_lang["mod_admin_hastab"]		= "Záložce?";
$pgv_lang["mod_admin_hasmenu"]		= "Menu?";
$pgv_lang["mod_admin_access_level"]	= "Přístup Úroveň";
$pgv_lang["mod_admin_order"]		= "Pořadí";
$pgv_lang["mod_admin_config"]		= "Nastavení Modulu";
$pgv_lang["mod_admin_settings"]		= "Nastavení Konfigurace Modulu";
$pgv_lang["ret_module_admin"]		= "Návrat na stránce Modulu Správy";
$pgv_lang["ret_admin"]				= "Návrat na stránce Správa";

$pgv_lang["enter_comment"]	= "Můžete zadat komentář zde.";
$pgv_lang["upload_a_gedcom"] 		= "Nahrát soubor GEDCOM";
$pgv_lang["start_entering"] 		= "Začněte zadávat údaje";
$pgv_lang["add_gedcom_from_path"] 	= "Přidat GEDCOM z umístění souboru";
$pgv_lang["get_started_instructions"]	= "Vyberte si jednu z následujících možností, abyste mohli začít používat PhpGedView";

$pgv_lang["admin_users_exists"]		= "Následující správci již existují:";
$pgv_lang["install_step_1"] = "Zkontrolujte Prostředí";
$pgv_lang["install_step_2"] = "Připojení k Databázi";
$pgv_lang["install_step_3"] = "Vytvořit Tabulky";
$pgv_lang["install_step_4"] = "Konfigurace Stránek";
$pgv_lang["install_step_5"] = "Jazyky";
$pgv_lang["install_step_6"] = "Uložit Konfiguraci";
$pgv_lang["install_step_7"] = "Vytvořit správce uživatele";
$pgv_lang["install_wizard"] = "Instalační Asistent";
$pgv_lang["basic_site_config"] = "Základní Nastavení";
$pgv_lang["adv_site_config"] = "Pokročilé Nastavení";
$pgv_lang["config_not_saved"] = "*Vaše nastavení se neuloží<br />dokud kroku 6";
$pgv_lang["download_config"] = "Stáhněte config.php";
$pgv_lang["site_unavailable"] = "Tato stránka je momentálně nedostupná";
$pgv_lang["to_manage_users"] = "Chcete-li spravovat uživatele, použijte <a href=\"useradmin.php\">Uživatele Správy</a> stránku.";
$pgv_lang["db_tables_created"] = "Databázové tabulky úspěšně vytvořen";
$pgv_lang["config_saved"] = "Konfigurace byla úspěšně uložena";
$pgv_lang["checking_errors"]		= "Kontrola chyb ...";
$pgv_lang["checking_php_version"]		= "Kontrola požadovanou verzi PHP:";
$pgv_lang["failed"]		= "Neúspěšný";
$pgv_lang["pgv_requires_version"]		= "PhpGedView vyžaduje PHP verze #PGV_REQUIRED_PHP_VERSION# nebo vyšší.";
$pgv_lang["using_php_version"]		= "Nacházíte se pomocí PHP verze #PGV_ACTUAL_PHP_VERSION#";
$pgv_lang["checking_db_support"]		= "Kontrola minimální podporou databáze:";
$pgv_lang["no_db_extensions"]		= "Nemusíte mít žádnou z podporovaných typů databází.";
$pgv_lang["db_ext_support"]		= "Máte podporu pro #DBEXT#";
$pgv_lang["checking_config.php"]		= "Kontrola config.php:";
$pgv_lang["config.php_missing"]		= "config.php nebyl nalezen.";
$pgv_lang["config.php_missing_instr"]		= "Tento průvodce instalací nebude moci napsat své nastavení do souboru config.php. Můžete vytvořit kopii souboru config.dist a přejmenujte jej na config.php. Střídavě, po dokončení tohoto průvodce instalací budete mít možnost stáhnout nastavení a nahrát výsledný soubor config.php.";
$pgv_lang["config.php_not_writable"]		= "config.php není zapisovatelný.";
$pgv_lang["config.php_not_writable_instr"]		= "Tento průvodce instalací nebudou moci napsat své nastavení souboru config.php. Můžete nastavit oprávnění k zápisu souboru, nebo po dokončení tohoto průvodce budete mít možnost stáhnout nastavení a nahrát výsledný soubor config.php.";
$pgv_lang["passed"]		= "Prošel";
$pgv_lang["config.php_writable"]		= "config.php je přítomen a zapisovat.";
$pgv_lang["checking_warnings"]		= "Kontrola varování ...";
$pgv_lang["checking_timelimit"]		= "Kontrola schopnost měnit lhůta:";
$pgv_lang["cannot_change_timelimit"]		= "Nelze změnit lhůta.";
$pgv_lang["cannot_change_timelimit_instr"]		= "Ty nemusí být schopen spustit všechny funkce na velkých databázích s mnoha jednotlivců.";
$pgv_lang["current_max_timelimit"]		= "Váš maximální lhůta je";
$pgv_lang["check_memlimit"]		= "Kontrola schopnost měnit limit paměti:";
$pgv_lang["cannot_change_memlimit"]		= "Nelze změnit limit paměti.";
$pgv_lang["cannot_change_memlimit_instr"]		= "Ty nemusí být schopen spustit všechny funkce na velkých databázích s mnoha jednotlivců.";
$pgv_lang["current_max_memlimit"]		= "Vaše aktuální limit paměti je";
$pgv_lang["check_upload"]		= "Kontrola možností nahrávání souborů:";
$pgv_lang["current_max_upload"]		= "Vaše maximální nahrávání velikost souboru je:";
$pgv_lang["check_gd"]		= "Kontrola GD knihovny:";
$pgv_lang["cannot_use_gd"]		= "Nemusíte mít knihovnu GD. Nebudete moci automaticky vytvářet miniatury obrazů.";
$pgv_lang["check_sax"]		= "Kontrola SAX XML knihovny:";
$pgv_lang["cannot_use_sax"]		= "Nemáte na SAX XML knihovnu. Nebudete moci spustit žádné zprávy nebo nějaké jiné pomocné funkce.";
$pgv_lang["check_dom"]		= "Kontrola DOM XML knihovnu:";
$pgv_lang["cannot_use_dom"]		= "Nemusíte mít knihovnu DOM XML. Nebudete moci exportovat XML.";
$pgv_lang["check_calendar"]		= "Kontrola Pokročilé Kalendář knihovny:";
$pgv_lang["cannot_use_calendar"]		= "Nemáte pokročilé kalendáře podporu. Nebudete moci spustit některé pokročilé funkce kalendáře.";
$pgv_lang["warnings_passed"]		= "Všechny varovné kontroly prošel.";
$pgv_lang["warning_instr"]		= "Pokud se kterýkoli z varování neprojdou můžete být stále schopen běžet PhpGedView na tomto serveru, ale některé funkce může být zakázána, nebo můžete zaznamenat snížení výkonu.";

$pgv_lang["associated_files"]		= "Související soubory:";
$pgv_lang["remove_all_files"]		= "Odstraňte všechny jiné než podstatné soubory";
$pgv_lang["warn_file_delete"]		= "Tento soubor obsahuje důležité informace, jako jsou jazykové nastavení nebo probíhajících změn údajů. Jste si jisti, že chcete smazat tento soubor?";
$pgv_lang["deleted_files"]          = "Smazané soubory:";
$pgv_lang["index_dir_cleanup_inst"]	= "Chcete-li odstranit soubor nebo podadresář z indexového seznamu přetáhněte ji do koše, nebo zvolte svůj políčko. Klepněte na tlačítko Odstranit na trvalé odstranění označené soubory.<br /><br />Soubory označené <img src=\"./images/RESN_confidential.gif\" alt=\"\" /> jsou nezbytné pro správné fungování a nemůže být odstraněn.<br />Soubory označené <img src=\"./images/RESN_locked.gif\" alt=\"\" /> mají důležité nastavení nebo nevyřízené změny údajů a měly by být odstraněny, pokud jste si jisti, že víte, co děláte.<br /><br />";
$pgv_lang["index_dir_cleanup"]		= "Vyčištění Index adresář";
$pgv_lang["clear_cache_succes"]		= "Tyto soubory mezipaměti byly odstraněny.";
$pgv_lang["clear_cache"]			= "Vymazat soubory mezipaměti";
$pgv_lang["sanity_err0"]			= "Chyby:";
$pgv_lang["sanity_err1"]			= "Musíte mít PHP verze #PGV_REQUIRED_PHP_VERSION# nebo vyšší.";
$pgv_lang["sanity_err2"]			= "Soubor nebo adresář <i>#GLOBALS[whichFile]#</i> neexistuje. Ověřte si prosím, že soubor nebo adresář existuje, nebyl mis-pojmenovaný, a oprávnění ke čtení jsou nastaveny správně.";
$pgv_lang["sanity_err3"]			= "Soubor <i>#GLOBALS[whichFile]#</i> zatím nenahrál správně. Prosím, zkuste soubor nahrát znovu.";
$pgv_lang["sanity_err4"]			= "Soubor <i>config.php</i> je poškozen.";
$pgv_lang["sanity_err5"]			= "Soubor <i>config.php</i> není zapisovatelný.";
$pgv_lang["sanity_err6"]			= "Adresář <i>#GLOBALS[INDEX_DIRECTORY]#</i> není zapisovatelný.";
$pgv_lang["sanity_warn0"]			= "Varování:";
$pgv_lang["sanity_warn1"]			= "<i>#GLOBALS[MEDIA_DIRECTORY]#</i> adresář není zapisovatelný. Nebudete moci nahrát multimediální soubory nebo vytvářet náhledy v PhpGedView.";
$pgv_lang["sanity_warn2"]			= "<i>#GLOBALS[MEDIA_DIRECTORY]#thumbs</i> adresář není zapisovatelný. Nebudete moci nahrát miniatur nebo generovat náhledy v PhpGedView.";
$pgv_lang["sanity_warn3"]			= "Knihovna GD neexistuje. PhpGedView bude i nadále fungovat, ale některé z funkcí, jako je například náhledy generace a kruhu diagram, nebude fungovat bez knihovny GD. Podívejte se prosím <a href='http://www.php.net/manual/en/ref.image.php'>http://www.php.net/manual/en/ref.image.php</a pro více informací.";
$pgv_lang["sanity_warn4"]			= "Knihovna XML neexistuje. PhpGedView bude i nadále fungovat, ale některé z funkcí, jako je generování sestav a webových služeb, nebude fungovat bez knihovny XML. Podívejte se prosím <a href='http://www.php.net/manual/en/ref.xml.php'>http://www.php.net/manual/en/ref.xml.php</a> pro více informací.";
$pgv_lang["sanity_warn5"]			= "Knihovna DOM XML neexistuje. PhpGedView bude i nadále fungovat, ale některé z funkcí, jako je Export funkcí gramps v výstřižků, stahovat a webových služeb, nebude fungovat. Podívejte se prosím <a href='http://www.php.net/manual/en/ref.domxml.php'>http://www.php.net/manual/en/ref.domxml.php</a> pro více informací.";
$pgv_lang["sanity_warn6"]			= "Knihovna Kalendář neexistuje. PhpGedView bude i nadále fungovat, ale některé z funkcí, jako je konverze na jiných kalendářích, jako např. hebrejština nebo ve francouzštině, nebude fungovat. Je to nezbytné pro běh PhpGedView. Podívejte se prosím <a href='http://www.php.net/manual/en/ref.calendar.php'>http://www.php.net/manual/en/ref.calendar.php</a> pro více informací.";
$pgv_lang["ip_address"]				= "IP adresa";
$pgv_lang["date_time"]				= "Datum a čas";
$pgv_lang["log_message"]			= "Zpráva Protokolu";
$pgv_lang["searchtype"]				= "Typ hledání";
$pgv_lang["query"]					= "Dotaz";
$pgv_lang["user"]					= "Ověřený uživatel";
$pgv_lang["editors"]				= "Editorů";
$pgv_lang["gedcom_admins"]			= "Správci GEDCOM";
$pgv_lang["site_admins"]			= "Správci Webu";
$pgv_lang["nobody"]					= "Nikdo";
$pgv_lang["thumbnail_deleted"]		= "Miniatury soubor úspěšně odstraněn.";
$pgv_lang["thumbnail_not_deleted"]	= "Miniatury soubor nelze odstranit.";
$pgv_lang["step2"]				= "Krok 2 z 4:";
$pgv_lang["refresh"]				= "Obnovit";
$pgv_lang["move_file_success"]		= "Média a miniatury souborů úspěšně přesunuty.";
$pgv_lang["media_folder_corrupt"]	= "Adresář médií je poškozen.";
$pgv_lang["media_file_not_deleted"]	= "Soubor média nemohl být odstraněn.";
$pgv_lang["gedcom_deleted"]		= "GEDCOM soubor [#GED#] byl úspěšně smazán.";
$pgv_lang["gedadmin"]				= "Správce GEDCOM";
$pgv_lang["full_name"]			= "Celé jméno";
$pgv_lang["error_header"] 		= "Soubor GEDCOM, [#GEDCOM#], není na zadaném místě.";
$pgv_lang["confirm_delete_file"]	= "Jste si jisti, že chcete smazat tento soubor?";
$pgv_lang["confirm_folder_delete"] = "Jste si jisti, že chcete smazat tento adresář?";
$pgv_lang["confirm_remove_links"]	= "Jste si jisti, že chcete odstranit všechna připojení k tomuto objektu?";
$pgv_lang["PRIV_PUBLIC"]			= "Zobrazit veřejně";
$pgv_lang["PRIV_USER"]				= "Zobrazit jen autentifikovaným uživatelům";
$pgv_lang["PRIV_NONE"]				= "Ukázat jen administrátorům";
$pgv_lang["PRIV_HIDE"]				= "Skrýt i administrátorům";
$pgv_lang["manage_gedcoms"]		= "Správa GEDCOM souborů a úprava privátnosti";
$pgv_lang["keep_media"]				= "Mějte mediální připojení";
$pgv_lang["current_links"]			= "Připojení";
$pgv_lang["add_more_links"]			= "Přidat připojení";
$pgv_lang["enter_pid_or_name"]		= "Zadejte individuální ID nebo název";
$pgv_lang["set_links"]				= "Nastavit připojení";
$pgv_lang["add_or_remove_links"]	= "Správa připojení";

$pgv_lang["keep"]					= "Udržovat";
$pgv_lang["unlink"]					= "Rozpojit";
$pgv_lang["nav"]					= "Navigátor";
$pgv_lang["fam_nav"]				= "Navigátor Rodina";
$pgv_lang["remove"]					= "Odstranit";
$pgv_lang["keep_link"]				= "Uchovávejte připojení v seznamu";
$pgv_lang["remove_link"]			= "Odebrat připojení ze seznamu";
$pgv_lang["open_nav"]				= "Otevřená Navigátor Rodiny";
$pgv_lang["link_exists"]			= "Toto připojení již existuje";
$pgv_lang["id_not_valid"]			= "Není platný Osoba, Rodina nebo Zdroj ID";
$pgv_lang["add_fam_other_links"]	= "Přidejte Rodina, a Hledání spojení";
$pgv_lang["search_add_links"]		= "Hledat osob se přidat k Přidat Připojení seznamu.";
$pgv_lang["enter_name"]				= "Zadejte název";
$pgv_lang["add_indi_to_link_list"]	= "Klikněte název přidat tuto osobu Přidat Připojení seznamu.";
$pgv_lang["click_choose_head"]		= "Klikněte #GLOBALS[tempStringHead]# zvolte osobu jako hlava rodiny.";
$pgv_lang["click_choose_head_text"]	= "Klikněte zvolte osobu jako hlava rodiny.";
$pgv_lang["head"]					= "Hlava";
$pgv_lang["id_empty"]				= "Při přidávání spojení, může ID pole nesmí být prázdné.";
$pgv_lang["link_deleted"]			= "Připojení k #GLOBALS[remLinkId]# vypouští";
$pgv_lang["link_added"]				= "Připojení k #GLOBALS[addLinkId]# přidané";
$pgv_lang["no_update_CHANs"]		= "Nenechte si aktualizovat CHAN (Poslední Změna) záznamy";
$pgv_lang["no_CHANs_update"]		= "Ne CHAN (Poslední Změna) záznamy byly aktualizovány";

$pgv_lang["files_in_backup"]		= "Soubory zahrnuté v této zálohování";
$pgv_lang["created_remotelinks"]	= "Tabulka <i>Remotelinks</i> (vzdálené připojení) byla úspěšně vytvořena.";
$pgv_lang["created_remotelinks_fail"] 	= "Není možné vytvořit tabulku <i>Remotelinks</i> (vzdálené připojení).";
$pgv_lang["created_indis"]			= "Tabulka <i>Individuals</i> (osoby) byla úspěšně vytvořena.";
$pgv_lang["created_indis_fail"]	= "Není možné vytvořit tabulku <i>Individuals</i> (osoby).";
$pgv_lang["created_fams"]			= "Tabulka <i>Families</i> (rodiny) byla úspěšně vytvořena.";
$pgv_lang["created_fams_fail"]	= "Není možné vytvořit tabulku <i>Families</i> (rodiny).";
$pgv_lang["created_sources"]		= "Tabulka <i>Sources</i> (zdroje) byla úspěšně vytvořena.";
$pgv_lang["created_sources_fail"]	= "Není možné vytvořit tabulku <i>Sources</i> (zdroje).";
$pgv_lang["created_other"]			= "Tabulka <i>Other</i> (ostatní) byla úspěšně vytvořena.";
$pgv_lang["created_other_fail"]	= "Není možné vytvořit tabulku <i>Other</i> (ostatní).";
$pgv_lang["created_places"]			= "Tabulka <i>Places</i> (místa) byla úspěšně vytvořena.";
$pgv_lang["created_places_fail"]	= "Není možné vytvořit tabulku <i>Places</i> (místa).";
$pgv_lang["created_placelinks"] 	= "Tabulka <i>Place links</i> (místo připojení) byla úspěšně vytvořena.";
$pgv_lang["created_placelinks_fail"]	= "Není možné vytvořit tabulku <i>Place links</i> (místo připojení).";
$pgv_lang["created_media_fail"]	= "Není možné vytvořit tabulku <i>Media</i> (média).";
$pgv_lang["created_media_mapping_fail"]	= "Není možné vytvořit tabulku <i>Media mappings</i> (mediální připojení).";
$pgv_lang["no_thumb_dir"]			= "Thumbnail adresář pro miniatury neexistuje a nemohl být vytvořen.";
$pgv_lang["folder_created"]		= "Vytvořena složka";
$pgv_lang["folder_no_create"]		= "Složka nemohla být vytvořena";
$pgv_lang["security_no_create"]		= "Upozornění zabezpečení: Nelze vytvořit soubor <b><i>index.php</i></b> ve složce ";
$pgv_lang["security_not_exist"]		= "Upozornění zabezpečení: Soubor <b><i>index.php</i></b> neexistuje ve složce ";
$pgv_lang["label_delete"]           	= "Vymazat";
$pgv_lang["progress_bars_info"]			= "Stavové lišty pod dáme vám vědět, jak import pokračuje. Pokud lhůta vyprší Dovoz se zastaví a budete vyzváni ke stisknutí <b>Pokračovat</b>. Pokud nevidíte <b>Pokračovat</b>, musíte restartovat importem s menším časovém limitu.";
$pgv_lang["upload_replacement"]			= "Nahrát Výměna";
$pgv_lang["about_user"]			= "Nejprve musíte vytvořit administrátorský účet.  Administrátor bude mít práva aktualizovat konfigurační soubory, prohlížet si soukromá data a vytvářet další účty.";
$pgv_lang["access"]				= "Přístup";
$pgv_lang["add_gedcom"]			= "Přidat další GEDCOM";
$pgv_lang["add_new_gedcom"]		= "Vytvořit nový GEDCOM";
$pgv_lang["add_new_language"]		= "Přidat soubory a nastavení nového jazyka";
$pgv_lang["add_user"]			= "Přidat nového uživatele";
$pgv_lang["admin_gedcom"]			= "Spravovat GEDCOM";
$pgv_lang["admin_gedcoms"]		= "Klikněte zde spravovat soubory GEDCOM";
$pgv_lang["admin_geds"]					= "Správa dat a GEDCOM";
$pgv_lang["admin_info"]					= "Informační";
$pgv_lang["admin_site"]					= "Správa webu";
$pgv_lang["admin_user_warnings"]		= "Jeden nebo více uživatelských účtů upozornění";
$pgv_lang["admin_verification_waiting"] = "Uživatelské účty vyžadující ověření adminem";
$pgv_lang["administration"]		= "Správa";
$pgv_lang["ALLOW_CHANGE_GEDCOM"]	= "Povolit přepínání mezi GEDCOM soubory";
$pgv_lang["ALLOW_USER_THEMES"]		= "Umožnit uživatelům vybrat si vlastní motiv";
$pgv_lang["ansi_encoding_detected"]	= "Rozpoznáno kódování ANSI.  PhpGedView pracuje nejlépe se soubory s kódováním UTF-8.";
$pgv_lang["ansi_to_utf8"]		= "Převést kódování v tomto GEDCOM souboru z ANSI (ISO-8859-1) na UTF-8?";
$pgv_lang["apply_privacy"]				= "Použít nastavení ochrany osobních údajů?";
$pgv_lang["back_useradmin"]				= "Návrat na Správu Uživatelů";
$pgv_lang["bytes_read"]				= "Načtené bajty:";
$pgv_lang["can_admin"]			= "Uživatel může administrovat";
$pgv_lang["can_edit"]			= "Úroveň přístupových práv";
$pgv_lang["change_id"]			= "Změnit ID osob na:";
$pgv_lang["choose_priv"]				= "Vyberte míru soukromí:";
$pgv_lang["cleanup_places"]		= "Vyčištění míst";
$pgv_lang["cleanup_users"]				= "Vyčistit uživatele";
$pgv_lang["click_here_to_continue"]	= "Pro pokračování klikněte sem.";
$pgv_lang["click_here_to_go_to_pedigree_tree"]	= "Klikněte sem pro vstup do rodokmenu.";
$pgv_lang["comment"]							= "Administrátora komentáře uživatele";
$pgv_lang["comment_exp"]						= "Administrátora varování k datu";
$pgv_lang["config_help"]		= "Nápověda konfigurace";
$pgv_lang["config_still_writable"]	= "Do vašeho souboru config.php je ještě možné zapisovat. Pokud jste již dokončili nastavování svých stránek, měli byste kvůli bezpečnosti změnit práva k tomuto souboru zpět na možnost 'jen pro čtení'.";
$pgv_lang["configuration"]		= "Konfigurace";
$pgv_lang["configure"]			= "Konfigurace PhpGedView";
$pgv_lang["configure_head"]		= "Nastavení PhpGedView";
$pgv_lang["confirm_gedcom_delete"]	= "Opravdu chcete smazat tento GEDCOM";
$pgv_lang["confirm_user_delete"]	= "Jste si jistí, že chcete smazat uživatele";
$pgv_lang["create_user"]		= "Vytvořit uživatele";
$pgv_lang["current_users"]		= "Seznam všech uživatelů";
$pgv_lang["daily"]			= "Denně";
$pgv_lang["dataset_exists"]			= "GEDCOM soubor s tímto názvem byl již do databáze importován.";
$pgv_lang["unsync_warning"] 					= "Tento soubor GEDCOM je <em>není</em> synchronizovány s databází. To nemusí obsahovat nejnovější verzi vašich dat. Chcete-li znovu importovat z databáze, spíše než soubor, měli byste si stáhnout a znovu nahrát.";
$pgv_lang["date_registered"]	= "Datum zapsáno";
$pgv_lang["day_before_month"]		= "Den před měsícem (DD MM YYYY)";
$pgv_lang["DEFAULT_GEDCOM"]		= "Implicitní GEDCOM";
$pgv_lang["default_user"]		= "Vytvořit implicitního administrátora.";
$pgv_lang["del_gedrights"]						= "GEDCOM již není aktivní, odebrat uživatelské odkazy.";
$pgv_lang["del_proceed"]						= "Pokračovat";
$pgv_lang["del_unvera"]							= "Uživatel není ověřen správcem.";
$pgv_lang["del_unveru"]							= "Uživatel se nepodařilo ověřit během 7 dnů.";
$pgv_lang["do_not_change"]		= "Neměnit";
$pgv_lang["download_gedcom"]		= "Stáhnout GEDCOM";
$pgv_lang["download_here"]	= "Klikněte sem pro stažení.";
$pgv_lang["download_note"]		= "POZNÁMKA: Velké databáze může trvat dlouhou dobu procesu před stažením. Pokud krát PHP před skončení stahování, může stažený soubor nemusí být kompletní.<br /><br />Ujistěte se, že soubor byl stažen správně, zkontrolujte, zda se poslední řádek souboru ve formátu GEDCOM je <b>0&nbsp;TRLR</b> nebo že poslední řádek souboru ve formátu XML, je <b>&lt;/database&gt;</b>. Tyto soubory jsou textové, můžete použít libovolný vhodný textový editor, ale ujistěte se, že <u>není</u> uložit stažený soubor poté, co jste ho zkontrolovat.<br /><br />Obecně platí, že by to mohlo trvat tolik času ke stažení jako trvalo importovat původní soubor GEDCOM.";
$pgv_lang["editaccount"]			= "Umožnit tomuto uživateli upravovat informace o svém účtu";
$pgv_lang["empty_dataset"]			= "Chcete vymazat stará data a nahradit je novými?";
$pgv_lang["empty_lines_detected"]	= "Ve vašem GEDCOM souboru byly nalezeny prázdné řádky. Při čištění budou tyto řádky odstraněny.";
$pgv_lang["enable_disable_lang"]				= "Konfigurace podporovaných jazyků";
$pgv_lang["error_ban_server"]					= "Neplatná IP adresa.";
$pgv_lang["error_delete_person"]				= "Musíte vybrat osobu, jejíž vzdálené připojení, které chcete smazat.";
$pgv_lang["error_header_write"]	= "Do souboru GEDCOM <b>#GEDCOM#</b> nelze zapisovat. Zkontrolujte vlastnosti a přístupová práva souboru.";
$pgv_lang["error_remove_site"]					= "Vzdálený server nemohl být odstraněn.";
$pgv_lang["error_remove_site_linked"]			= "Vzdálený server nelze odstranit, protože jeho připojení seznam není prázdný.";
$pgv_lang["error_remote_duplicate"]				= "Tato vzdálená databáze je již v seznamu jako <i>#GLOBALS[whichFile]#</i>";
$pgv_lang["error_siteauth_failed"]				= "Nepodařilo se ověřit na vzdálené straně";
$pgv_lang["error_url_blank"]					= "Prosím, nenechávejte dálkové stránky titul nebo URL prázdné";
$pgv_lang["error_view_info"]					= "Musíte vybrat osobu, jejíž údaje chcete zobrazit.";
$pgv_lang["example_date"]		= "Ukázka neplatného datového formátu z vašeho souboru GEDCOM:";
$pgv_lang["example_place"]						= "Příklad nesprávném místě z vašeho souboru GEDCOM:";
$pgv_lang["fbsql"]			= "FrontBase";
$pgv_lang["found_record"]			= "Nalezen záznam";
$pgv_lang["ged_download"]		= "Stáhnout";
$pgv_lang["ged_import"]			= "Importovat";
$pgv_lang["ged_export"]							= "Vyvážet";
$pgv_lang["ged_check"]							= "Ověřit";
$pgv_lang["gedcom_adm_head"]	= "Správa GEDCOMů";
$pgv_lang["gedcom_config_write_error"]	= "C h y b a !!! Nelze zapisovat do souboru <i>#GLOBALS[whichFile]#</i>. Zkontrolujte prosím, zda je pro správné oprávnění pro zápis.";
$pgv_lang["gedcom_downloadable"] 	= "Tento souboru GEDCOM může být stažen po internetu!<br />Prosím přečtěte si odstavec o BEZPEČNOSTI v souboru <a href=\"readme.txt\">readme.txt</a> a zjednejte nápravu";
$pgv_lang["gedcom_file"]		= "Soubor GEDCOM:";
$pgv_lang["gedcom_not_imported"]	= "Tento souboru GEDCOM ještě nebyl importován.";
$pgv_lang["ibase"]			= "InterBase";
$pgv_lang["ifx"]			= "Informix";
$pgv_lang["img_admin_settings"]		= "Upravit nastavení nakládání s obrázky";
$pgv_lang["autoContinue"]						= "Automaticky stiskněte «Pokračovat» tlačítko";
$pgv_lang["import_complete"]			= "Importování je hotovo";
$pgv_lang["import_options"]						= "Možnosti o dovozu";
$pgv_lang["import_progress"]	= "Průběh dovozu...";
$pgv_lang["import_statistics"]					= "Statistiky dovozu";
$pgv_lang["import_time_exceeded"]				= "Lhůta bylo dosaženo. Klepněte na tlačítko Pokračovat níže obnovení importu souboru GEDCOM.";
$pgv_lang["inc_languages"]		= " Jazyky";
$pgv_lang["INDEX_DIRECTORY"]		= "Adresář Index souborů";
$pgv_lang["invalid_dates"]		= "Rozpoznány nesprávné datové formáty, vyčištěním budou tyto formáty změněny do podoby DD MMM YYYY (např. 1 JAN 2004).";
$pgv_lang["BOM_detected"]						= "Značka pořadí bajtů (BOM) byla zjištěna na začátku souboru. Na vyčištění, bude tento speciální kód být odstraněny.";
$pgv_lang["invalid_header"]		= "Značka pořadí bajtů (BOM) byla zjištěna na začátku souboru. Na vyčistit, bude tento speciální kód odstranit.";
$pgv_lang["label_added_servers"]				= "Vzdálené Serverů";
$pgv_lang["label_banned_servers"]				= "Zakazují stránky podle IP";
$pgv_lang["label_families"]						= "Rodiny";
$pgv_lang["label_gedcom_id2"]					= "Databáze ID:";
$pgv_lang["label_individuals"]					= "Osoby";
$pgv_lang["label_manual_search_engines"]		= "Ručně označit vyhledávače podle IP";
$pgv_lang["label_new_server"]					= "Přidat nové stránky";
$pgv_lang["label_password_id"]					= "Heslo";
$pgv_lang["label_server_info"]					= "Všech osoby a rodiny, kteří jsou dálkově spojeny prostřednictvím webu:";
$pgv_lang["label_server_url"]					= "URL / IP stránce";
$pgv_lang["label_username_id"]					= "Uživatelské jméno";
$pgv_lang["label_view_local"]					= "Zobrazit místní informace o osobě";
$pgv_lang["label_view_remote"]					= "Zobrazit vzdálené informace o osobě";
$pgv_lang["LANG_SELECTION"] 					= "Podporované jazyky";
$pgv_lang["LANGUAGE_DEFAULT"]					= "Nemáte-li nakonfigurován jazyky se vaše stránky budou podporovat.<br />PhpGedView bude používat své výchozí akce.";
$pgv_lang["last_login"]			= "Naposledy přihlášen";
$pgv_lang["lasttab"]							= "Poslední prohlížené karta pro osobu";
$pgv_lang["leave_blank"]		= "Pokud chcete zachovat stávající heslo, nechte políčko pro heslo prázdné.";
$pgv_lang["link_manage_servers"]				= "Spravovat Weby";
$pgv_lang["logfile_content"]	= "Obsah zápis souboru";
$pgv_lang["macfile_detected"]	= "Byl nalezen soubor pro Macintosh. Při čištění bude tento soubor převeden na soubor pro DOS.";
$pgv_lang["mailto"]			= "E-mail";
$pgv_lang["merge_records"]			= "Sloučit záznamy";
$pgv_lang["message_to_all"]						= "Poslat zprávu všem uživatelům";
$pgv_lang["messaging"]			= "Vnitřní zprávy PhpGedView";
$pgv_lang["messaging2"]			= "Vnitřní zprávy s e-maily";
$pgv_lang["messaging3"]			= "PhpGedView posílá e-maily bez ukládání";
$pgv_lang["month_before_day"]		= "Měsíc před dnem (MM DD YYYY)";
$pgv_lang["monthly"]			= "Měsíčně";
$pgv_lang["msql"]			= "Mini SQL";
$pgv_lang["mssql"]			= "Microsoft SQL Server";
$pgv_lang["mysql"]			= "MySQL";
$pgv_lang["never"]					= "Nikdy";
$pgv_lang["no_logs"]			= "Vypnout";
$pgv_lang["no_messaging"]		= "Není možné kontaktovat";
$pgv_lang["oci8"]			= "Oracle 7+";
$pgv_lang["page_views"]							= "&nbsp;&nbsp;zobrazení stránek za&nbsp;&nbsp;";
$pgv_lang["performing_validation"]	= "Provádění validace (zkontrolování) GEDCOMu, vyberte potřebné možnosti a klikněte na 'Pokračovat'";
$pgv_lang["pgsql"]			= "PostgreSQL";
$pgv_lang["pgv_config_write_error"] 		= "Chyba!!! Není možné zapisovat do konfiguračního souboru PhpGedView. Prosím, překontrolujte přístupová práva k souboru a složce a zkuste to znovu.";
$pgv_lang["PGV_MEMORY_LIMIT"]		= "Maximální velikost paměti";
$pgv_lang["PGV_SESSION_SAVE_PATH"]	= "Cesta pro ukládání session";
$pgv_lang["PGV_SESSION_TIME"]		= "Vypršení platnosti session";
$pgv_lang["PGV_SIMPLE_MAIL"] = "V externích e-mailech používat jednoduché e-mailové hlavičky";
$pgv_lang["PGV_SMTP_ACTIVE"]					= "Pomocí SMTP odesílat externí e-maily";
$pgv_lang["PGV_SMTP_HOST"]						= "Odchozí server (SMTP) název";
$pgv_lang["PGV_SMTP_HELO"]						= "Odeslání název domény";
$pgv_lang["PGV_SMTP_PORT"]						= "SMTP Port";
$pgv_lang["PGV_SMTP_AUTH"]						= "Použít jméno a heslo";
$pgv_lang["PGV_SMTP_AUTH_USER"]					= "Uživatelské jméno";
$pgv_lang["PGV_SMTP_AUTH_PASS"]					= "Heslo";
$pgv_lang["PGV_SMTP_SSL"]						= "Zabezpečené připojení";
$pgv_lang["PGV_SMTP_FROM_NAME"] 				= "Jméno odesílatele";
$pgv_lang["PGV_STORE_MESSAGES"]		= "Umožnit online ukládání zpráv:";
$pgv_lang["phpinfo"]							= "PHP Informace";
$pgv_lang["place_cleanup_detected"]	= "Neplatné místo kódování byly zjištěny. Tyto chyby by měly být opraveny.";
$pgv_lang["please_be_patient"]			= "Prosím o strpení";
$pgv_lang["privileges"]			= "Práva";
$pgv_lang["reading_file"]			= "Čtení souboru GEDCOM";
$pgv_lang["readme_documentation"]	= "README dokumentace";
$pgv_lang["remove_ip"]							= "Odstraňte IP";
$pgv_lang["REQUIRE_ADMIN_AUTH_REGISTRATION"]	= "Požadovat správce schválit nové uživatelské registrací";
$pgv_lang["review_readme"]	= "Dříve, než budete pokračovat v konfiguraci PhpGedView, měli byste si pročíst soubor <a href=\"readme.txt\" target=\"_blank\">readme.txt</a>.<br /><br />";
$pgv_lang["seconds"]							= "&nbsp;&nbsp;sekund";
$pgv_lang["select_an_option"]		= "Vyberte jednu z možností:";
$pgv_lang["SERVER_URL"]			= "URL PhpGedView";
$pgv_lang["show_phpinfo"]		= "Ukázat stránku PHPInfo";
$pgv_lang["siteadmin"]							= "Správce webu";
$pgv_lang["sqlite"]			= "SQLite";
$pgv_lang["sybase"]			= "Sybase";
$pgv_lang["sync_gedcom"]						= "Synchronizace uživatelských nastavení s daty GEDCOM";
$pgv_lang["system_time"]		= "Aktuální systémový čas:";
$pgv_lang["user_time"]							= "Aktuální Uživatel Čas:";
$pgv_lang["TBLPREFIX"]			= "Prefix před názvy tabulek v databázi";
$pgv_lang["themecustomization"]					= "Přizpůsobení Motivu";
$pgv_lang["time_limit"]							= "Časový limit:";
$pgv_lang["title_manage_servers"]				= "Spravovat Weby";
$pgv_lang["title_view_conns"]					= "Zobrazit Připojení";
$pgv_lang["translator_tools"]					= "Překladatel nástroje";
$pgv_lang["update_myaccount"]		= "Aktualizovat můj účet";
$pgv_lang["update_user"]		= "Aktualizovat uživatelský účet";
$pgv_lang["upload_gedcom"]		= "Nahrát GEDCOM";
$pgv_lang["USE_REGISTRATION_MODULE"]	= "Umožnit uživatelům požadovat registraci účtu";
$pgv_lang["user_auto_accept"]					= "Automaticky přijímat změny provedené tímto uživatelem";
$pgv_lang["user_contact_method"]	= "Upřednostňovaný způsob kontaktu";
$pgv_lang["user_create_error"]		= "Není možné přidat uživatele. Prosím vraťte se zpět a zkuste to znovu.";
$pgv_lang["user_created"]		= " Uživatel byl úspěšně vytvořen.";
$pgv_lang["user_default_tab"]					= "Výchozí karta pro zobrazení na straně osoby informace";
$pgv_lang["user_path_length"]					= "Maximální délka dráhy vztahu soukromí";
$pgv_lang["user_relationship_priv"]				= "Omezit přístup k příbuzným lidí";
$pgv_lang["users_admin"]						= "Správci webu";
$pgv_lang["users_gedadmin"]						= "Správci GEDCOM";
$pgv_lang["users_total"]						= "Celkový počet uživatelů";
$pgv_lang["users_unver"]						= "Neověřené Uživatelem";
$pgv_lang["users_unver_admin"]					= "Neověřené Správcem";
$pgv_lang["usr_deleted"]						= "Zrušen uživatel: ";
$pgv_lang["usr_idle"]							= "Počet měsíců od posledního přihlášení k účtu uživatele na považovány za neaktivní: ";
$pgv_lang["usr_idle_toolong"]					= "Uživatelský účet je neaktivní příliš dlouho: ";
$pgv_lang["usr_no_cleanup"]						= "Nic našel pro vyčištění";
$pgv_lang["usr_unset_gedcomid"]					= "Smazat GEDCOM ID pro ";
$pgv_lang["usr_unset_rights"]					= "Smazat GEDCOM práva pro ";
$pgv_lang["usr_unset_rootid"]					= "Unset root ID for ";
$pgv_lang["valid_gedcom"]		= "Validní GEDCOM.  Žádné opravy nebyly třeba.";
$pgv_lang["validate_gedcom"]		= "Potvrdit platnost GEDCOMu";
$pgv_lang["verified"]			= "Uživatel potvrdil registraci";
$pgv_lang["verified_by_admin"]		= "Uživatel byl adminem povolen";
$pgv_lang["verify_gedcom"]						= "Ověřte GEDCOM";
$pgv_lang["verify_upload_instructions"]	= "Soubor GEDCOM se stejným názvem byl nalezen. Pokud se rozhodnete pokračovat, bude starý GEDCOM soubor nahrazen souborem, který jste nahráli, a proces importu začne znovu. Pokud se rozhodnete zrušit, bude starý GEDCOM zůstávají beze změny.";
$pgv_lang["view_changelog"]						= "Zobrazit soubor changelog.txt";
$pgv_lang["view_logs"]			= "Zobrazit logfiles";
$pgv_lang["view_readme"]						= "Zobrazit soubor readme.txt";
$pgv_lang["visibleonline"]			= "Viditelný pro jiné uživatele, když je online";
$pgv_lang["visitor"]							= "Návštěvník";
$pgv_lang["warn_users"]							= "Uživatelé s upozorněními";
$pgv_lang["weekly"]			= "Týdně";
$pgv_lang["welcome_new"]			= "Vítejte na svých nových stránkách v PhpGedView. Úspěšně jste nainstalovali PhpGedView (jinak byste neviděli tuto stránku), a tak se můžete pustit do nastavování systému podle vašich potřeb.<br />";
$pgv_lang["yearly"]			= "Ročně";
$pgv_lang["admin_OK_subject"]					= "Schválení účtu na webu #SERVER_NAME#";
$pgv_lang["admin_OK_message"]					= "Správce na PhpGedView webu #SERVER_NAME# schválil svou žádost o účet.\r\n\r\nNyní můžete se přihlásit pomocí přístupu tímto: #SERVER_NAME#";

$pgv_lang["batch_update"]="Provádět dávkové aktualizace / úpravy na GEDCOM";

// Text for the Gedcom Checker
$pgv_lang["gedcheck"]     = "Ověřovatel GEDCOM";          // Module title
$pgv_lang["gedcheck_text"]= "Tento modul kontroluje formát souboru GEDCOM proti <a href=\"http://phpgedview.sourceforge.net/ged551-5.pdf\">5.5.1 GEDCOM Specification</a>. Kontroluje také pro řadu běžných chyb ve vašich datech. Všimněte si, že existuje spousta rozšíření verze, a variace na specifikace, takže by neměl být na případné problémy, které nejsou označeny jako \"Závažný\". Vysvětlení pro všechny chyby lze nalézt ve specifikaci, tak prosím zkontrolujte, že předtím, než požádat o pomoc.";
$pgv_lang["gedcheck_sync"] = "Úpravy provedené v databázi nejsou synchronizovány do souboru #GLOBALS[ged]#. Obsah souboru nemusí být aktuální. Můžete synchronizovat jej s databází nyní provedením <b><a \"#GLOBALS[ged_link]#\">vývozu</a></b>.";
$pgv_lang["gedcheck_nothing"] = "Žádné chyby nalézt na této úrovni důležitosti.";
$pgv_lang["level"]        = "Úrovni";                   // Levels of checking
$pgv_lang["critical"]     = "Závažný";
$pgv_lang["error"]        = "Chyba";
$pgv_lang["warning"]      = "Upozornění";
$pgv_lang["info"]         = "Udání";
$pgv_lang["open_link"]    = "Otevřené spojení na";           // Where to open links
$pgv_lang["same_win"]     = "Stejnou kartu / okně";
$pgv_lang["new_win"]      = "Nová karta / okně";
$pgv_lang["context_lines"]= "Kontext v GEDCOM"; // Number of lines either side of error
$pgv_lang["all_rec"]      = "Všechny záznamy";             // What to show
$pgv_lang["err_rec"]      = "Záznamy s chybami";
$pgv_lang["missing"]      = "nezvěstný";                 // General error messages
$pgv_lang["multiple"]     = "mnohonásobný";
$pgv_lang["invalid"]      = "neplatný";
$pgv_lang["too_many"]     = "příliš mnoho";
$pgv_lang["too_few"]      = "příliš málo";
$pgv_lang["no_link"]      = "není odkaz zpět";
$pgv_lang["data"]         = "data";                    // Specific errors (used with general errors)
$pgv_lang["see"]          = "zobrazit";
$pgv_lang["noref"]        = "Nic odkazuje tohoto záznamu";
$pgv_lang["tag"]          = "štítek";
$pgv_lang["spacing"]      = "řádkování";
$pgv_lang["ADVANCED_NAME_FACTS"] = "Pokročilé fakta jméno";
$pgv_lang["ADVANCED_PLAC_FACTS"] = "Pokročilé fakta místo";
$pgv_lang["SURNAME_TRADITION"]		= "Tradice příjmení"; // Default surname inheritance
$pgv_lang["tradition_spanish"]		= "Španělský";
$pgv_lang["tradition_portuguese"]	= "Portugalský";
$pgv_lang["tradition_icelandic"]	= "Islandský";
$pgv_lang["tradition_paternal"]		= "Otcovský";
$pgv_lang["tradition_polish"]		= "Polský";
$pgv_lang["tradition_none"]			= "Žádný";

// -- The following text is used to build the phrase "i years, j months, k days, l hours, m minutes"
// -- for use in text such as "xxx ago" or "after xxx" or "in xxx"
$pgv_lang["elapsedYear1"]	=	"1 rok";
$pgv_lang["elapsedYear2"]	=	"#pgv_lang[global_num1]# roky";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedYears"]	=	"#pgv_lang[global_num1]# roky";
$pgv_lang["elapsedMonth1"]	=	"1 měsíc";
$pgv_lang["elapsedMonth2"]	=	"#pgv_lang[global_num1]# měsíce";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedMonths"]	=	"#pgv_lang[global_num1]# měsíce";
$pgv_lang["elapsedDay1"]	=	"1 den";
$pgv_lang["elapsedDay2"]	=	"#pgv_lang[global_num1]# dny";		// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedDays"]	=	"#pgv_lang[global_num1]# dny";
$pgv_lang["elapsedHour1"]	=	"1 hodina";
$pgv_lang["elapsedHour2"]	=	"#pgv_lang[global_num1]# hodin";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedHours"]	=	"#pgv_lang[global_num1]# hodin";
$pgv_lang["elapsedMinute1"]	=	"1 minuta";
$pgv_lang["elapsedMinute2"]	=	"#pgv_lang[global_num1]# minuty";	// used in Polish for 2,3,4 or 22,23,24 or 32,33,34 etc.
$pgv_lang["elapsedMinutes"]	=	"#pgv_lang[global_num1]# minuty";

$pgv_lang["elapsedAgo"]		=	"Před #pgv_lang[global_string1]#";

?>
