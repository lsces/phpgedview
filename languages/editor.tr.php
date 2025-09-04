<?php
/**
 * Turkish Language file for PhpGedView.
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2011  PGV Development Team.  All rights reserved.
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
 * @package PhpGedView
 * @author Kurt Norgaz
 * @author Adem GENÇ uzayuydu@gmail.com http://www.muttafi.com
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;
$pgv_lang["add_marriage"]			= "Evlilik detayları ekle";
$pgv_lang["edit_concurrency_change"] = "Bu kayıt son olarak <i>#CHANGEUSER#</i> tarafından #CHANGEDATE# tarihinde değiştirildi";
$pgv_lang["edit_concurrency_msg2"]	= "Bu id #PID# kaydı son eriştiğinizden bu yana bir başka kullanıcı tarafından değiştirilmiştir.";
$pgv_lang["edit_concurrency_msg1"]	= "Düzenleme formu oluşturulurken bir hata oluştu. Bu kaydı başka bir kullanıcı son görüntülediğinizden sonra değiştirmiş olabilir.";
$pgv_lang["edit_concurrency_reload"]	= "Lütfen en son kaydı ile çalıştığından emin olmak için önceki sayfayı yeniden yükleyin.";
$pgv_lang["admin_override"]			= "Yönetici Seçeneği";
$pgv_lang["no_update_CHAN"]			= "CHAN (Son Değişiklik) kayıtlarını güncelleştirme hayır";
$pgv_lang["select_events"]			= "Hadiseleri Seçin";
$pgv_lang["source_events"]			= "Bu kaynak ile hadiseleri ilişkilendir";
$pgv_lang["advanced_name_fields"]	= "Ek adlar (takma ad, evlilik adı, vs)";
$pgv_lang["accept_changes"]		= "Değişiklikleri Kabul / Ret";
$pgv_lang["replace"]			= "Kaydı değiştir";
$pgv_lang["append"] 			= "Kayıt ekle";
$pgv_lang["review_changes"]		= "GEDCOM Değişiklikleri Tekrar Görüntüle";
$pgv_lang["remove_object"]			= "Öğeyi kaldır";
$pgv_lang["remove_links"]			= "Linkleri kaldır";
$pgv_lang["media_not_deleted"]		= "Medya dizini kaldırılmadı.";
$pgv_lang["thumbs_not_deleted"]		= "Tırnak önizleme dizini kaldırılmadı.";
$pgv_lang["thumbs_deleted"]			= "Tırnak önizleme dizin başarıyla kaldırıldı.";
$pgv_lang["show_thumbnail"]		= "Tırnak önizlemeleri göster";
$pgv_lang["link_media"]			= "Medyayı Bağla";
$pgv_lang["to_person"]				= "Kişiye";
$pgv_lang["to_family"]				= "Aileye";
$pgv_lang["to_source"]				= "Kaynağa";
$pgv_lang["to_note"]				= "Paylaşılan Nota";
$pgv_lang["to_repository"]			= "Havuza";
$pgv_lang["edit_fam"]				= "Aile Düzenle";
$pgv_lang["edit_repo"]				= "Havuzu Düzenle";
$pgv_lang["copy"]					= "Kopyala";
$pgv_lang["cut"]					= "Kes";
$pgv_lang["sort_by_birth"]			= "Doğum tarihine göre sırala";
$pgv_lang["reorder_children"]		= "Çocukları tekrar sırala";
$pgv_lang["reorder_media"]					= "Medyaları tekrar sırala";
$pgv_lang["reorder_media_title"]			= "Medya öğeleri tekrar sıralamak için tırnak önizlemeleri sürükle-ve-bırak";
$pgv_lang["reorder_media_window"]			= "Medyayı tekrar sırala (pencere)";
$pgv_lang["reorder_media_window_title"]		= "Medyayı tekrar sıralamak için bir satır tıklayın sonra sürükle-ve-bırak ";
$pgv_lang["reorder_media_save"]				= "Sıralanmış medyayı veritabanına kaydet";
$pgv_lang["reorder_media_reset"]			= "Orijinal sıraya sıfırla";
$pgv_lang["reorder_media_cancel"]			= "Çık ve geri dön";
$pgv_lang["add_from_clipboard"]		= "Panodan ekle";
$pgv_lang["record_copied"]			= "Panoya kopyalanan kayıt";
$pgv_lang["add_unlinked_person"]	= "Bağlantısız bir kişi ekle";
$pgv_lang["add_unlinked_source"]	= "Bağlantısız bir kaynak ekle";
$pgv_lang["add_unlinked_note"]		= "Bağlantısız bir not ekle";
$pgv_lang["add_unlinked"]			= "Bağlantısız Kayıtlar";
$pgv_lang["server_file"]				= "Sunucudaki dosya adı";
$pgv_lang["server_file_advice"]			= "Orijinal dosya adını konurmak için değişiklik yapılmaz.";
$pgv_lang["server_file_advice2"]		= "Bir URL girin, &laquo;http://&raquo; ile başlayan.";
$pgv_lang["server_folder_advice"]		= "Varsayılan &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo; takip eden #GLOBALS[MEDIA_DIRECTORY_LEVELS]# dizin adlarını girebilirsiniz.<br />Hedef dizin adı &laquo;#GLOBALS[MEDIA_DIRECTORY]#&raquo; bölümü girmeyin.";
$pgv_lang["server_folder_advice2"]		= "Bu girişe eğer dosya adı alanına bir URL girerseniz yoksayılacaktır.";
$pgv_lang["add_linkid_advice"]			= "Bu medya öğenin geçişi kişi, aile, yada kaynak ID için bağlantılı olmalı gir veya ara.";
$pgv_lang["use_browse_advice"]			= "Yerel bilgisayarınızda istediğiniz dosyayı aramak için &laquo;Gözat&raquo; düğmesini kullanın.";
$pgv_lang["add_media_other_folder"]		= "Diğer dizin... tipi lütfen";
$pgv_lang["add_media_file"]				= "Sunucudaki mevcut Medya dosyası";
$pgv_lang["main_media_ok1"]				= "Ana medya dosyası <b>#GLOBALS[oldMediaName]#</b> başarıyla <b>#GLOBALS[newMediaName]#</b> olarak yeniden adlandırıldı.";
$pgv_lang["main_media_ok2"]				= "Ana medya <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[oldMediaFolder]#</b> dizinden <b>#GLOBALS[newMediaFolder]#</b> dizine başarıyla taşıdı.";
$pgv_lang["main_media_ok3"]				= "Ana medya <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b> başarıyla taşındı ve yeniden adlandırıldı.";
$pgv_lang["main_media_fail0"]			= "Ana medya <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> dosyası mevcut değil.";
$pgv_lang["main_media_fail1"]			= "Ana medya <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[newMediaName]#</b> olarak yeniden adlandırılanmaz.";
$pgv_lang["main_media_fail2"]			= "Ana medya <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[oldMediaFolder]#</b> dan <b>#GLOBALS[newMediaFolder]#</b> buraya taşınamaz.";
$pgv_lang["main_media_fail3"]			= "Ana medya <b>#GLOBALS[oldMediaFolder]##GLOBALS[oldMediaName]#</b> dosyası buradan <b>#GLOBALS[newMediaFolder]##GLOBALS[newMediaName]#</b> buraya taşınamadı ve yeniden adlandırılanmadı.";
$pgv_lang["resn_disabled"]				= "Not: Bu ayarın etkili olması için 'GEDCOM (RESN) Mahremiyet kısıtlamayı kullan' özelliği etkinleştirmeniz gerekir.";
$pgv_lang["thumb_media_ok1"]			= "Tırnak önizleme <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[newMediaName]#</b> olarak başarıyla adlandırıldı.";
$pgv_lang["thumb_media_ok2"]			= "Tırnak önizleme <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[oldThumbFolder]#</b> dan <b>#GLOBALS[newThumbFolder]#</b> buraya başarıyla taşındı.";
$pgv_lang["thumb_media_ok3"]			= "Tırnak önizleme <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> dosyası buradan <b>#GLOBALS[newThumbFolder]##GLOBALS[newMediaName]#</b> buraya başarıyla taşındı ve yeniden adlandırıldı.";
$pgv_lang["thumb_media_fail0"]			= "Tırnak önizleme <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> dosyası mevcut değil.";
$pgv_lang["thumb_media_fail1"]			= "Tırnak önizleme <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[newMediaName]#</b> olarak yeniden adlandırılanmadı.";
$pgv_lang["thumb_media_fail2"]			= "Tırnak önizleme <b>#GLOBALS[oldMediaName]#</b> dosyası <b>#GLOBALS[oldThumbFolder]#</b> dizinden <b>#GLOBALS[newThumbFolder]#</b> dizine taşınamadı.";
$pgv_lang["thumb_media_fail3"]			= "Tırnak önizleme <b>#GLOBALS[oldThumbFolder]##GLOBALS[oldMediaName]#</b> dosyası dizinden <b>#GLOBALS[newThumbFolder]##GLOBALS[newMediaName]#</b> dizine taşınamadı ve yeniden adlandırılamadı.";
$pgv_lang["add_asso"]				= "Yeni bir İlişkilendirilmiş ekle";
$pgv_lang["edit_sex"]				= "Cinsiyeti Düzenle";
$pgv_lang["add_obje"]			= "Yeni bir Çoklumedya öğesi ekle";
$pgv_lang["add_name"]			= "Yeni Ad Ekle";
$pgv_lang["edit_raw"]			= "Ham GEDCOM kaydı düzenle";
$pgv_lang["label_add_remote_link"]  = "Link Ekle";
$pgv_lang["label_gedcom_id"]        = "Veritabanı ID";
$pgv_lang["label_local_id"]         = "Birey ID";
$pgv_lang["accept"]			= "Kabul et";
$pgv_lang["accept_all"] 		= "Tüm değişiklikleri kabul et";
$pgv_lang["accept_gedcom"]			= "Her bir değişikliği kabul yada ret etmek için karar verin<br /><br />Değişikliklerin tümünü kabul etmek için aşağıda kutunun içindeki <b>&quot;Tüm değişiklikleri kabul et&quot;</b> linki tıklayın.<br />Değişiklik hakkında daha fazla fark bilgisini görmek için <b>&quot;Değişiklik Farkları Görüntüle&quot;</b> linkini tıklayın.<br />Yada GEDCOM biçiminde yeni verileri görmek için <b>&quot;GEDCOM kaydı görüntüle&quot;</b> linki tıklayın.";
$pgv_lang["accept_successful"]		= "Değişiklikler başarıyla veritabanı kabul etti";
$pgv_lang["add_child"]			= "Çocuk ekle";
$pgv_lang["add_child_to_family"]	= "Bu aileye bir çocuk ekle";
$pgv_lang["add_fact"]			= "Yeni olgu ekle";
$pgv_lang["add_father"]			= "Yeni bir baba ekle";
$pgv_lang["add_husb"]			= "Koca ekle";
$pgv_lang["add_opf_child"]				= "Bir ebeveyn aile oluşturmak için bir çocuk ekle";
$pgv_lang["add_husb_to_family"]		= "Bu aile için bir koca ekle";
$pgv_lang["add_media"]			= "Yeni bir Medya öğesi ekle";
$pgv_lang["add_media_lbl"]		= "Medya Ekle";
$pgv_lang["add_mother"]			= "Yeni bir anne ekle";
$pgv_lang["add_new_chil"]		= "Yeni bir çocuk ekle";
$pgv_lang["add_new_husb"]		= "Yeni bir koca ekle";
$pgv_lang["add_new_wife"]		= "Yeni bir hanım ekle";
$pgv_lang["add_note"]			= "Yeni bir Not ekle";
$pgv_lang["add_note_lbl"]		= "Not ekle";
$pgv_lang["add_shared_note"]		= "Yeni bir Paylaşılan Not ekle";
$pgv_lang["add_shared_note_lbl"]	= "Paylaşılan Not ekle";
$pgv_lang["add_sibling"]		= "Bir erkek veya kız kardeşi ekle";
$pgv_lang["add_son_daughter"]		= "Bir oğul veya kızı ekle";
$pgv_lang["add_source"]			= "Yeni bir Alıntı Kaynak ekle";
$pgv_lang["add_source_lbl"]		= "Alıntı Kaynak Ekle";
$pgv_lang["add_wife"]			= "Hanım ekle";
$pgv_lang["add_wife_to_family"]		= "Bu aileye bir hanım ekle";
$pgv_lang["advanced_search_discription"] = "Gelişmiş site arama";
$pgv_lang["auto_thumbnail"]			= "Otomatik tırnak önizleme";
$pgv_lang["basic_search"]			= "ara";
$pgv_lang["basic_search_discription"] = "Temel site arama";
$pgv_lang["birthdate_search"]		= "Doğum tarihi: ";
$pgv_lang["birthplace_search"]		= "Doğum yeri: ";
$pgv_lang["change"]					= "Değiştir";
$pgv_lang["change_family_instr"]	= "Aile üyelerini değiştirmek veya kaldırmak için bu sayfayı kullanın.<br /><br />Ailenin her bir üyesi için üyenin yerini alacak bir başka kişiyi seçmek için Değiştir linkini kullanabilirsiniz. Ayrıca ailenin üyelerinden kaldırmak istediğiniz kişiyi kaldırmak için Kaldır linkini kullanabilirsiniz.<br /><br />Aile üyeleri değiştirme ve kaldırma işlemini tamamladığınızda değişiklikleri kaydetmek için Kaydet butona basınız.<br />";
$pgv_lang["change_family_members"]	= "Aile Üyeleri Değiştir";
$pgv_lang["changes_occurred"]		= "Bu kayıt için aşağıdaki değişiklikler yapılmıştır:";
$pgv_lang["confirm_remove"]			= "Bu kişiyi aileden kaldırmak istediğiniz emin misiniz?";
$pgv_lang["confirm_remove_object"]	= "Bu öğeyi veritabanından kaldırmak istediğinizden emin misiniz?";
$pgv_lang["create_repository"]		= "Havuz Oluştur";
$pgv_lang["shared_note_assisted"]	= "Yardımcısı kullanarak Paylaşılan Not";
$pgv_lang["create_shared_note"]		= "Yeni bir Paylaşılan Not ekle";
$pgv_lang["create_shared_note_assisted"]	= "Yardımcısı kullanarak yeni bir Paylaşılan Not oluşturun";
$pgv_lang["add_new_event_assisted"]			= "Yardımcısı kullanarak yeni bir hadise oluştur";
$pgv_lang["create_source"]		= "Yeni bir kaynak ekle";
$pgv_lang["current_person"]         = "Geçerli olarak aynı";
$pgv_lang["date"]			= "Tarih";
$pgv_lang["deathdate_search"]		= "Ölüm tarihi: ";
$pgv_lang["deathplace_search"]		= "Ölüm yeri: ";
$pgv_lang["delete_dir_success"]		= "Medya ve tırnak önizleme dizinleri başarıyla kaldırıldı.";
$pgv_lang["delete_file"]			= "Dosyayı sil";
$pgv_lang["delete_repo"]			= "Havuzu Sil";
$pgv_lang["directory_not_empty"]	= "Dizin boş değil.";
$pgv_lang["directory_not_exist"]	= "Dizin mevcut değil.";
$pgv_lang["error_remote"]           = "Uzak bir siteyi seçtiniz.";
$pgv_lang["error_same"]             = "Aynı siteyi seçtiniz.";
$pgv_lang["external_file"]			= "Bu medya öğesi bu sunucu üzerinde bir dosya olarak mevcut değil. Silinemez, taşınamaz veya yeniden adlandırılamaz.";
$pgv_lang["file_missing"]		= "Hiçbir dosya alınamadı. Lütfen tekrar yükleyin.";
$pgv_lang["file_partial"]		= "Dosya sadece kısmen yüklendi, lütfen tekrar deneyin";
$pgv_lang["file_success"]		= "Dosya başarıyla yüklendi";
$pgv_lang["file_too_big"]		= "Yüklenen dosya izin verilen boyuttan büyük";
$pgv_lang["file_no_temp_dir"]		= "PHP geçici dizin eksik";
$pgv_lang["file_cant_write"]		= "PHP diske yazmakta başarız";
$pgv_lang["file_bad_extension"]		= "PHP uzanti ile dosyayı engelledi";
$pgv_lang["file_unkown_err"]		= "Bilinmeyen dosya yükleme hata kodu #pgv_lang[global_num1]#. Lütfen bu hatayı rapor edin.";
$pgv_lang["folder"]		 			= "Sunucudaki dizin";
$pgv_lang["gedrec_deleted"] 		= "GEDCOM kaydı başarıyla silindi.";
$pgv_lang["gen_thumb"]				= "Tırnak önizleme oluştur";
$pgv_lang["gen_missing_thumbs"]		= "Eksik tırnak önizlemeleri oluştur";
$pgv_lang["gen_missing_thumbs_lbl"]	= "Eksik tırnak önizlemeleri";
$pgv_lang["gender_search"]			= "Cinsiyet: ";
$pgv_lang["generate_thumbnail"]		= "Otomatikman tirnak önizleme üret ";
$pgv_lang["hebrew_givn"]			= "İbrani Verilen Adlar";
$pgv_lang["hebrew_surn"]			= "İbrani Soyadı";
$pgv_lang["hide_changes"]		= "Değişiklikleri gizlemek için burayı tıklayın.";
$pgv_lang["highlighted"]		= "Vurgulanan Resim";
$pgv_lang["illegal_chars"]			= "Adı içinde geçersiz karakter veya boş geçildi";
$pgv_lang["invalid_search_multisite_input"] = "Lütfen aşağıdakilerden birini girin: Adı, Doğum Tarihi, Doğum Yeri, Ölüm Tarihi, Ölüm Yeri ve Cinsiyet";
$pgv_lang["invalid_search_multisite_input_gender"] = "Lütfen sadece cinsiyetten daha fazla bilgi ile tekrar arayın";
$pgv_lang["label_diff_server"]      = "Yeni uzak site";
$pgv_lang["label_location"]         = "Site Konumu ";
$pgv_lang["label_password_id2"]		= "Şifre: ";
$pgv_lang["label_rel_to_current"]   = "Geçerli kişi için akrabalık bağı";
$pgv_lang["label_same_server"]      = "Yerel site";
$pgv_lang["label_site"]             = "Site";
$pgv_lang["label_site_url"]         = "Site URL:";
$pgv_lang["label_username_id2"]		= "Kullanıcı adı: ";
$pgv_lang["lbl_server_list"]        = "Varolan uzak site";
$pgv_lang["lbl_type_server"]         = "Yeni bir site yazın.";
$pgv_lang["link_as_child"]			= "Bu kişiyi mevcut aileye çocuğu olarak bağla";
$pgv_lang["link_as_husband"]		= "Bu kişiyi mevcut aileye kocası olarak bağla";
$pgv_lang["link_success"]			= "Link başarıyla eklendi";
$pgv_lang["link_to_existing_media"]		= "Mevcut medya öğesi bağla";
$pgv_lang["max_media_depth"]		= "Daha fazla #GLOBALS[MEDIA_DIRECTORY_LEVELS]# alt-dizin adlarını girebilirsiniz";
$pgv_lang["max_upload_size"]		= "En fazla yükleme boyutu: ";
$pgv_lang["media_deleted"]			= "Medya dizini başarıyla kaldırıldı.";
$pgv_lang["media_exists"]			= "Medya dosyası zaten mevcut.";
$pgv_lang["media_file"]			= "Medya dosyası yükle";
$pgv_lang["media_file_deleted"]		= "Medya dosyası başarıyla silindi.";
$pgv_lang["media_file_moved"]			= "Medya dosyası taşındı.";
$pgv_lang["media_file_not_moved"]	= "Medya dosyası taşınamadı.";
$pgv_lang["media_file_not_renamed"]	= "Medya dosyası taşınamadı veya yeniden adlandırılanmadı.";
$pgv_lang["media_thumb_exists"]		= "Medya tırnak önizleme zaten mevcut.";
$pgv_lang["multiple_gedcoms"]		= "Bu dosya bu sunucu üzerindeki başka bir soyağacı veritabanına bağlıdır. Bu bağlantı kaldırılana kadar silinemez, taşınamaz, veya yeniden adlandırılanmaz.";
$pgv_lang["must_provide"]			= "Sağlamalısınız ";
$pgv_lang["name_search"]			= "Adı: ";
$pgv_lang["new_repo_created"]		= "Yeni Havuz Oluştur";
$pgv_lang["new_shared_note_created"] 	= "Yeni Paylaşılan Not başarıyla oluşturuldu.";
$pgv_lang["shared_note_updated"] 	= "Paylaşılan Not başarıyla güncellendi.";
$pgv_lang["new_source_created"] 	= "Yeni kaynak başarıyla oluşturuldu.";
$pgv_lang["no_changes"]			= "Şu anda gözden geçirilmesi gereken bir değişiklik yok.";
$pgv_lang["no_known_servers"]		= "Bilinen Sunucular yok<br />Hiç bir sonuç bulunamadı";
$pgv_lang["no_temple"]				= "Tapınak Yok - Yaşam Buyruğu";
$pgv_lang["no_upload"]				= "Medya dosyaları yükeleme izni verilmedi çünkü çoklu-medya öğeleri devredişi yada medya dizini yazılabilir değil.";
$pgv_lang["paste_id_into_field"]	= "Yeni oluşturulan kaydı referans göstermesi için düzeltme alnınızı takip eden ID yapıştırın.";
$pgv_lang["paste_rid_into_field"]	= "Bu havuzu referans göstermesi için düzeltme alnınızı takip eden havuz ID yapıştırın.";
$pgv_lang["record_marked_deleted"]		= "Bu kayıt silinmesi için yönetici tarafından işaretlendi.";
$pgv_lang["replace_with"]			= "İle değiştir";
$pgv_lang["show_changes"]		= "Bu kayıt güncellendi. Değişiklikleri göstermek için burayı tıkla.";
$pgv_lang["thumb_genned"]			= "Tırnak önizleme #thumbnail# otomatikman üretildi.";
$pgv_lang["thumbgen_error"]			= "Tırnak önizleme #thumbnail# otomatikman üretilemedi.";
$pgv_lang["thumbnail"]			= "Tırnak önileme dosyası yükle";
$pgv_lang["title_remote_link"]      = "Uzak Link Ekle";
$pgv_lang["undo"]			= "Geri al";
$pgv_lang["undo_all"]				= "Tüm değişiklikleri geri al";
$pgv_lang["undo_all_confirm"]		= "Bu GEDCOM için tüm değişiklikleri geri almak istediğinizden emin misiniz?";
$pgv_lang["undo_successful"]		= "Başarıyla geri alındı";
$pgv_lang["update_successful"]		= "Başarıyla güncellendi";
$pgv_lang["upload"]					= "Yükle";
$pgv_lang["upload_error"]		= "Dosyanız yüklenirken bir hata oluştu.";
$pgv_lang["copy_error"]				= "#GLOBALS[whichFile2]# dosya #GLOBALS[whichFile1]# dan kopyalanamadı";
$pgv_lang["upload_media"]		= "Medya dosyaları yükle";
$pgv_lang["upload_media_help"]		= "~#pgv_lang[upload_media]#~<br /><br />Yerel bilgisayarınızdan sunucuya yüklemek için dosyaları seçin. Tüm dosyalar dizin <b>#MEDIA_DIRECTORY#</b> veya alt-dizinleri yüklenecektir.<br /><br />Belirttiğiniz dizin adları #MEDIA_DIRECTORY# dizine eklenecektir. FÖrneğin #MEDIA_DIRECTORY#benimailem. Eğer tırnak önizleme dizini mevcut değil ise otomatikman oluşturulacaktır.";
$pgv_lang["upload_successful"]		= "Başarıyla yüklendi.";
$pgv_lang["view_change_diff"]		= "Değişiklik Farkları Görüntüle";

?>
