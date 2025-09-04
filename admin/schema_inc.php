<?php

$tables = [

/* table: pgv_blocks, owner: sysdba */
'pgv_blocks' => "
		b_id I4 PRIMARY,
        b_username C(100),
        b_location C(30),
        b_order I4,
        b_name C(255),
        b_config X
	",

/* table: pgv_dates, owner: sysdba */
'pgv_dates' => "
		d_day I4 NOTNULL,
        d_month C(5),
        d_mon I4 NOTNULL,
        d_year I4 NOTNULL,
        d_julianday1 I4 NOTNULL,
        d_julianday2 I4 NOTNULL,
        d_fact C(15) NOTNULL,
        d_gid C(20) NOTNULL,
        d_file I4 NOTNULL,
        d_type C(13) NOTNULL
	",

/* table: pgv_families, owner: sysdba */
'pgv_families' => "
		f_id C(20) PRIMARY,
        f_file I4 PRIMARY,
        f_husb C(20),
        f_wife C(20),
        f_chil X,
        f_gedcom X,
        f_numchil I4
	",

/* table: pgv_favorites, owner: sysdba */
'pgv_favorites' => "
		fv_id I4 PRIMARY,
        fv_username C(30),
        fv_gid C(20),
        fv_type C(15),
        fv_file C(100),
        fv_url C(255),
        fv_title C(255),
        fv_note X
	",

/* table: pgv_gedcom, owner: sysdba */
'pgv_gedcom' => "
		gedcom_id I4 NOTNULL,
        gedcom_name C(255) NOTNULL
	",

/* table: pgv_gedcom_setting, owner: sysdba */
'pgv_gedcom_setting' => "
		gedcom_id I4 PRIMARY,
        setting_name C(32) PRIMARY,
        setting_value C(255) NOTNULL
	",

/* table: pgv_hit_counter, owner: sysdba */
'pgv_hit_counter' => "
		gedcom_id I4 PRIMARY,
        page_name C(32) PRIMARY,
        page_parameter C(32) PRIMARY,
        page_count I4 NOTNULL
	",

/* table: pgv_individuals, owner: sysdba */
'pgv_individuals' => "
		i_id C(20) PRIMARY,
        i_file I4 PRIMARY,
        i_rin C(20),
        i_isdead I4 NOTNULL,
        i_sex C(1) NOTNULL,
        i_gedcom X NOTNULL
	",

/* table: pgv_ip_address, owner: sysdba */
'pgv_ip_address' => "
		ip_address C(40) PRIMARY,
        category C(32) NOTNULL,
        'comment' C(255) NOTNULL
	",

/* table: pgv_link, owner: sysdba */
'pgv_link' => "
		l_file I4 PRIMARY,
        l_from C(20) PRIMARY,
        l_type C(15) PRIMARY,
        l_to C(20) PRIMARY
	",

/* table: pgv_media, owner: sysdba */
'pgv_media' => "
		m_id I4 PRIMARY,
        m_media C(20),
        m_ext C(6),
        m_titl C(255),
        m_file C(255),
        m_gedfile I4,
        m_gedrec X
	",

/* table: pgv_media_mapping, owner: sysdba */
'pgv_media_mapping' => "
		mm_id I4 PRIMARY,
        mm_media C(20) default '' NOTNULL,
        mm_gid C(20) default '' NOTNULL,
        mm_order I4 default '0' NOTNULL,
        mm_gedfile I4,
        mm_gedrec X
	",

/* table: pgv_messages, owner: sysdba */
'pgv_messages' => "
		m_id I4 PRIMARY,
        m_from C(255),
        m_to C(30),
        m_subject C(255),
        m_body X,
        m_created C(255)
	",

/* table: pgv_module, owner: sysdba */
'pgv_module' => "
		mod_id I4 NOTNULL,
        mod_name C(40) NOTNULL,
        mod_description C(255) NOTNULL,
        mod_taborder I4 NOTNULL,
        mod_menuorder I4 NOTNULL,
        mod_sidebarorder I4 NOTNULL
	",

/* table: pgv_module_privacy, owner: sysdba */
'pgv_module_privacy' => "
		mp_id I4 NOTNULL,
        mp_mod_id I4 NOTNULL,
        mp_file I4 NOTNULL,
        mp_access I4 NOTNULL,
        mp_type C(1) NOTNULL
	",

/* table: pgv_mutex, owner: sysdba */
'pgv_mutex' => "
		mx_id I4 PRIMARY,
        mx_name C(255),
        mx_thread C(255),
        mx_time I4
	",

/* table: pgv_name, owner: sysdba */
'pgv_name' => "
		n_file I4 PRIMARY,
        n_id C(20) PRIMARY,
        n_num I4 PRIMARY,
        n_type C(15) NOTNULL,
        n_sort C(255) NOTNULL,
        n_full C(255) NOTNULL,
        n_list C(255) NOTNULL,
        n_surname C(255),
        n_surn C(255),
        n_givn C(255),
        n_soundex_givn_std C(255),
        n_soundex_surn_std C(255),
        n_soundex_givn_dm C(255),
        n_soundex_surn_dm C(255)
	",

/* table: pgv_news, owner: sysdba */
'pgv_news' => "
		n_id I4 PRIMARY,
        n_username C(100),
        n_date I4,
        n_title C(255),
        n_text X
	",

/* table: pgv_nextid, owner: sysdba */
'pgv_nextid' => "
		ni_id I4,
        ni_type C(15) PRIMARY,
        ni_gedfile I4 PRIMARY
	",

/* table: pgv_other, owner: sysdba */
'pgv_other' => "
		o_id C(20) PRIMARY,
        o_file I4 PRIMARY,
        o_type C(15),
        o_gedcom X
	",

/* table: pgv_placelinks, owner: sysdba */
'pgv_placelinks' => "
		pl_p_id I4 PRIMARY,
        pl_gid C(20) PRIMARY,
        pl_file I4 PRIMARY
	",

/* table: pgv_places, owner: sysdba */
'pgv_places' => "
		p_id I4 PRIMARY,
        p_place C(150),
        p_level I4,
        p_parent_id I4,
        p_file I4,
        p_std_soundex X,
        p_dm_soundex X
	",

/* table: pgv_remotelinks, owner: sysdba */
'pgv_remotelinks' => "
		r_gid C(20) NOTNULL,
        r_linkid C(255),
        r_file I4 NOTNULL
	",

/* table: pgv_site_setting, owner: sysdba */
'pgv_site_setting' => "
		site_setting_name C(32) PRIMARY,
        site_setting_value C(255) NOTNULL
	",

/* table: pgv_sources, owner: sysdba */
'pgv_sources' => "
		s_id C(20) PRIMARY,
        s_file I4 PRIMARY,
        s_name C(255),
        s_gedcom X,
        s_dbid C(1)
	",

/* table: pgv_user, owner: sysdba */
'pgv_user' => "
		user_id I4 NOTNULL,
        user_name C(32) NOTNULL,
        password C(255) NOTNULL
	",

/* table: pgv_user_gedcom_setting, owner: sysdba */
'pgv_user_gedcom_setting' => "
		user_id I4 PRIMARY,
        gedcom_id I4 PRIMARY,
        setting_name C(32) PRIMARY,
        setting_value C(255) NOTNULL
	",

/* table: pgv_user_setting, owner: sysdba */
'pgv_user_setting' => "
		user_id I4 PRIMARY,
        setting_name C(32) PRIMARY,
        setting_value C(255) NOTNULL
	",
];

