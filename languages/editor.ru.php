<?php
/**
 * Russian texts
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2013  PGV Development Team.  All rights reserved.
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
 * @package PhpGedView
 * @translator Eugene Fedorov
 * @translator Natalia Anikeeva
 * @translator Ivan Platonov
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;
$pgv_lang["add_marriage"]		= "Добавить детали брака";
$pgv_lang["edit_concurrency_change"]	= "Эта запись редактировал(а) последний раз <i>#CHANGEUSER#</i> #CHANGEDATE#";
$pgv_lang["edit_concurrency_msg2"]	= "Запись с id #PID# была изменена другим пользователем с тех пор, как вы в последний раз её видели.";
$pgv_lang["edit_concurrency_msg1"]	= "Появилась ошибка в процессе создания формы редактирования. Возможно другой пользователь изменил эту запись с тех пор, как вы её последний раз видели.";
$pgv_lang["edit_concurrency_reload"]	= "Пожалуйста перегрузите предыдущую страницу, чтобы быть уверенным, что вы работаете с самой последней записью.";
$pgv_lang["admin_override"]		= "Опция администратора";
$pgv_lang["no_update_CHAN"]		= "Не обновлять больше запись (Последняя Запись)";
$pgv_lang["select_events"]		= "Выбрать события";
$pgv_lang["source_events"]		= "Связать события с этим источником";
$pgv_lang["advanced_name_fields"]	= "Дополнительные имена (прозвище, имя при браке, и т.д.)";
$pgv_lang["accept_changes"]		= "Принять/отклонить изменения";
$pgv_lang["replace"]			= "Заменить запись";
$pgv_lang["append"]			= "Добавить запись";
$pgv_lang["review_changes"]		= "Посмотреть изменения файла GEDCOM";
$pgv_lang["remove_object"]		= "Удалить объект";
$pgv_lang["remove_links"]		= "Удалить ссылки";
$pgv_lang["media_not_deleted"]		= "Директория не удалена.";
$pgv_lang["thumbs_not_deleted"]		= "Директория миниатюр не удалена.";
$pgv_lang["thumbs_deleted"]		= "Директория миниатюр успешно удалена.";
$pgv_lang["show_thumbnail"]		= "Показать миниатюры";
$pgv_lang["link_media"]			= "Связать медиа";
$pgv_lang["to_person"]			= "С персоной";
$pgv_lang["to_family"]			= "С семьёй";
$pgv_lang["to_source"]			= "С источником";
$pgv_lang["to_note"]			= "С общей заметкой";
$pgv_lang["to_repository"]		= "С хранилищем";
$pgv_lang["edit_fam"]			= "Редактировать семью";
$pgv_lang["edit_repo"]			= "Редактировать хранилище";
$pgv_lang["copy"]			= "Копировать";
$pgv_lang["cut"]			= "Вырезать";
$pgv_lang["sort_by_birth"]		= "Сортировать по датам рождения";
$pgv_lang["reorder_children"]           = "Изменить порядок детей";
$pgv_lang["reorder_media"]              = "Изменить порядок медиа";
$pgv_lang["reorder_media_title"]	= "Перетащите миниатюру, чтобы изменить порядок медиа файлов";
$pgv_lang["reorder_media_window"]	= "Изменить порядок медиа (в окне)";
$pgv_lang["reorder_media_window_title"]	= "Кликните по строке, затем перетащите, чтобы изменить порядок медиа ";
$pgv_lang["reorder_media_save"]		= "Сохранить отсортированное медиа в базе данных";
$pgv_lang["reorder_media_reset"]	= "Сбросить на оригинальный порядок";
$pgv_lang["reorder_media_cancel"]	= "Выйти и вернуться";
$pgv_lang["add_from_clipboard"]		= "Добавить из буфера обмена";
$pgv_lang["record_copied"]		= "Запись скопирована в буфер обмена";
$pgv_lang["add_unlinked_person"]	= "Присоединить \"непривязанную\" персону";
$pgv_lang["add_unlinked_source"]	= "Присоединить \"непривязанный\" источник";
$pgv_lang["add_unlinked_note"]		= "Присоединить \"непривязанную\" заметку";
$pgv_lang["add_unlinked"]		= "\"Непривязанная\" запись";
$pgv_lang["server_file"]		= "Имя файла на сервере";
$pgv_lang["server_file_advice"]		= "Не изменять, чтобы оставить оригинальное имя файла.";
$pgv_lang["server_file_advice2"]	= "Вы можете добавить URL, начинающийся с &laquo;http://&raquo;.";
$pgv_lang["server_folder_advice"]	= "Вы можете добавить до #GLOBALS[MEDIA_DIRECTORY_LEVELS]# названий директорий к следующей по умолчанию &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo;.<br />Не добавляйте &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo; часть к имени директории.";
$pgv_lang["server_folder_advice2"]	= "Эта запись игнорируется, если вы ввели URL в поле Имя файла.";
$pgv_lang["add_linkid_advice"]		= "Введите или найдите ID персоны, семьи или источника, к которым это медиа следует привязать.";
$pgv_lang["use_browse_advice"]		= "Нажмите на кнопку &laquo;Обзор&raquo;, чтобы найти желаемый файл на вашем компьютере.";
$pgv_lang["add_media_other_folder"]	= "Другая директория... пожалуйста введите";
$pgv_lang["add_media_file"]		= "Существующий медиа файл на сервере";
$pgv_lang["main_media_ok1"]		= "Главный медиа файл <b>#GLOBALS[oldMediaName]#</b> успешно переименован в <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["main_media_ok2"]		= "Главный медиа файл <b>#GLOBALS[oldMediaName]#</b> успешно перемещён из <b>#GLOBALS[oldMediaFolder]#</b> в <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["main_media_ok3"]		= "Главный медиа файл успешно перенесён с <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> в <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b> и переименован.";
$pgv_lang["main_media_fail0"]		= "Главный медиа файл <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> отсутствует.";
$pgv_lang["main_media_fail1"]		= "Главный медиа файл <b>#GLOBALS[oldMediaName]#</b> не может быть переименован в <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["main_media_fail2"]		= "Главный медиа файл <b>#GLOBALS[oldMediaName]#</b> не может быть перенесён с <b>#GLOBALS[oldMediaFolder]#</b> в <b>#GLOBALS[newMediaFolder]#</b>.";
$pgv_lang["main_media_fail3"]		= "Главный медиа файл не может быть перемещён с <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> в <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b>. и переименован.";
$pgv_lang["resn_disabled"]		= "Замечание: Вы должны включить опцию 'Использовать личные ограничения GEDCOM (RESN)', чтобы увидеть эффект от этой возможности.";
$pgv_lang["thumb_media_ok1"]		= "Файл миниатюры <b>#GLOBALS[oldMediaName]#</b> успешно переименован на <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["thumb_media_ok2"]		= "Файл миниатюры <b>#GLOBALS[oldMediaName]#</b> успешно перенесён с <b>#GLOBALS[oldThumbFolder]#</b> в <b>#GLOBALS[newThumbFolder]#</b>.";
$pgv_lang["thumb_media_ok3"]		= "Файл миниатюры успешно перенесён с <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> в <b>#GLOBALS[newThumbFolder]##GLOBALS[newMediaName]#</b> и переименован.";
$pgv_lang["thumb_media_fail0"]		= "Файл миниатюры <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> отсутствует.";
$pgv_lang["thumb_media_fail1"]		= "Файл миниатюры <b>#GLOBALS[oldMediaName]#</b> не может быть переименован в <b>#GLOBALS[newMediaName]#</b>.";
$pgv_lang["thumb_media_fail2"]		= "Файл миниатюры <b>#GLOBALS[oldMediaName]#</b> не может быть перемещён с <b>#GLOBALS[oldThumbFolder]#</b> в <b>#GLOBALS[newThumbFolder]#</b>.";
$pgv_lang["thumb_media_fail3"]		= "Файл миниатюры не может быть перенесён с <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> в <b>#GLOBALS[newThumbFolder]##GLOBALS[newMediaName]#</b> и переименован.";
$pgv_lang["add_asso"]			= "Добавить новую ассоциацию";
$pgv_lang["edit_sex"]			= "Добавить пол";
$pgv_lang["add_obje"]			= "Добавить новый Медиа-объект";
$pgv_lang["add_name"]			= "Добавить новое имя";
$pgv_lang["edit_raw"]			= "Редактировать непосредственно строки GEDCOM записи";
$pgv_lang["label_add_remote_link"]	= "Добавить связь";
$pgv_lang["label_gedcom_id"]		= "ID с базе данных";
$pgv_lang["label_local_id"]		= "ID персоны";
$pgv_lang["accept"]				= "Принять изменения";
$pgv_lang["accept_all"]			= "Принять все изменения";
$pgv_lang["accept_gedcom"]		= "Кликните на кнопочке рядом для того чтобы отклонить сделанные изменения. Чтобы все изменения аннулировать, импортируйте файл GEDCOM заново.";
$pgv_lang["accept_successful"]		= "Изменнения успешно внесены в базу данных";
$pgv_lang["add_child"]			= "Добавить ребенка";
$pgv_lang["add_child_to_family"]	= "Добавить ребенка в эту семью";
$pgv_lang["add_fact"]			= "Добавить новое событие";
$pgv_lang["add_father"]			= "Добавить отца";
$pgv_lang["add_husb"]			= "Добавить супруга";
$pgv_lang["add_opf_child"]		= "Добавить ребёнка, чтобы создать семью с одним родителем";
$pgv_lang["add_husb_to_family"]		= "Добавить супруга в эту семью";
$pgv_lang["add_media"]			= "Добавить новый Медиа-объект";
$pgv_lang["add_media_lbl"]		= "Добавить Медиа-данные";
$pgv_lang["add_mother"]			= "Добавить мать";
$pgv_lang["add_new_chil"] 		= "Добавить ребёнка";
$pgv_lang["add_new_husb"]		= "Добавить нового супруга";
$pgv_lang["add_new_wife"]		= "Добавить новую супругу";
$pgv_lang["add_note"]			= "Добавьте примечание к факту";
$pgv_lang["add_note_lbl"]		= "Добавить заметку";
$pgv_lang["add_shared_note"]		= "Добавить новую общую заметку";
$pgv_lang["add_shared_note_lbl"]	= "Добавить общую заметку";
$pgv_lang["add_sibling"]		= "Добавить брата или сестру";
$pgv_lang["add_son_daughter"]		= "Добавить сына или дочь";
$pgv_lang["add_source"]			= "Добавьте источник к факту";
$pgv_lang["add_source_lbl"]		= "Добавить источник цитирования";
$pgv_lang["add_wife"]			= "Добавить супругу";
$pgv_lang["add_wife_to_family"]		= "Добавить супругу в эту семью";
$pgv_lang["advanced_search_discription"] = "Расширенный поиск по сайту";
$pgv_lang["auto_thumbnail"]		= "Автоматическая миниатюра";
$pgv_lang["basic_search"]		= "поиск";
$pgv_lang["basic_search_discription"] 	= "Простой поиск по сайту";
$pgv_lang["birthdate_search"]		= "Дата рождения: ";
$pgv_lang["birthplace_search"]		= "Место рождения: ";
$pgv_lang["change"]			= "Изменить";
$pgv_lang["change_family_instr"]	= "Используйте эту страницу, чтобы изменить или удалить членов семьи.<br /><br />Для каждого члена в семье, вы можете использовать ссылку Изменить и выбрать другого человека, чтобы изменить его роль в семье.  Вы также можете использовать ссылку Удалить, чтобы удалить этого человека из семьи.<br /><br />После того, как вы закончите изменения, кликните кнопку Сохранить, чтобы созранить изменения.<br />";
$pgv_lang["change_family_members"]	= "Изменить членов семьи";
$pgv_lang["changes_occurred"]		= "Следующие изменения для этой персоны предотвращены:";
$pgv_lang["confirm_remove"]		= "Вы уверены, что хотите удалить эту персону из семьи?";
$pgv_lang["confirm_remove_object"]	= "Вы уверены, что хотите удалить этот объект из базы данных?";
$pgv_lang["create_repository"]		= "Создать хранилище";
$pgv_lang["shared_note_assisted"]	= "Общая заметка с использованием Помощника";
$pgv_lang["create_shared_note"]		= "Создать общую заметку";
$pgv_lang["create_shared_note_assisted"]= "Создать общую заметку с использованием Помощника";
$pgv_lang["add_new_event_assisted"]	= "Создать новое событие с использованием Помощника";
$pgv_lang["create_source"]		= "Добавить новый источник";
$pgv_lang["current_person"]         	= "То же, что и текущее";
$pgv_lang["date"]			= "Дата";
$pgv_lang["deathdate_search"]		= "Дата смерти: ";
$pgv_lang["deathplace_search"]		= "Место смерти: ";
$pgv_lang["delete_dir_success"]		= "Директории медиа и миниатюр успешно удалены.";
$pgv_lang["delete_file"]		= "Удалить файл";
$pgv_lang["delete_repo"]		= "Удалить Хранилище";
$pgv_lang["directory_not_empty"]	= "Директория не пуста.";
$pgv_lang["directory_not_exist"]	= "Отсутствует директория.";
$pgv_lang["error_remote"]           	= "Вы выбрали удалённый сайт.";
$pgv_lang["error_same"]             	= "Вы выбрали тот же сайт.";
$pgv_lang["external_file"]		= "Этот медиа объект не содержит файла на сервере. Он не может быть удалён, перемещён или переименован.";
$pgv_lang["file_missing"]		= "Файл не получен. Пошлите его заново.";
$pgv_lang["file_partial"]		= "Файл послан частично. Попробуйте заново.";
$pgv_lang["file_success"]		= "Пересылка файла завершена успешно.";
$pgv_lang["file_too_big"]		= "Слишком большой файл.";
$pgv_lang["file_no_temp_dir"]		= "Отсутствует директория временных файлов PHP";
$pgv_lang["file_cant_write"]		= "Невозможно записать на диск при помощи PHP";
$pgv_lang["file_bad_extension"]		= "PHP заблокировало файл расширением";
$pgv_lang["file_unkown_err"]		= "Неизвестный код ршибки при загрузке файла #pgv_lang[global_num1]#. Пожалуйста обратитесь к администратору с этой проблемой.";
$pgv_lang["folder"]		 	= "Директория на сервере";
$pgv_lang["gedcom_editing_disabled"]	= "Редактирование этого GEDCOM-файла запрещено администратором системы.";
$pgv_lang["gedrec_deleted"]		= "Запись GEDCOM удалена";
$pgv_lang["gen_thumb"]			= "Создать миниатюру";
$pgv_lang["gen_missing_thumbs"]		= "Создать отсутствующие миниатюры";
$pgv_lang["gen_missing_thumbs_lbl"]	= "Отсутствуют миниатюры";
$pgv_lang["gender_search"]		= "Пол: ";
$pgv_lang["generate_thumbnail"]		= "Сгенерировать миниатюру автоматически с ";
$pgv_lang["hebrew_givn"]		= "Еврейские имена";
$pgv_lang["hebrew_surn"]		= "Еврейские фамилии";
$pgv_lang["hide_changes"]		= "Нажмите здесть чтобы скрыть изменения.";
$pgv_lang["highlighted"]		= "Выделенное изображение";
$pgv_lang["illegal_chars"]		= "Пустое имя или недопустимые символи в имени";
$pgv_lang["invalid_search_multisite_input"] = "Пожалуста введите одно из следующих:  Имя, Дата рождения, Место рождения, Дата смерти, Место смерти и пол ";
$pgv_lang["invalid_search_multisite_input_gender"] = "Пожалуйста произведите поиск снова с более информативным запросом, а не просто пол";
$pgv_lang["label_diff_server"]      	= "Новый удалённый сайт";
$pgv_lang["label_location"]         	= "Расположение сайта";
$pgv_lang["label_password_id2"]		= "Пароль: ";
$pgv_lang["label_rel_to_current"]   	= "Отношение к текущей персоне";
$pgv_lang["label_same_server"]      	= "Локальный сайт";
$pgv_lang["label_site"]             	= "Сайт";
$pgv_lang["label_site_url"]         	= "Адрес сайта:";
$pgv_lang["label_username_id2"]		= "Имя пользователя: ";
$pgv_lang["lbl_server_list"]        	= "Имеющийся удалённый сайт";
$pgv_lang["lbl_type_server"]		= "Напишите новый сайт.";
$pgv_lang["link_as_child"]		= "Соединить эту персону с существующей семьёй в качестве ребёнка";
$pgv_lang["link_as_husband"]		= "Соединить эту персону с существующей семьёй в качестве мужа";
$pgv_lang["link_success"]		= "Связь удачно добавлена";
$pgv_lang["link_to_existing_media"]	= "Связь с существующим медиа объектом";
$pgv_lang["max_media_depth"]		= "Вы можете ввести не более #GLOBALS[MEDIA_DIRECTORY_LEVELS]# имён поддиректорий";
$pgv_lang["max_upload_size"]		= "Максимальный размер загрузки: ";
$pgv_lang["media_deleted"]		= "Медиа директория успешно удалена.";
$pgv_lang["media_exists"]		= "Медиа файл уже существует.";
$pgv_lang["media_file"]			= "Файл фото/аудио/видио";
$pgv_lang["media_file_deleted"]		= "Медиа файл успешно удалён.";
$pgv_lang["media_file_moved"]		= "Медиа файл перемещён.";
$pgv_lang["media_file_not_moved"]	= "Медиа файл не может быть перемещён.";
$pgv_lang["media_file_not_renamed"]	= "Медиа файл не может быть перемещён или переименован.";
$pgv_lang["media_thumb_exists"]		= "Медиа миниатюра уже существует.";
$pgv_lang["multiple_gedcoms"]		= "Этот файл связан с другой генеалогической базой данных на этом сервере. Он не может быть удалён, перемещён или переименован до тех пор, пока эта связь не будет удалена.";
$pgv_lang["must_provide"]		= "Импортировать:";
$pgv_lang["name_search"]		= "Имя: ";
$pgv_lang["new_repo_created"]		= "Создано новое хранилище";
$pgv_lang["new_shared_note_created"] 	= "Новая общая заметка создана успешно.";
$pgv_lang["shared_note_updated"] 	= "Общая заметка успешно обновлена.";
$pgv_lang["new_source_created"]		= "Новый источник успешно создан";
$pgv_lang["no_changes"]			= "Сейчас нет изменений, которые долдны быть просмотрены.";
$pgv_lang["no_known_servers"]		= "Нет известных серверов<br />Результаты не найдены";
$pgv_lang["no_temple"]			= "Храм мормонов не указан - живое руководство";
$pgv_lang["no_upload"]			= "Загрузка медиа файлов запрещена, потому как мультимедиа опция отключена или по причине медиа директория не имеет прав на запись.";
$pgv_lang["paste_id_into_field"]	= "Вставить этот ID источника в редактируемое поле, чтобы сослаться в нем на этот источник";
$pgv_lang["paste_rid_into_field"]	= "Вставьте следующее ID хранилища в редактируемые поля, чтобы связать с этим Хранилищем ";
$pgv_lang["privacy_not_granted"]	= "Вы не имеете доступа к";
$pgv_lang["privacy_prevented_editing"]	= "Настройки доступа не позволяют Вам редактировать этоу запись.";
$pgv_lang["record_marked_deleted"]	= "Эта запись отмечена к удалению по разрешению администратора.";
$pgv_lang["replace_with"]               = "Заменить на";
$pgv_lang["show_changes"]		= "Эта запись откорректирована. Кликнете здесь чтобы посмотреть изменения.";
$pgv_lang["thumb_genned"]		= "Миниатюра #thumbnail# сгенерирована автоматически.";
$pgv_lang["thumbgen_error"]		= "Миниатюра #thumbnail# не может быть сгенерирована автоматически.";
$pgv_lang["thumbnail"]			= "Миниатюрное воспроизведение";
$pgv_lang["title_remote_link"]      	= "Добавить внешнюю связь";
$pgv_lang["undo"]			= "Отклонить";
$pgv_lang["undo_all"]			= "Отменить все изменения";
$pgv_lang["undo_all_confirm"]		= "Вы уверены, что хотите отменить все изменения к этому файлу GEDCOM?";
$pgv_lang["undo_successful"]		= "Отклонение прошло успешно";
$pgv_lang["update_successful"]		= "Обработка завершена успешно.";
$pgv_lang["upload"]			= "Загрузка";
$pgv_lang["upload_error"]		= "Ошибка при выгрузке из GEDCOM файла.";
$pgv_lang["copy_error"]			= "Файл #GLOBALS[whichFile2]# не может быть скопирован из #GLOBALS[whichFile1]#";
$pgv_lang["upload_media"]		= "Выгрузить медиа (фото/аудио/видио) файлы";
$pgv_lang["upload_media_help"]		= "~#pgv_lang[upload_media]#~<br /><br />Выберите файлы на вашем компьютере для загрузки на сервер.  Все файлы будут загружены в директорию <b>#MEDIA_DIRECTORY#</b> или в одну из поддиректорий.<br /><br />Имена папок, которые вы укажите, будут добавлены к #MEDIA_DIRECTORY#. Например, #MEDIA_DIRECTORY#myfamily. Если директория миниатюр отсутствует, то она автоматически будет создана.";
$pgv_lang["upload_successful"]		= "Выгрузка завершена успешно";
$pgv_lang["view_change_diff"]		= "Показать изменения";

$pgv_lang["gedcomid"]			= "GEDCOM INDI запись номер ID";
?>