global $gBitInstaller;

foreach( array_keys( $tables ) AS $tableName ) {
	$gBitInstaller->registerSchemaTable( PHPGEDVIEW_PKG_NAME, $tableName, $tables[$tableName] );
}

$indices = [
	'pgv_blocks_username_idx' => [ 'table' => 'pgv_blocks', 'cols' => 'b_username', 'opts' => null ],
	'pgv_date_day_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_day', 'opts' => null ],
	'pgv_date_fact_gid_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_fact, d_gid', 'opts' => null ],
	'pgv_date_file_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_file', 'opts' => null ],
	'pgv_date_gid_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_gid', 'opts' => null ],
	'pgv_date_julianday1_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_julianday1', 'opts' => null ],
	'pgv_date_julianday2_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_julianday2', 'opts' => null ],
	'pgv_date_mon_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_mon', 'opts' => null ],
	'pgv_date_month_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_month', 'opts' => null ],
	'pgv_date_type_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_type', 'opts' => null ],
	'pgv_date_year_idx' => [ 'table' => 'pgv_dates', 'cols' => 'd_year', 'opts' => null ],
	'pgv_fam_file_idx' => [ 'table' => 'pgv_families', 'cols' => 'f_file', 'opts' => null ],
	'pgv_fam_husb_idx' => [ 'table' => 'pgv_families', 'cols' => 'f_husb', 'opts' => null ],
	'pgv_fam_id_idx' => [ 'table' => 'pgv_families', 'cols' => 'f_id', 'opts' => null ],
	'pgv_fam_wife_idx' => [ 'table' => 'pgv_families', 'cols' => 'f_wife', 'opts' => null ],
	'pgv_favorites_username_idx' => [ 'table' => 'pgv_favorites', 'cols' => 'fv_username', 'opts' => null ],
	'pgv_indi_file_idx' => [ 'table' => 'pgv_individuals', 'cols' => 'i_file', 'opts' => null ],
	'pgv_indi_id_idx' => [ 'table' => 'pgv_individuals', 'cols' => 'i_id', 'opts' => null ],
	'pgv_ux1_idx' => [ 'table' => 'pgv_link', 'cols' => 'l_to, l_file, l_type, l_from', 'opts' => [ 'UNIQUE' ] ],
	'pgv_m_media_idx' => [ 'table' => 'pgv_media', 'cols' => 'm_media', 'opts' => null ],
	'pgv_m_media_file_idx' => [ 'table' => 'pgv_media', 'cols' => 'm_media, m_gedfile', 'opts' => null ],
	'pgv_mm_media_gedfile_idx' => [ 'table' => 'pgv_media_mapping', 'cols' => 'mm_gedfile', 'opts' => null ],
	'pgv_mm_media_gid_idx' => [ 'table' => 'pgv_media_mapping', 'cols' => 'mm_gid, mm_gedfile', 'opts' => null ],
	'pgv_mm_media_id_idx' => [ 'table' => 'pgv_media_mapping', 'cols' => 'mm_media, mm_gedfile', 'opts' => null ],
	'pgv_messages_to_idx' => [ 'table' => 'pgv_messages', 'cols' => 'm_to', 'opts' => null ],
	'pgv_module_privacy_ix1_idx' => [ 'table' => 'pgv_module_privacy', 'cols' => 'mp_mod_id, mp_file, mp_access', 'opts' => null ],
	'pgv_module_privacy_ix2_idx' => [ 'table' => 'pgv_module_privacy', 'cols' => 'mp_mod_id, mp_access', 'opts' => null ],
	'pgv_mutex_name_idx' => [ 'table' => 'pgv_mutex', 'cols' => 'mx_name', 'opts' => null ],
	'pgv_name_file_idx' => [ 'table' => 'pgv_name', 'cols' => 'n_file', 'opts' => null ],
	'pgv_news_username_idx' => [ 'table' => 'pgv_news', 'cols' => 'n_username', 'opts' => null ],
	'pgv_other_file_idx' => [ 'table' => 'pgv_other', 'cols' => 'o_file', 'opts' => null ],
	'pgv_other_id_idx' => [ 'table' => 'pgv_other', 'cols' => 'o_id', 'opts' => null ],
	'pgv_plindex_file_idx' => [ 'table' => 'pgv_placelinks', 'cols' => 'pl_file', 'opts' => null ],
	'pgv_plindex_gid_idx' => [ 'table' => 'pgv_placelinks', 'cols' => 'pl_gid', 'opts' => null ],
	'pgv_plindex_place_idx' => [ 'table' => 'pgv_placelinks', 'cols' => 'pl_p_id', 'opts' => null ],
	'pgv_place_file_idx' => [ 'table' => 'pgv_places', 'cols' => 'p_file', 'opts' => null ],
	'pgv_place_level_idx' => [ 'table' => 'pgv_places', 'cols' => 'p_level', 'opts' => null ],
	'pgv_place_parent_idx' => [ 'table' => 'pgv_places', 'cols' => 'p_parent_id', 'opts' => null ],
	'pgv_place_place_idx' => [ 'table' => 'pgv_places', 'cols' => 'p_place', 'opts' => null ],
	'pgv_r_file_idx' => [ 'table' => 'pgv_remotelinks', 'cols' => 'r_file', 'opts' => null ],
	'pgv_r_gid_idx' => [ 'table' => 'pgv_remotelinks', 'cols' => 'r_gid', 'opts' => null ],
	'pgv_r_link_id_idx' => [ 'table' => 'pgv_remotelinks', 'cols' => 'r_linkid', 'opts' => null ],
	'pgv_sour_dbid_idx' => [ 'table' => 'pgv_sources', 'cols' => 's_dbid', 'opts' => null ],
	'pgv_sour_file_idx' => [ 'table' => 'pgv_sources', 'cols' => 's_file', 'opts' => null ],
	'pgv_sour_id_idx' => [ 'table' => 'pgv_sources', 'cols' => 's_id', 'opts' => null ],
	'pgv_sour_name_idx' => [ 'table' => 'pgv_sources', 'cols' => 's_name', 'opts' => null ],
	'pgv_user_idx' => [ 'table' => 'pgv_user', 'cols' => 'user_name', 'opts' => [ 'UNIQUE' ] ],
	'pgv_site_setting_idx' => [ 'table' => 'pgv_site_setting', 'cols' => 'site_setting_name', 'site_setting_value', 'opts' => [ 'UNIQUE' ] ],
	'pgv_gedcom_idx' => [ 'table' => 'pgv_gedcom', 'cols' => [ 'gedcom_id', 'gedcom_name'], 'opts' => [ 'UNIQUE' ] ],
];
$gBitInstaller->registerSchemaIndexes( PHPGEDVIEW_PKG_NAME, $indices );

$gBitInstaller->registerPackageInfo( PHPGEDVIEW_PKG_NAME, [
	'description' => "Phpgedview is a package for managing gedcom data",
	'license' => '<a href="http://www.gnu.org/licenses/licenses.html#LGPL">LGPL</a>'
] );

// ### Sequences
$sequences = [
	'pgv_gedcom_id_seq' => [ 'start' => 1 ],
	'pgv_module_id_seq' => [ 'start' => 1 ],
	'pgv_module_privacy_id_seq' => [ 'start' => 1 ],
	'pgv_places_id_seq' => [ 'start' => 1 ],
	'pgv_users_id_seq' => [ 'start' => 1 ]
];
$gBitInstaller->registerSchemaSequences( PHPGEDVIEW_PKG_NAME, $sequences );

// ### Default Preferences
$gBitInstaller->registerPreferences( PHPGEDVIEW_PKG_NAME, [
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_title','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_created','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_user','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_hits','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_thumbnail','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_list_thumbnail_size','small'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_list_title','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_list_description','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_list_image_titles','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_default_rows_per_page','5'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_default_cols_per_page','3'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_gallery_default_thumbnail_size','small'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_image_list_title','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_image_list_description','y'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_image_default_thumbnail_size','medium'],
	[ PHPGEDVIEW_PKG_NAME, 'pgv_menu_text','Image Galleries'],
	// more intuitive if we can see all galleries we can upload images to
	[ PHPGEDVIEW_PKG_NAME, 'pgv_show_public_on_upload','n'],
    [ PHPGEDVIEW_PKG_NAME, 'pgv_show_all_to_admins','n'],
] );

// ### Default User Permissions
$gBitInstaller->registerUserPermissions( PHPGEDVIEW_PKG_NAME, [
	['p_pgv_list_galleries', 'Can list image galleries', 'basic', PHPGEDVIEW_PKG_NAME],
	['p_pgv_view', 'Can view image galleries', 'basic', PHPGEDVIEW_PKG_NAME],
	['p_pgv_create', 'Can create an image gallery', 'registered', PHPGEDVIEW_PKG_NAME],
	['p_pgv_update', 'Can update image gallery', 'editors', PHPGEDVIEW_PKG_NAME],
	['p_pgv_upload', 'Can upload images to gallery', 'registered', PHPGEDVIEW_PKG_NAME],
	['p_pgv_admin', 'Can admin image galleries', 'editors', PHPGEDVIEW_PKG_NAME],
	['p_pgv_upload_nonimages', 'Can upload non_image files', 'editors', PHPGEDVIEW_PKG_NAME],
	['p_pgv_change_thumb_size', 'Can set the thumbnail size for a gallery', 'editors', PHPGEDVIEW_PKG_NAME],
	['p_pgv_create_public_gal', 'Can create public galleries any user can load images into', 'editors', PHPGEDVIEW_PKG_NAME],
	['p_pgv_download_gallery_arc',' Can download an archived copy of Fisheye gallery', 'registered', PHPGEDVIEW_PKG_NAME]
] );

if( defined( 'RSS_PKG_NAME' )) {
	$gBitInstaller->registerPreferences( PHPGEDVIEW_PKG_NAME, [
		[ RSS_PKG_NAME, PHPGEDVIEW_PKG_NAME.'_rss', 'y'],
	]);
}

// ### Register content types
$gBitInstaller->registerContentObjects( PHPGEDVIEW_PKG_NAME, [ 
	'GedcomRecord'=>PHPGEDVIEW_PKG_CLASS_PATH.'GedcomRecord.php',
	'Event'=>PHPGEDVIEW_PKG_CLASS_PATH.'Event.php',
	'Family'=>PHPGEDVIEW_PKG_CLASS_PATH.'Family.php',
	'Media'=>PHPGEDVIEW_PKG_CLASS_PATH.'Media.php',
	'Person'=>PHPGEDVIEW_PKG_CLASS_PATH.'Person.php',
] );

// Requirements
$gBitInstaller->registerRequirements( PHPGEDVIEW_PKG_NAME, [
    'liberty' => [ 'min' => '5.0.0' ],
]);

