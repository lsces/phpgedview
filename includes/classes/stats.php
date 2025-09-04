<?php
/**
* GEDCOM Statistics Class
*
* This class provides a quick & easy method for accessing statistics
* about the GEDCOM.
*
* phpGedView: Genealogy Viewer
* Copyright (C) 2002 to 2015 PGV Development Team.  All rights reserved.
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
* @version $Id$
* @author Patrick Kellum
* @package PhpGedView
* @subpackage Lists
*/

namespace Bitweaver\Phpgedview;

define('PGV_CLASS_STATS_PHP', '');

require_once PGV_ROOT.'includes/functions/functions_print_lists.php';

// Methods not allowed to be used in a statistic
define('STATS_NOT_ALLOWED', 'stats,getAllTags,getTags');

class stats {
	public $_gedcom;
	public $_gedcom_url;
	public $_ged_id;
	public $_server_url; // Absolute URL for generating external links.  e.g. in RSS feeds
	public static $_not_allowed = false;
	public static $_media_types = [ 'audio', 'book', 'card', 'certificate', 'coat', 'document', 'electronic', 'magazine', 'manuscript', 'map', 'fiche', 'film', 'newspaper', 'painting', 'photo', 'tombstone', 'video', 'other' ];

	public static $_xencoding = PGV_GOOGLE_CHART_ENCODING;

	public function __construct($gedcom, $server_url='') {
		self::$_not_allowed = explode(',', STATS_NOT_ALLOWED);
		$this->_setGedcom($gedcom);
		$this->_server_url = $server_url;
	}

	public function _setGedcom($gedcom) {
		$this->_gedcom = $gedcom;
		$this->_ged_id = PrintReady(get_id_from_gedcom($gedcom));
		$this->_gedcom_url = encode_url($gedcom);
	}

	/**
	* Return an array of all supported tags and an example of its output.
	*/
	public function getAllTags() {
		$examples = [];
		$methods = get_class_methods('\Bitweaver\Phpgedview\stats');
		$c = count($methods);
		for ($i=0; $i < $c; $i++) {
			if ($methods[$i][0] == '_' || in_array($methods[$i], self::$_not_allowed)) {
				continue;
			}
			$examples[$methods[$i]] = $this->$methods[$i]();
			if (stristr($methods[$i], 'percentage')) {
				$examples[$methods[$i]] .='%';
			}
			if (stristr($methods[$i], 'highlight')) {
				$examples[$methods[$i]]=str_replace( [ ' align="left"', ' align="right"' ], '', $examples[$methods[$i]]);
			}
		}
		ksort($examples);
		return $examples;
	}

	/**
	* Return a string of all supported tags and an example of its output in table row form.
	*/
	public function getAllTagsTable() {
		global $TEXT_DIRECTION;
		$examples = [];
		$methods = get_class_methods($this);
		$c = count($methods);
		for ($i=0; $i < $c; $i++) {
			if (in_array($methods[$i], self::$_not_allowed) || $methods[$i][0] == '_' || $methods[$i] == 'getAllTagsTable' || $methods[$i] == 'getAllTagsText') {
				continue;
			} // Include this method name to prevent bad stuff happening
			$examples[$methods[$i]] = $this->$methods[$i]();
			if (stristr($methods[$i], 'percentage')) {
				$examples[$methods[$i]] .='%';
			}
			if (stristr($methods[$i], 'highlight')) {
				$examples[$methods[$i]]=str_replace( [ ' align="left"', ' align="right"' ], '', $examples[$methods[$i]]);
			}
		}
		$out = '';
		if ($TEXT_DIRECTION=='ltr') {
			$alignVar = 'right';
			$alignRes = 'left';
		} else {
			$alignVar = 'left';
			$alignRes = 'right';
		}
		foreach ($examples as $tag=>$v) {
			$out .= "\t<tr class=\"vevent\">"
				."<td class=\"list_value_wrap\" align=\"{$alignVar}\" valign=\"top\" style=\"padding:3px\">{$tag}</td>"
				."<td class=\"list_value_wrap\" align=\"{$alignRes}\" valign=\"top\">{$v}</td>"
				."</tr>\n"
			;
		}
		return $out;
	}

	/**
	* Return a string of all supported tags in plain text.
	*/
	public function getAllTagsText() {
		$examples=[];
		$methods=get_class_methods($this);
		$c=count($methods);
		for ($i=0; $i < $c; $i++) {
			if (in_array($methods[$i], self::$_not_allowed) || $methods[$i][0] == '_' || $methods[$i] == 'getAllTagsTable' || $methods[$i] == 'getAllTagsText') {continue;} // Include this method name to prevent bad stuff happining
			$examples[$methods[$i]] = $methods[$i];
		}
		$out = '';
		foreach ($examples as $tag=>$v) {
			$out .= "{$tag}<br />\n";
		}
		return $out;
	}

	/*
	* Get tags and their parsed results.
	*/
	public function getTags($text) {
		global $pgv_lang, $factarray;
		static $funcs;

		// Retrive all class methods
		isset($funcs) or $funcs = get_class_methods($this);

		// Extract all tags from the provided text
		$ct = preg_match_all("/#(.+)#/U", (string)$text, $match);
		$tags = $match[1];
		$c = count($tags);
		$new_tags = []; // tag to replace
		$new_values = []; // value to replace it with

		/*
		* Parse block tags.
		*/
		for($i=0; $i < $c; $i++)
		{
			$full_tag = $tags[$i];
			// Added for new parameter support
			$params = explode(':', $tags[$i]);
			if (count($params) > 1) {
				$tags[$i] = array_shift($params);
			} else {
				$params = null;
			}

			// Skip non-tags and non-allowed tags
			if ($tags[$i][0] == '_' || in_array($tags[$i], self::$_not_allowed)) {continue;}

			// Generate the replacement value for the tag
			if (method_exists($this, $tags[$i]))
			{
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = $this->$tags[$i]($params);
			}
			elseif ($tags[$i] == 'help')
			{
				// re-merge, just in case
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = print_help_link(join(':', $params), 'qm', '', false, true);
			}
			/*
			* Parse language variables.
			*/
			// pgv_lang - long
			elseif ($tags[$i] == 'lang')
			{
				// re-merge, just in case
				$params = join(':', $params);
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = print_text($pgv_lang[$params], 0, 2);
			}
			// pgv_lang
			elseif (isset($pgv_lang[$tags[$i]]))
			{
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = print_text($pgv_lang[$tags[$i]], 0, 2);
			}
			// factarray
			elseif (isset($factarray[$tags[$i]]))
			{
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = $factarray[$tags[$i]];
			}
			// GLOBALS
			elseif (isset($GLOBALS[$tags[$i]]))
			{
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = $GLOBALS[$tags[$i]];
			}
			// CONSTANTS
			elseif (substr($tags[$i], 0, 4) == 'PGV_' & defined($tags[$i]))
			{
				$new_tags[] = "#{$full_tag}#";
				$new_values[] = constant($tags[$i]);
			}
			// OLD GLOBALS THAT ARE NOW CONSTANTS
			elseif (defined("PGV_{$tags[$i]}"))
			{
				$new_tags[] = "#PGV_{$tags[$i]}#";
				$new_values[] = constant("PGV_{$tags[$i]}");
			}
		}
		unset($tags);
		return [ $new_tags, $new_values ];
	}

///////////////////////////////////////////////////////////////////////////////
// GEDCOM                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function gedcomFilename() {return get_gedcom_from_id($this->_ged_id);}

	public function gedcomID() {return $this->_ged_id;}

	public function gedcomTitle() {return PrintReady(get_gedcom_setting($this->_ged_id, 'title'));}

	public function _gedcomHead() {
		$title = "";
		$version = '';
		$source = '';
		static $cache=null;
		if (is_array($cache)) {
			return $cache;
		}
		$head=find_other_record('HEAD', $this->_ged_id);
		$ct=preg_match("/1 SOUR (.*)/", $head, $match);
		if ($ct > 0) {
			$softrec=get_sub_record(1, '1 SOUR', $head);
			$tt=preg_match("/2 NAME (.*)/", $softrec, $tmatch);
			$title = ( $tt > 0 ) ? trim( $tmatch[1] ) : trim( $match[1] );
			if (!empty( $title )) {
				$tt = preg_match( "/2 VERS (.*)/", $softrec, $tmatch );
				$version = ( $tt > 0 ) ? trim( $tmatch[1] ) : '';
			}
			else {
				$version = '';
			}
			$tt = preg_match( "/1 SOUR (.*)/", $softrec, $tmatch );
			$source = ( $tt > 0 ) ? trim( $tmatch[1] ) : trim( $match[1] );
		}
		$cache = [ $title, $version, $source ];
		return $cache;
	}

	public function gedcomCreatedSoftware()
	{
		$head = self::_gedcomHead();
		return $head[0];
	}

	public function gedcomCreatedVersion()
	{
		$head = self::_gedcomHead();
		// fix broken version string in Family Tree Maker
		if (strstr( $head[1], 'Family Tree Maker ' )) {
			$p = strpos( $head[1], '(' ) + 1;
			$p2 = strpos( $head[1], ')' );
			$head[1] = substr( $head[1], $p, $p2 - $p );
		}
		// Fix EasyTree version
		if ($head[2] == 'EasyTree') {
			$head[1] = substr( $head[1], 1 );
		}
		return $head[1];
	}

	public function gedcomDate()
	{
		global $DATE_FORMAT;

		$head = find_other_record( 'HEAD', $this->_ged_id );
		if (preg_match( "/1 DATE (.+)/", $head, $match )) {
			$date = new GedcomDate( $match[1] );
			return $date->Display( false, $DATE_FORMAT ); // Override $PUBLIC_DATE_FORMAT
		}
		return '';
	}

	public function gedcomUpdated()
	{
		global $TBLPREFIX, $gBitDb;

		$row =
			$gBitDb->getOne(
				"SELECT d_year, d_month, d_day FROM {$TBLPREFIX}dates WHERE d_file=? AND d_fact=? ORDER BY d_julianday1 DESC, d_type"
				, [ $this->_ged_id, 'CHAN' ] );
		if ($row) {
			$date = new GedcomDate( "{$row->d_day} {$row->d_month} {$row->d_year}" );
			return $date->Display( false );
		}
		else {
			return self::gedcomDate();
		}
	}

	public function gedcomHighlight()
	{
		$highlight = false;
		if (file_exists( "images/gedcoms/{$this->_gedcom}.jpg" )) {
			$highlight = "images/gedcoms/{$this->_gedcom}.jpg";
		}
		elseif (file_exists( "images/gedcoms/{$this->_gedcom}.png" )) {
			$highlight = "images/gedcoms/{$this->_gedcom}.png";
		}
		if (!$highlight) {
			return '';
		}
		$imgsize = findImageSize( $highlight );
		return "<a href=\"" . encode_url( "{$this->_server_url}index.php?ctype=gedcom&ged={$this->_gedcom_url}" ) . "\" style=\"border-style:none;\"><img src=\"{$highlight}\" {$imgsize[3]} style=\"border:none; padding:2px 6px 2px 2px;\" class=\"gedcom_highlight\" alt=\"\" /></a>";
	}

	public function gedcomHighlightLeft()
	{
		$highlight = false;
		if (file_exists( "images/gedcoms/{$this->_gedcom}.jpg" )) {
			$highlight = "images/gedcoms/{$this->_gedcom}.jpg";
		}
		else {
			if (file_exists( "images/gedcoms/{$this->_gedcom}.png" )) {
				$highlight = "images/gedcoms/{$this->_gedcom}.png";
			}
		}
		if (!$highlight) {
			return '';
		}
		$imgsize = findImageSize( $highlight );
		return "<a href=\"" . encode_url( "{$this->_server_url}index.php?ctype=gedcom&ged={$this->_gedcom_url}" ) . "\" style=\"border-style:none;\"><img src=\"{$highlight}\" {$imgsize[3]} style=\"border:none; padding:2px 6px 2px 2px;\" align=\"left\" class=\"gedcom_highlight\" alt=\"\" /></a>";
	}

	public function gedcomHighlightRight()
	{
		$highlight = false;
		if (file_exists( "images/gedcoms/{$this->_gedcom}.jpg" )) {
			$highlight = "images/gedcoms/{$this->_gedcom}.jpg";
		}
		else {
			if (file_exists( "images/gedcoms/{$this->_gedcom}.png" )) {
				$highlight = "images/gedcoms/{$this->_gedcom}.png";
			}
		}
		if (!$highlight) {
			return '';
		}
		$imgsize = findImageSize( $highlight );
		return "<a href=\"" . encode_url( "{$this->_server_url}index.php?ctype=gedcom&ged={$this->_gedcom_url}" ) . "\" style=\"border-style:none;\"><img src=\"{$highlight}\" {$imgsize[3]} style=\"border:none; padding:2px 6px 2px 2px;\" align=\"right\" class=\"gedcom_highlight\" alt=\"\" /></a>";
	}

	///////////////////////////////////////////////////////////////////////////////
// Totals                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function _getPercentage( $total, $type )
	{
		$per = null;
		switch ($type) {
			default:
			case 'all':
				$type = $this->totalIndividuals() + $this->totalFamilies() + $this->totalSources() + $this->totalOtherRecords();
				break;
			case 'individual':
				$type = $this->totalIndividuals();
				break;
			case 'family':
				$type = $this->totalFamilies();
				break;
			case 'source':
				$type = $this->totalSources();
				break;
			case 'note':
				$type = $this->totalNotes();
				break;
			case 'other':
				$type = $this->totalOtherRecords();
				break;
		}
		$per = ( $type > 0 ) ? round( 100 * $total / $type, 2 ) : 0;
		return $per;
	}

	public function totalRecords()
	{
		return $this->totalIndividuals() + $this->totalFamilies() + $this->totalSources() + $this->totalOtherRecords();
	}

	public function totalIndividuals(): int
	{
		global $TBLPREFIX, $gBitDb;

		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=?"
				, [ $this->_ged_id ] );
	}

	public function totalIndisWithSources()
	{
		global $TBLPREFIX, $DBTYPE, $gBitDb;
		$rows = ( $DBTYPE == 'sqlite' ) ? $gBitDb->getAll( "SELECT COUNT(i_id) AS tot FROM {$TBLPREFIX}individuals WHERE i_file=" . $this->_ged_id . " AND i_gedcom LIKE '%SOUR @%'" ) : $gBitDb->getAll( "SELECT COUNT(DISTINCT i_id) AS tot FROM {$TBLPREFIX}link, {$TBLPREFIX}individuals WHERE i_id=l_from AND i_file=l_file AND l_file=" . $this->_ged_id . " AND l_type='SOUR'" );
		return $rows[0]['tot'];
	}

	public function chartIndisWithSources( $params = null )
	{
		global $pgv_lang, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$sizes = explode( 'x', $size );
		$tot_indi = $this->totalIndividuals();
		if ($tot_indi == 0) {
			return '';
		}
		else {
			$tot_sindi = $this->totalIndisWithSources();
			$tot_indi_per = round( 100 * ( $tot_indi - $tot_sindi ) / $tot_indi, 2 );
			$tot_sindi_per = round( 100 * $tot_sindi / $tot_indi, 2 );
		}
		$chd = self::_array_to_extended_encoding( [ $tot_sindi_per, 100 - $tot_sindi_per ] );
		$chl = $pgv_lang["with_sources"] . ' - ' . round( $tot_sindi_per, 1 ) . '%|' .
			$pgv_lang["without_sources"] . ' - ' . round( $tot_indi_per, 1 ) . '%';
		$chart_title = $pgv_lang["with_sources"] . ' [' . round( $tot_sindi_per, 1 ) . '%], ' .
			$pgv_lang["without_sources"] . ' [' . round( $tot_indi_per, 1 ) . '%]';
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
	}

	public function totalIndividualsPercentage()
	{
		return $this->_getPercentage( $this->totalIndividuals(), 'all' );
	}

	public function totalFamilies(): int
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}families WHERE f_file=?"
				, [ $this->_ged_id ] );
	}

	public function totalFamsWithSources()
	{
		global $TBLPREFIX, $DBTYPE, $gBitDb;
		$rows = ( $DBTYPE == 'sqlite' ) ? $gBitDb->getAll( "SELECT COUNT(f_id) AS tot FROM {$TBLPREFIX}families WHERE f_file=" . $this->_ged_id . " AND f_gedcom LIKE '%SOUR @%'" ) : $gBitDb->getAll( "SELECT COUNT(DISTINCT f_id) AS tot FROM {$TBLPREFIX}link, {$TBLPREFIX}families WHERE f_id=l_from AND f_file=l_file AND l_file=" . $this->_ged_id . " AND l_type='SOUR'" );
		return $rows[0]['tot'];
	}

	public function chartFamsWithSources( $params = null )
	{
		global $pgv_lang, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$sizes = explode( 'x', $size );
		$tot_fam = $this->totalFamilies();
		$tot_sfam = $this->totalFamsWithSources();
		if ($tot_fam == 0) {
			return '';
		}
		else {
			$tot_fam_per = round( 100 * ( $tot_fam - $tot_sfam ) / $tot_fam, 2 );
			$tot_sfam_per = round( 100 * $tot_sfam / $tot_fam, 2 );
		}
		$chd = self::_array_to_extended_encoding( [ $tot_sfam_per, 100 - $tot_sfam_per ] );
		$chl = $pgv_lang["with_sources"] . ' - ' . round( $tot_sfam_per, 1 ) . '%|' .
			$pgv_lang["without_sources"] . ' - ' . round( $tot_fam_per, 1 ) . '%';
		$chart_title = $pgv_lang["with_sources"] . ' [' . round( $tot_sfam_per, 1 ) . '%], ' .
			$pgv_lang["without_sources"] . ' [' . round( $tot_fam_per, 1 ) . '%]';
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
	}

	public function totalFamiliesPercentage()
	{
		return $this->_getPercentage( $this->totalFamilies(), 'all' );
	}

	public function totalSources(): int
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}sources WHERE s_file=?"
				, [ $this->_ged_id ] );
	}

	public function totalSourcesPercentage()
	{
		return $this->_getPercentage( $this->totalSources(), 'all' );
	}

	public function totalNotes()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}other WHERE o_type=? AND o_file=?"
				, [ 'NOTE', $this->_ged_id ] );
	}

	public function totalNotesPercentage()
	{
		return $this->_getPercentage( $this->totalNotes(), 'all' );
	}

	public function totalOtherRecords(): int
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}other WHERE o_type<>? AND o_file=?"
				, [ 'NOTE', $this->_ged_id ] );
	}

	public function totalOtherPercentage()
	{
		return $this->_getPercentage( $this->totalOtherRecords(), 'all' );
	}

	public function totalSurnames( $params = null )
	{
		global $DBTYPE, $TBLPREFIX, $gBitDb;
		if ($params) {
			$qs = implode( ',', array_fill( 0, count( $params ), '?' ) );
			$opt = "IN ({$qs})";
			$vars = $params;
			$distinct = '';
			$group_by = '';
		}
		else {
			$opt = "IS NOT NULL";
			$vars = [];
			$distinct = 'DISTINCT';
			$group_by = '';
		}
		$vars[] = $this->_ged_id;
		return (int) 
			$gBitDb->getOne(
				"SELECT COUNT({$distinct} n_surn) FROM {$TBLPREFIX}name WHERE n_surn {$opt} AND n_file=? {$group_by}"
				, $vars );
	}

	public function totalGivennames( $params = null )
	{
		global $DBTYPE, $TBLPREFIX, $gBitDb;
		if ($params) {
			$qs = implode( ',', array_fill( 0, count( $params ), '?' ) );
			$opt = "IN ({$qs})";
			$vars = $params;
			$distinct = '';
			$group_by = '';
		}
		else {
			$opt = "IS NOT NULL";
//			$vars = '';
			$distinct = 'DISTINCT';
			$group_by = '';
		}
		$vars[] = $this->_ged_id;
		return (int) 
			$gBitDb->getOne(
				"SELECT COUNT({$distinct} n_givn) FROM {$TBLPREFIX}name WHERE n_givn {$opt} AND n_file=? {$group_by}"
				, $vars );
	}

	public function totalEvents( $params = null )
	{
		global $TBLPREFIX, $gBitDb;

		$sql = "SELECT COUNT(*) AS tot FROM {$TBLPREFIX}dates WHERE d_file=?";
		$vars = [ $this->_ged_id ];

		$no_types = [ 'HEAD', 'CHAN' ];
		if ($params) {
			$types = [];
			foreach ( $params as $type ) {
				if (substr( $type, 0, 1 ) == '!') {
					$no_types[] = substr( $type, 1 );
				}
				else {
					$types[] = $type;
				}
			}
			if ($types) {
				$sql .= ' AND d_fact IN (' . implode( ', ', array_fill( 0, count( $types ), '?' ) ) . ')';
				$vars = array_merge( $vars, $types );
			}
		}
		$sql .= ' AND d_fact NOT IN (' . implode( ', ', array_fill( 0, count( $no_types ), '?' ) ) . ')';
		$vars = array_merge( $vars, $no_types );
		return $gBitDb->getOne( $sql, $vars );
	}

	public function totalEventsBirth()
	{
		return $this->totalEvents( explode( '|', PGV_EVENTS_BIRT ) );
	}

	public function totalBirths()
	{
		return $this->totalEvents( [ 'BIRT' ] );
	}

	public function totalEventsDeath()
	{
		return $this->totalEvents( explode( '|', PGV_EVENTS_DEAT ) );
	}

	public function totalDeaths()
	{
		return $this->totalEvents( [ 'DEAT' ] );
	}

	public function totalEventsMarriage()
	{
		return $this->totalEvents( explode( '|', PGV_EVENTS_MARR ) );
	}

	public function totalMarriages()
	{
		return $this->totalEvents( [ 'MARR' ] );
	}

	public function totalEventsDivorce()
	{
		return $this->totalEvents( explode( '|', PGV_EVENTS_DIV ) );
	}

	public function totalDivorces()
	{
		return $this->totalEvents( [ 'DIV' ] );
	}

	public function totalEventsOther()
	{
		$facts = array_merge( explode( '|', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT ) );
		$no_facts = [];
		foreach ( $facts as $fact ) {
			$fact = '!' . str_replace( '\'', '', $fact );
			$no_facts[] = $fact;
		}
		return $this->totalEvents( $no_facts );
	}

	public function totalSexMales()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_sex=?"
				, [ $this->_ged_id, 'M' ] );
	}

	public function totalSexMalesPercentage()
	{
		return $this->_getPercentage( $this->totalSexMales(), 'individual' );
	}

	public function totalSexFemales()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_sex=?"
				, [ $this->_ged_id, 'F' ] );
	}

	public function totalSexFemalesPercentage()
	{
		return $this->_getPercentage( $this->totalSexFemales(), 'individual' );
	}

	public function totalSexUnknown()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_sex=?"
				, [ $this->_ged_id, 'U' ] );
	}

	public function totalSexUnknownPercentage()
	{
		return $this->_getPercentage( $this->totalSexUnknown(), 'individual' );
	}

	public function chartSex( $params = null )
	{
		global $pgv_lang, $TEXT_DIRECTION, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_female = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : 'ffd1dc';
		$color_male = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : '84beff';
		$color_unknown = ( isset( $params[3] ) && $params[3] != '' ) ? strtolower( $params[3] ) : '777777';
		$sizes = explode( 'x', $size );
		$tot_f = $this->totalSexFemalesPercentage();
		$tot_m = $this->totalSexMalesPercentage();
		$tot_u = $this->totalSexUnknownPercentage();
		if ($tot_f == 0 && $tot_m == 0 && $tot_u == 0) {
			return '';
		}
		else if ($tot_u > 0) {
			$chd = self::_array_to_extended_encoding( [ $tot_u, $tot_f, $tot_m ] );
			$chl =
				$pgv_lang['stat_unknown'] . ' - ' . round( $tot_u, 1 ) . '%|' .
				$pgv_lang['stat_females'] . ' - ' . round( $tot_f, 1 ) . '%|' .
				$pgv_lang['stat_males'] . ' - ' . round( $tot_m, 1 ) . '%';
			$chart_title =
				$pgv_lang['stat_males'] . ' [' . round( $tot_m, 1 ) . '%], ' .
				$pgv_lang['stat_females'] . ' [' . round( $tot_f, 1 ) . '%], ' .
				$pgv_lang['stat_unknown'] . ' [' . round( $tot_u, 1 ) . '%]';
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_unknown},{$color_female},{$color_male}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
		}
		else {
			$chd = self::_array_to_extended_encoding( [ $tot_f, $tot_m ] );
			$chl =
				$pgv_lang['stat_females'] . ' - ' . round( $tot_f, 1 ) . '%|' .
				$pgv_lang['stat_males'] . ' - ' . round( $tot_m, 1 ) . '%';
			$chart_title = $pgv_lang['stat_males'] . ' [' . round( $tot_m, 1 ) . '%], ' .
				$pgv_lang['stat_females'] . ' [' . round( $tot_f, 1 ) . '%]';
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_female},{$color_male}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
		}
	}

	public function totalLiving()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_isdead=?"
				, [ $this->_ged_id, 0 ] );
	}

	public function totalLivingPercentage()
	{
		return $this->_getPercentage( $this->totalLiving(), 'individual' );
	}

	public function totalDeceased()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_isdead=?"
				, [ $this->_ged_id, 1 ] );
	}

	public function totalDeceasedPercentage()
	{
		return $this->_getPercentage( $this->totalDeceased(), 'individual' );
	}

	public function totalMortalityUnknown()
	{
		global $TBLPREFIX, $gBitDb;
		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}individuals WHERE i_file=? AND i_isdead=?"
				, [ $this->_ged_id, -1 ] );
	}

	public function totalMortalityUnknownPercentage()
	{
		return $this->_getPercentage( $this->totalMortalityUnknown(), 'individual' );
	}

	public function mortalityUnknown()
	{
		global $TBLPREFIX, $gBitDb;
		$rows = $gBitDb->getAll( "SELECT i_id AS id FROM {$TBLPREFIX}individuals WHERE i_file={$this->_ged_id} AND i_isdead=-1" );
		if (!isset( $rows[0] )) {
			return '';
		}
		return $rows;
	}

	public function chartMortality( $params = null )
	{
		global $pgv_lang, $TEXT_DIRECTION, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_living = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : 'ffffff';
		$color_dead = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : 'cccccc';
		$color_unknown = ( isset( $params[3] ) && $params[3] != '' ) ? strtolower( $params[3] ) : '777777';
		$sizes = explode( 'x', $size );
		$tot_l = $this->totalLivingPercentage();
		$tot_d = $this->totalDeceasedPercentage();
		$tot_u = $this->totalMortalityUnknownPercentage();
		if ($tot_l == 0 && $tot_d == 0 && $tot_u == 0) {
			return '';
		}
		else if ($tot_u > 0) {
			$chd = self::_array_to_extended_encoding( [ $tot_u, $tot_l, $tot_d ] );
			$chl =
				$pgv_lang['total_unknown'] . ' - ' . round( $tot_u, 1 ) . '%|' .
				$pgv_lang['total_living'] . ' - ' . round( $tot_l, 1 ) . '%|' .
				$pgv_lang['total_dead'] . ' - ' . round( $tot_d, 1 ) . '%';
			$chart_title =
				$pgv_lang['total_living'] . ' [' . round( $tot_l, 1 ) . '%], ' .
				$pgv_lang['total_dead'] . ' [' . round( $tot_d, 1 ) . '%], ' .
				$pgv_lang['total_unknown'] . ' [' . round( $tot_u, 1 ) . '%]';
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_unknown},{$color_living},{$color_dead}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
		}
		else {
			$chd = self::_array_to_extended_encoding( [ $tot_l, $tot_d ] );
			$chl =
				$pgv_lang['total_living'] . ' - ' . round( $tot_l, 1 ) . '%|' .
				$pgv_lang['total_dead'] . ' - ' . round( $tot_d, 1 ) . '%|';
			$chart_title = $pgv_lang['total_living'] . ' [' . round( $tot_l, 1 ) . '%], ' .
				$pgv_lang['total_dead'] . ' [' . round( $tot_d, 1 ) . '%]';
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_living},{$color_dead}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
		}
	}

	public static function totalUsers( $params = null )
	{
		if (!empty( $params[0] )) {
			return get_user_count() + (int) $params[0];
		}
		else {
			return get_user_count();
		}
	}

	public static function totalAdmins()
	{
		return get_admin_user_count();
	}

	public static function totalNonAdmins()
	{
		return get_non_admin_user_count();
	}

	public function _totalMediaType( $type = 'all' )
	{
		global $TBLPREFIX, $MULTI_MEDIA, $gBitDb;

		if (!$MULTI_MEDIA || !in_array( $type, self::$_media_types ) && $type != 'all' && $type != 'unknown') {
			return 0;
		}
		$sql = "SELECT COUNT(*) AS tot FROM {$TBLPREFIX}media WHERE m_gedfile=?";
		$vars = [ $this->_ged_id ];

		if ($type != 'all') {
			if ($type == 'unknown') {
				// There has to be a better way then this :(
				foreach ( self::$_media_types as $t ) {
					$sql .= " AND m_gedrec NOT LIKE ? AND m_gedrec NOT LIKE ?";
					$vars[] = "%3 TYPE {$t}%";
					$vars[] = "%1 _TYPE {$t}%";
				}
			}
			else {
				$sql .= " AND m_gedrec LIKE ? AND m_gedrec LIKE ?";
				$vars[] = "%3 TYPE {$type}%";
				$vars[] = "%1 _TYPE {$type}%";
			}
		}
		return $gBitDb->getOne( $sql, $vars );
	}

	public function totalMedia()
	{
		return $this->_totalMediaType( 'all' );
	}

	public function totalMediaAudio()
	{
		return $this->_totalMediaType( 'audio' );
	}

	public function totalMediaBook()
	{
		return $this->_totalMediaType( 'book' );
	}

	public function totalMediaCard()
	{
		return $this->_totalMediaType( 'card' );
	}

	public function totalMediaCertificate()
	{
		return $this->_totalMediaType( 'certificate' );
	}

	public function totalMediaCoatOfArms()
	{
		return $this->_totalMediaType( 'coat' );
	}

	public function totalMediaDocument()
	{
		return $this->_totalMediaType( 'document' );
	}

	public function totalMediaElectronic()
	{
		return $this->_totalMediaType( 'electronic' );
	}

	public function totalMediaMagazine()
	{
		return $this->_totalMediaType( 'magazine' );
	}

	public function totalMediaManuscript()
	{
		return $this->_totalMediaType( 'manuscript' );
	}

	public function totalMediaMap()
	{
		return $this->_totalMediaType( 'map' );
	}

	public function totalMediaFiche()
	{
		return $this->_totalMediaType( 'fiche' );
	}

	public function totalMediaFilm()
	{
		return $this->_totalMediaType( 'film' );
	}

	public function totalMediaNewspaper()
	{
		return $this->_totalMediaType( 'newspaper' );
	}

	public function totalMediaPainting()
	{
		return $this->_totalMediaType( 'painting' );
	}

	public function totalMediaPhoto()
	{
		return $this->_totalMediaType( 'photo' );
	}

	public function totalMediaTombstone()
	{
		return $this->_totalMediaType( 'tombstone' );
	}

	public function totalMediaVideo()
	{
		return $this->_totalMediaType( 'video' );
	}

	public function totalMediaOther()
	{
		return $this->_totalMediaType( 'other' );
	}

	public function totalMediaUnknown()
	{
		return $this->_totalMediaType( 'unknown' );
	}

	public function chartMedia( $params = null )
	{
		global $pgv_lang, $TEXT_DIRECTION, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$sizes = explode( 'x', $size );
		$tot = $this->_totalMediaType( 'all' );
		// Beware divide by zero
		if ($tot == 0)
			return $pgv_lang["none"];
		// Build a table listing only the media types actually present in the GEDCOM
		$mediaCounts = [];
		$mediaTypes = "";
		$chart_title = "";
		$c = 0;
		$max = 0;
		foreach ( self::$_media_types as $type ) {
			$count = $this->_totalMediaType( $type );
			if ($count > 0) {
				$media[$type] = $count;
				if ($count > $max) {
					$max = $count;
				}
				$c += $count;
			}
		}
		$count = $this->totalMediaUnknown();
		if ($count > 0) {
			$media['unknown'] = $tot - $c;
			if ($tot - $c > $max) {
				$max = $count;
			}
		}
		if (( $max / $tot ) > 0.6 && count( $media ) > 10) {
			arsort( $media );
			$media = array_slice( $media, 0, 10 );
			$c = $tot;
			foreach ( $media as $cm ) {
				$c -= $cm;
			}
			if (isset( $media['other'] )) {
				$media['other'] += $c;
			}
			else {
				$media['other'] = $c;
			}
		}
		asort( $media );
		foreach ( $media as $type => $count ) {
			$mediaCounts[] = round( 100 * $count / $tot, 0 );
			if (isset( $pgv_lang['TYPE__' . $type] )) {
				$mediaTypes .= $pgv_lang['TYPE__' . $type] . ' - ' . $count . '|';
				$chart_title .= $pgv_lang['TYPE__' . $type] . ' [' . $count . '], ';
			}
			else {
				$mediaTypes .= $pgv_lang['unknown'] . ' - ' . $count . '|';
				$chart_title .= $pgv_lang['unknown'] . ' [' . $count . '], ';
			}
		}
		$chart_title = substr( $chart_title, 0, -2 );
		$chd = self::_array_to_extended_encoding( $mediaCounts );
		$chl = substr( $mediaTypes, 0, -1 );
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
	}

	///////////////////////////////////////////////////////////////////////////////
// Birth & Death                                                             //
///////////////////////////////////////////////////////////////////////////////

	public function _mortalityQuery( $type = 'full', $life_dir = 'ASC', $birth_death = 'BIRT' )
	{
		global $TBLPREFIX, $pgv_lang, $SHOW_ID_NUMBERS, $listDir, $DBTYPE, $TEXT_DIRECTION, $gBitDb;
		if ($birth_death == 'MARR') {
			$query_field = "'" . str_replace( '|', "','", PGV_EVENTS_MARR ) . "'";
		}
		else if ($birth_death == 'DIV') {
			$query_field = "'" . str_replace( '|', "','", PGV_EVENTS_DIV ) . "'";
		}
		else if ($birth_death == 'BIRT') {
			$query_field = "'" . str_replace( '|', "','", PGV_EVENTS_BIRT ) . "'";
		}
		else {
			$birth_death = 'DEAT';
			$query_field = "'" . str_replace( '|', "','", PGV_EVENTS_DEAT ) . "'";
		}
		if ($life_dir == 'ASC') {
			$dmod = 'MIN';
		}
		else {
			$dmod = 'MAX';
			$life_dir = 'DESC';
		}
		switch ($DBTYPE) {
			// Testing new style
			default: {
				$rows = $gBitDb->getAll(
					' SELECT'
					. ' d2.d_year,'
					. ' d2.d_type,'
					. ' d2.d_fact,'
					. ' d2.d_gid'
					. ' FROM'
					. " {$TBLPREFIX}dates AS d2"
					. ' WHERE'
					. " d2.d_file={$this->_ged_id} AND"
					. " d2.d_fact IN ({$query_field}) AND"
					. ' d2.d_julianday1=('
					. ' SELECT'
					. " {$dmod}(d1.d_julianday1)"
					. ' FROM'
					. " {$TBLPREFIX}dates AS d1"
					. ' WHERE'
					. " d1.d_file={$this->_ged_id} AND"
					. " d1.d_fact IN ({$query_field}) AND"
					. ' d1.d_julianday1!=0'
					. ' )'
					. ' ORDER BY'
					. " d_julianday1 {$life_dir}, d_type"
				);
				break;
			}
			// MySQL 4.0 can't handle nested queries, so we use the old style. Of course this hits the performance of PHP4 users a tiny bit, but it's the best we can do.
			case 'mysql':
			case 'sqlite': {
				$rows = $gBitDb->getAll(
					' SELECT'
					. ' d_year,'
					. ' d_type,'
					. ' d_fact,'
					. ' d_gid'
					. ' FROM'
					. " {$TBLPREFIX}dates"
					. ' WHERE'
					. " d_file={$this->_ged_id} AND"
					. " d_fact IN ({$query_field}) AND"
					. ' d_julianday1!=0'
					. ' ORDER BY'
					. " d_julianday1 {$life_dir},"
					. ' d_type ASC'
				);
				break;
			}
		}
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		$record = GedcomRecord::getInstance( $row['d_gid'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( $record->canDisplayDetails() ) ? $record->format_list( 'span', false, $record->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'year':
				$date = new GedcomDate( $row['d_type'] . ' ' . $row['d_year'] );
				$result = $date->Display( true );
				break;
			case 'name':
				$id = '';
				if ($SHOW_ID_NUMBERS) {
					$id = ( $listDir == 'rtl' || $TEXT_DIRECTION == 'rtl' ) ? "&nbsp;&nbsp;" . getRLM() . "({$row['d_gid']})" . getRLM() : "&nbsp;&nbsp;({$row['d_gid']})";
				}
				$result = "<a href=\"" . $record->getLinkUrl() . "\">" . $record->getFullName() . "{$id}</a>";
				break;
			case 'place':
				$result = format_fact_place( GedcomRecord::getInstance( $row['d_gid'] )->getFactByType( $row['d_fact'] ), true, true, true );
				break;
		}
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function _statsPlaces( $what = 'ALL', $fact = false, $parent = 0, $country = false )
	{
		global $TBLPREFIX, $gBitDb;
		if ($fact) {
			if ($what == 'INDI') {
				$rows =
					$gBitDb->query(
						"SELECT i_gedcom AS ged FROM {$TBLPREFIX}individuals WHERE i_file=?"
						, [ $this->_ged_id ] );
			}
			else if ($what == 'FAM') {
				$rows =
					$gBitDb->query(
						"SELECT f_gedcom AS ged FROM {$TBLPREFIX}families WHERE f_file=?"
						, [ $this->_ged_id ] );
			}
			$placelist = [];
			while ( $row = $rows->fetchRow() ) {
				$factrec = trim( get_sub_record( 1, "1 {$fact}", $row['ged'], 1 ) );
				if (!empty( $factrec ) && preg_match( "/2 PLAC (.+)/", $factrec, $match )) {
					$place = $country ? getPlaceCountry( trim( $match[1] ) ) : trim( $match[1] );
					if (!isset( $placelist[$place] )) {
						$placelist[$place] = 1;
					}
					else {
						$placelist[$place]++;
					}
				}
			}
			return $placelist;
		}
		// used by placehierarchy googlemap module
		else if ($parent > 0) {
			$join = ( $what == 'INDI' ) 
				? " JOIN {$TBLPREFIX}individuals ON pl_file = i_file AND pl_gid = i_id" 
				: ( ( $what == 'FAM' ) ? " JOIN {$TBLPREFIX}families ON pl_file = f_file AND pl_gid = f_id" : "" );
			$rows = $gBitDb->getAll(
				' SELECT'
				. ' p_place AS place,'
				. ' COUNT(*) AS tot'
				. ' FROM'
				. " {$TBLPREFIX}places"
				. " JOIN {$TBLPREFIX}placelinks ON pl_file=p_file AND p_id=pl_p_id"
				. $join
				. ' WHERE'
				. " p_id={$parent} AND"
				. " p_file={$this->_ged_id}"
				. ' GROUP BY place'
			);
			if (!isset( $rows[0] )) {
				return '';
			}
			return $rows;
		}
		else {
			$join = ( $what == 'INDI' ) 
				? " JOIN {$TBLPREFIX}individuals ON pl_file = i_file AND pl_gid = i_id" 
				: ( ( $what == 'FAM' ) ? " JOIN {$TBLPREFIX}families ON pl_file = f_file AND pl_gid = f_id" : "" );
			$rows = $gBitDb->getAll(
				' SELECT'
				. ' p_place AS country,'
				. ' COUNT(*) AS tot'
				. ' FROM'
				. " {$TBLPREFIX}places"
				. " JOIN {$TBLPREFIX}placelinks ON pl_file=p_file AND p_id=pl_p_id"
				. $join
				. ' WHERE'
				. " p_file={$this->_ged_id}"
				. " AND p_parent_id='0'"
				. ' GROUP BY country ORDER BY tot DESC, country ASC'
			);
			if (!isset( $rows[0] )) {
				return '';
			}
			return $rows;
		}
	}

	public function totalPlaces()
	{
		global $TBLPREFIX, $gBitDb;

		return
			$gBitDb->getOne(
				"SELECT COUNT(*) FROM {$TBLPREFIX}places WHERE p_file=?"
				, [ $this->_ged_id ] );
	}

	public function chartDistribution( $chart_shows = 'world', $chart_type = '', $surname = '' )
	{
		global $pgv_lang, $pgv_lang_use, $countries;
		global $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_CHART_COLOR3, $PGV_STATS_MAP_X, $PGV_STATS_MAP_Y;

		if ($this->totalPlaces() == 0)
			return '';

		// PGV uses 3-letter ISO/chapman codes, but google uses 2-letter ISO codes.  There is not a 1:1
		// mapping, so Wales/Scotland/England all become GB, etc.
		if (!isset( $iso3166 )) {
			$iso3166 = [
				'ABW' => 'AW',
				'AFG' => 'AF',
				'AGO' => 'AO',
				'AIA' => 'AI',
				'ALA' => 'AX',
				'ALB' => 'AL',
				'AND' => 'AD',
				'ANT' => 'AN',
				'ARE' => 'AE',
				'ARG' => 'AR',
				'ARM' => 'AM',
				'ASM' => 'AS',
				'ATA' => 'AQ',
				'ATF' => 'TF',
				'ATG' => 'AG',
				'AUS' => 'AU',
				'AUT' => 'AT',
				'AZE' => 'AZ',
				'BDI' => 'BI',
				'BEL' => 'BE',
				'BEN' => 'BJ',
				'BFA' => 'BF',
				'BGD' => 'BD',
				'BGR' => 'BG',
				'BHR' => 'BH',
				'BHS' => 'BS',
				'BIH' => 'BA',
				'BLR' => 'BY',
				'BLZ' => 'BZ',
				'BMU' => 'BM',
				'BOL' => 'BO',
				'BRA' => 'BR',
				'BRB' => 'BB',
				'BRN' => 'BN',
				'BTN' => 'BT',
				'BVT' => 'BV',
				'BWA' => 'BW',
				'CAF' => 'CF',
				'CAN' => 'CA',
				'CCK' => 'CC',
				'CHE' => 'CH',
				'CHL' => 'CL',
				'CHN' => 'CN',
				'CHI' => 'JE',
				'CIV' => 'CI',
				'CMR' => 'CM',
				'COD' => 'CD',
				'COG' => 'CG',
				'COK' => 'CK',
				'COL' => 'CO',
				'COM' => 'KM',
				'CPV' => 'CV',
				'CRI' => 'CR',
				'CUB' => 'CU',
				'CXR' => 'CX',
				'CYM' => 'KY',
				'CYP' => 'CY',
				'CZE' => 'CZ',
				'DEU' => 'DE',
				'DJI' => 'DJ',
				'DMA' => 'DM',
				'DNK' => 'DK',
				'DOM' => 'DO',
				'DZA' => 'DZ',
				'ECU' => 'EC',
				'EGY' => 'EG',
				'ENG' => 'GB',
				'ERI' => 'ER',
				'ESH' => 'EH',
				'ESP' => 'ES',
				'EST' => 'EE',
				'ETH' => 'ET',
				'FIN' => 'FI',
				'FJI' => 'FJ',
				'FLK' => 'FK',
				'FRA' => 'FR',
				'FRO' => 'FO',
				'FSM' => 'FM',
				'GAB' => 'GA',
				'GBR' => 'GB',
				'GEO' => 'GE',
				'GHA' => 'GH',
				'GIB' => 'GI',
				'GIN' => 'GN',
				'GLP' => 'GP',
				'GMB' => 'GM',
				'GNB' => 'GW',
				'GNQ' => 'GQ',
				'GRC' => 'GR',
				'GRD' => 'GD',
				'GRL' => 'GL',
				'GTM' => 'GT',
				'GUF' => 'GF',
				'GUM' => 'GU',
				'GUY' => 'GY',
				'HKG' => 'HK',
				'HMD' => 'HM',
				'HND' => 'HN',
				'HRV' => 'HR',
				'HTI' => 'HT',
				'HUN' => 'HU',
				'IDN' => 'ID',
				'IND' => 'IN',
				'IOT' => 'IO',
				'IRL' => 'IE',
				'IRN' => 'IR',
				'IRQ' => 'IQ',
				'ISL' => 'IS',
				'ISR' => 'IL',
				'ITA' => 'IT',
				'JAM' => 'JM',
				'JOR' => 'JO',
				'JPN' => 'JA',
				'KAZ' => 'KZ',
				'KEN' => 'KE',
				'KGZ' => 'KG',
				'KHM' => 'KH',
				'KIR' => 'KI',
				'KNA' => 'KN',
				'KOR' => 'KO',
				'KWT' => 'KW',
				'LAO' => 'LA',
				'LBN' => 'LB',
				'LBR' => 'LR',
				'LBY' => 'LY',
				'LCA' => 'LC',
				'LIE' => 'LI',
				'LKA' => 'LK',
				'LSO' => 'LS',
				'LTU' => 'LT',
				'LUX' => 'LU',
				'LVA' => 'LV',
				'MAC' => 'MO',
				'MAR' => 'MA',
				'MCO' => 'MC',
				'MDA' => 'MD',
				'MDG' => 'MG',
				'MDV' => 'MV',
				'MEX' => 'ME',
				'MHL' => 'MH',
				'MKD' => 'MK',
				'MLI' => 'ML',
				'MLT' => 'MT',
				'MMR' => 'MM',
				'MNG' => 'MN',
				'MNP' => 'MP',
				'MNT' => 'ME',
				'MOZ' => 'MZ',
				'MRT' => 'MR',
				'MSR' => 'MS',
				'MTQ' => 'MQ',
				'MUS' => 'MU',
				'MWI' => 'MW',
				'MYS' => 'MY',
				'MYT' => 'YT',
				'NAM' => 'NA',
				'NCL' => 'NC',
				'NER' => 'NE',
				'NFK' => 'NF',
				'NGA' => 'NG',
				'NIC' => 'NI',
				'NIR' => 'GB',
				'NIU' => 'NU',
				'NLD' => 'NL',
				'NOR' => 'NO',
				'NPL' => 'NP',
				'NRU' => 'NR',
				'NZL' => 'NZ',
				'OMN' => 'OM',
				'PAK' => 'PK',
				'PAN' => 'PA',
				'PCN' => 'PN',
				'PER' => 'PE',
				'PHL' => 'PH',
				'PLW' => 'PW',
				'PNG' => 'PG',
				'POL' => 'PL',
				'PRI' => 'PR',
				'PRK' => 'KP',
				'PRT' => 'PO',
				'PRY' => 'PY',
				'PSE' => 'PS',
				'PYF' => 'PF',
				'QAT' => 'QA',
				'REU' => 'RE',
				'ROM' => 'RO',
				'RUS' => 'RU',
				'RWA' => 'RW',
				'SAU' => 'SA',
				'SCT' => 'GB',
				'SDN' => 'SD',
				'SEN' => 'SN',
				'SER' => 'RS',
				'SGP' => 'SG',
				'SGS' => 'GS',
				'SHN' => 'SH',
				'SIC' => 'IT',
				'SJM' => 'SJ',
				'SLB' => 'SB',
				'SLE' => 'SL',
				'SLV' => 'SV',
				'SMR' => 'SM',
				'SOM' => 'SO',
				'SPM' => 'PM',
				'STP' => 'ST',
				'SUN' => 'RU',
				'SUR' => 'SR',
				'SVK' => 'SK',
				'SVN' => 'SI',
				'SWE' => 'SE',
				'SWZ' => 'SZ',
				'SYC' => 'SC',
				'SYR' => 'SY',
				'TCA' => 'TC',
				'TCD' => 'TD',
				'TGO' => 'TG',
				'THA' => 'TH',
				'TJK' => 'TJ',
				'TKL' => 'TK',
				'TKM' => 'TM',
				'TLS' => 'TL',
				'TON' => 'TO',
				'TTO' => 'TT',
				'TUN' => 'TN',
				'TUR' => 'TR',
				'TUV' => 'TV',
				'TWN' => 'TW',
				'TZA' => 'TZ',
				'UGA' => 'UG',
				'UKR' => 'UA',
				'UMI' => 'UM',
				'URY' => 'UY',
				'USA' => 'US',
				'UZB' => 'UZ',
				'VAT' => 'VA',
				'VCT' => 'VC',
				'VEN' => 'VE',
				'VGB' => 'VG',
				'VIR' => 'VI',
				'VNM' => 'VN',
				'VUT' => 'VU',
				'WLF' => 'WF',
				'WLS' => 'GB',
				'WSM' => 'WS',
				'YEM' => 'YE',
				'ZAF' => 'ZA',
				'ZMB' => 'ZM',
				'ZWE' => 'ZW',
			];
		}
		// The country names can be specified in any language or in the chapman code.
		// Generate a combined list.
		if (!isset( $country_to_iso3166 )) {
			$country_to_iso3166 = [];
			foreach ( $iso3166 as $three => $two ) {
				$country_to_iso3166[UTF8_strtolower( $three )] = $two;
			}
			foreach ( $pgv_lang_use as $lang => $use ) {
				if ($use) {
					loadLangFile( 'pgv_country', $lang );
					foreach ( $countries as $code => $country ) {
						if (array_key_exists( $code, $iso3166 )) {
							$country_to_iso3166[UTF8_strtolower( $country )] = $iso3166[$code];
						}
					}
				}
			}
		}
		switch ($chart_type) {
			case 'surname_distribution_chart':
				if ($surname == "")
					$surname = $this->getCommonSurname();
				$chart_title = $pgv_lang["surname_distribution_chart"] . ': ' . $surname;
				// Count how many people are events in each country
				$surn_countries = [];
				$indis = get_indilist_indis( UTF8_strtoupper( $surname ), '', '', false, false, PGV_GED_ID );
				foreach ( $indis as $person ) {
					if (preg_match_all( '/^2 PLAC (?:.*, *)*(.*)/m', $person->gedrec, $matches )) {
						// PGV uses 3 letter country codes and localised country names, but google uses 2 letter codes.
						foreach ( $matches[1] as $country ) {
							$country = UTF8_strtolower( trim( $country ) );
							if (array_key_exists( $country, $country_to_iso3166 )) {
								if (array_key_exists( $country_to_iso3166[$country], $surn_countries )) {
									$surn_countries[$country_to_iso3166[$country]]++;
								}
								else {
									$surn_countries[$country_to_iso3166[$country]] = 1;
								}
							}
						}
					}
				}
				;
				break;
			case 'birth_distribution_chart':
				$chart_title = $pgv_lang["stat_2_map"];
				// Count how many people were born in each country
				$surn_countries = [];
				$countries = $this->_statsPlaces( 'INDI', 'BIRT', 0, true );
				foreach ( $countries as $place => $count ) {
					$country = UTF8_strtolower( $place );
					if (array_key_exists( $country, $country_to_iso3166 )) {
						if (!isset( $surn_countries[$country_to_iso3166[$country]] )) {
							$surn_countries[$country_to_iso3166[$country]] = $count;
						}
						else {
							$surn_countries[$country_to_iso3166[$country]] += $count;
						}
					}
				}
				break;
			case 'death_distribution_chart':
				$chart_title = $pgv_lang["stat_3_map"];
				// Count how many people were death in each country
				$surn_countries = [];
				$countries = $this->_statsPlaces( 'INDI', 'DEAT', 0, true );
				foreach ( $countries as $place => $count ) {
					$country = UTF8_strtolower( $place );
					if (array_key_exists( $country, $country_to_iso3166 )) {
						if (!isset( $surn_countries[$country_to_iso3166[$country]] )) {
							$surn_countries[$country_to_iso3166[$country]] = $count;
						}
						else {
							$surn_countries[$country_to_iso3166[$country]] += $count;
						}
					}
				}
				break;
			case 'marriage_distribution_chart':
				$chart_title = $pgv_lang["stat_4_map"];
				// Count how many families got marriage in each country
				$surn_countries = [];
				$countries = $this->_statsPlaces( 'FAM' );
				// PGV uses 3 letter country codes and localised country names, but google uses 2 letter codes.
				if (!empty( $countries ))
					foreach ( $countries as $place ) {
						$country = UTF8_strtolower( trim( $place['country'] ) );
						if (array_key_exists( $country, $country_to_iso3166 )) {
							$surn_countries[$country_to_iso3166[$country]] = $place['tot'];
						}
					}
				break;
			case 'indi_distribution_chart':
			default:
				$chart_title = $pgv_lang["indi_distribution_chart"];
				// Count how many people are events in each country
				$surn_countries = [];
				$countries = $this->_statsPlaces( 'INDI' );
				// PGV uses 3 letter country codes and localised country names, but google uses 2 letter codes.
				if (!empty( $countries ))
					foreach ( $countries as $place ) {
						$country = UTF8_strtolower( trim( $place['country'] ) );
						if (array_key_exists( $country, $country_to_iso3166 )) {
							$surn_countries[$country_to_iso3166[$country]] = $place['tot'];
						}
					}
				break;
		}
		$chart_url = PHPGEDVIEW_PKG_URL."chart.php?cht=t&amp;chtm=" . $chart_shows;
		$chart_url .= "&amp;chco=" . $PGV_STATS_CHART_COLOR1 . "," . $PGV_STATS_CHART_COLOR3 . "," . $PGV_STATS_CHART_COLOR2; // country colours
		$chart_url .= "&amp;chf=bg,s,ECF5FF"; // sea colour
		$chart_url .= "&amp;chs=" . $PGV_STATS_MAP_X . "x" . $PGV_STATS_MAP_Y;
		$chart_url .= "&amp;chld=" . implode( '', array_keys( $surn_countries ) ) . "&amp;chd=s:";
		foreach ( $surn_countries as $count ) {
			$chart_url .= substr( PGV_GOOGLE_CHART_ENCODING, floor( $count / max( $surn_countries ) * 61 ), 1 );
		}
		$chart = '<div id="google_charts" class="center">';
		$chart .= '<b>' . $chart_title . '</b><br /><br />';
		$chart .= '<div align="center"><img src="' . $chart_url . '" alt="' . $chart_title . '" title="' . $chart_title . '" class="gchart" /><br />';
		$chart .= '<table align="center" border="0" cellpadding="1" cellspacing="1"><tr>';
		$chart .= '<td bgcolor="#' . $PGV_STATS_CHART_COLOR2 . '" width="12"></td><td>' . $pgv_lang["g_chart_high"] . '&nbsp;&nbsp;</td>';
		$chart .= '<td bgcolor="#' . $PGV_STATS_CHART_COLOR3 . '" width="12"></td><td>' . $pgv_lang["g_chart_low"] . '&nbsp;&nbsp;</td>';
		$chart .= '<td bgcolor="#' . $PGV_STATS_CHART_COLOR1 . '" width="12"></td><td>' . $pgv_lang["g_chart_nobody"] . '&nbsp;&nbsp;</td>';
		$chart .= '</tr></table></div></div>';
		return $chart;
	}

	public function commonCountriesList()
	{
		global $TEXT_DIRECTION;
		$countries = $this->_statsPlaces();
		if (!is_array( $countries ))
			return '';
		$top10 = [];
		$i = 1;
		foreach ( $countries as $country ) {
			$place = '<a href="' . encode_url( get_place_url( $country['country'] ) ) . '" class="list_item">' . PrintReady( $country['country'] ) . '</a>';
			$top10[] = "\t<li>" . $place . " " . PrintReady( "[" . $country['tot'] . "]" ) . "</li>\n";
			if ($i++ == 10)
				break;
		}
		$top10 = join( "\n", $top10 );
		return "<ul>\n{$top10}</ul>\n";
	}

	public function commonBirthPlacesList()
	{
		global $TEXT_DIRECTION;
		$places = $this->_statsPlaces( 'INDI', 'BIRT' );
		$top10 = [];
		$i = 1;
		arsort( $places );
		foreach ( $places as $place => $count ) {
			$place = '<a href="' . encode_url( get_place_url( $place ) ) . '" class="list_item">' . PrintReady( $place ) . '</a>';
			$top10[] = "\t<li>" . $place . " " . PrintReady( "[" . $count . "]" ) . "</li>\n";
			if ($i++ == 10)
				break;
		}
		$top10 = join( "\n", $top10 );
		return "<ul>\n{$top10}</ul>\n";
	}

	public function commonDeathPlacesList()
	{
		global $TEXT_DIRECTION;
		$places = $this->_statsPlaces( 'INDI', 'DEAT' );
		$top10 = [];
		$i = 1;
		arsort( $places );
		foreach ( $places as $place => $count ) {
			$place = '<a href="' . encode_url( get_place_url( $place ) ) . '" class="list_item">' . PrintReady( $place ) . '</a>';
			$top10[] = "\t<li>" . $place . " " . PrintReady( "[" . $count . "]" ) . "</li>\n";
			if ($i++ == 10)
				break;
		}
		$top10 = join( "\n", $top10 );
		return "<ul>\n{$top10}</ul>\n";
	}

	public function commonMarriagePlacesList()
	{
		global $TEXT_DIRECTION;
		$places = $this->_statsPlaces( 'FAM', 'MARR' );
		$top10 = [];
		$i = 1;
		arsort( $places );
		foreach ( $places as $place => $count ) {
			$place = '<a href="' . encode_url( get_place_url( $place ) ) . '" class="list_item">' . PrintReady( $place ) . '</a>';
			$top10[] = "\t<li>" . $place . " " . PrintReady( "[" . $count . "]" ) . "</li>\n";
			if ($i++ == 10)
				break;
		}
		$top10 = join( "\n", $top10 );
		return "<ul>\n{$top10}</ul>\n";
	}

	public function statsBirth( $simple = true, $sex = false, $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;

		$sql = $simple 
			? "SELECT ROUND((d_year+49.1)/100) AS century, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. 'd_year<>0 AND '
				. "d_fact='BIRT' AND "
				. "d_type='@#DGREGORIAN@'" 
			: ( $sex 
				? "SELECT d_month, i_sex, COUNT(*) AS total FROM {$TBLPREFIX}dates "
					. "JOIN {$TBLPREFIX}individuals ON d_file = i_file AND d_gid = i_id "
					. "WHERE "
					. "d_file={$this->_ged_id} AND "
					. "d_fact='BIRT' AND "
					. "d_type='@#DGREGORIAN@'" 
				: "SELECT d_month, COUNT(*) AS total FROM {$TBLPREFIX}dates "
					. "WHERE "
					. "d_file={$this->_ged_id} AND "
					. "d_fact='BIRT' AND "
					. "d_type='@#DGREGORIAN@'" );
		if ($year1 >= 0 && $year2 >= 0) {
			$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
		}
		if ($simple) {
			$sql .= " GROUP BY century ORDER BY century";
		}
		else {
			$sql .= " GROUP BY d_month";
			if ($sex)
				$sql .= ", i_sex";
		}
		$rows = $gBitDb->getAll( $sql );
		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
			$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
			$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
			$sizes = explode( 'x', $size );
			$tot = 0;
			foreach ( $rows as $values ) {
				$tot += $values['total'];
			}
			// Beware divide by zero
			if ($tot == 0)
				return '';
			$centuries = "";
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			foreach ( $rows as $values ) {
				$century = ( function_exists( $func ) ) ? $func( $values['century'] ) : $values['century'];
				$counts[] = round( 100 * $values['total'] / $tot, 0 );
				$centuries .= $century . ' - ' . $values['total'] . '|';
			}
			$chd = self::_array_to_extended_encoding( $counts );
			$chl = substr( $centuries, 0, -1 );
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_5_birth"] . "\" title=\"" . $pgv_lang["stat_5_birth"] . "\" />";
		}
		if (!isset( $rows ))
			return 0;
		return $rows;
	}

	public function statsDeath( $simple = true, $sex = false, $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;

		$sql = $simple 
			? "SELECT ROUND((d_year+49.1)/100) AS century, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. 'd_year<>0 AND '
				. "d_fact='DEAT' AND "
				. "d_type='@#DGREGORIAN@'" 
			: ( $sex 
				? "SELECT d_month, i_sex, COUNT(*) AS total FROM {$TBLPREFIX}dates "
					. "JOIN {$TBLPREFIX}individuals ON d_file = i_file AND d_gid = i_id "
					. "WHERE "
					. "d_file={$this->_ged_id} AND "
					. "d_fact='DEAT' AND "
					. "d_type='@#DGREGORIAN@'" 
				: "SELECT d_month, COUNT(*) AS total FROM {$TBLPREFIX}dates "
					. "WHERE "
					. "d_file={$this->_ged_id} AND "
					. "d_fact='DEAT' AND "
					. "d_type='@#DGREGORIAN@'" );
		if ($year1 >= 0 && $year2 >= 0) {
			$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
		}
		if ($simple) {
			$sql .= " GROUP BY century ORDER BY century";
		}
		else {
			$sql .= " GROUP BY d_month";
			if ($sex)
				$sql .= ", i_sex";
		}
		$rows = $gBitDb->getAll( $sql );
		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
			$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
			$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
			$sizes = explode( 'x', $size );
			$tot = 0;
			foreach ( $rows as $values ) {
				$tot += $values['total'];
			}
			// Beware divide by zero
			if ($tot == 0)
				return '';
			$centuries = "";
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			foreach ( $rows as $values ) {
				$century = ( function_exists( $func ) ) ? $func( $values['century'] ) : $values['century'];
				$counts[] = round( 100 * $values['total'] / $tot, 0 );
				$centuries .= $century . ' - ' . $values['total'] . '|';
			}
			$chd = self::_array_to_extended_encoding( $counts );
			$chl = substr( $centuries, 0, -1 );
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_6_death"] . "\" title=\"" . $pgv_lang["stat_6_death"] . "\" />";
		}
		if (!isset( $rows )) {
			return 0;
		}
		return $rows;
	}

	//
	// Birth
	//

	public function firstBirth()
	{
		return $this->_mortalityQuery( 'full', 'ASC', 'BIRT' );
	}

	public function firstBirthYear()
	{
		return $this->_mortalityQuery( 'year', 'ASC', 'BIRT' );
	}

	public function firstBirthName()
	{
		return $this->_mortalityQuery( 'name', 'ASC', 'BIRT' );
	}

	public function firstBirthPlace()
	{
		return $this->_mortalityQuery( 'place', 'ASC', 'BIRT' );
	}

	public function lastBirth()
	{
		return $this->_mortalityQuery( 'full', 'DESC', 'BIRT' );
	}

	public function lastBirthYear()
	{
		return $this->_mortalityQuery( 'year', 'DESC', 'BIRT' );
	}

	public function lastBirthName()
	{
		return $this->_mortalityQuery( 'name', 'DESC', 'BIRT' );
	}

	public function lastBirthPlace()
	{
		return $this->_mortalityQuery( 'place', 'DESC', 'BIRT' );
	}

	//
	// Death
	//

	public function firstDeath()
	{
		return $this->_mortalityQuery( 'full', 'ASC', 'DEAT' );
	}

	public function firstDeathYear()
	{
		return $this->_mortalityQuery( 'year', 'ASC', 'DEAT' );
	}

	public function firstDeathName()
	{
		return $this->_mortalityQuery( 'name', 'ASC', 'DEAT' );
	}

	public function firstDeathPlace()
	{
		return $this->_mortalityQuery( 'place', 'ASC', 'DEAT' );
	}

	public function lastDeath()
	{
		return $this->_mortalityQuery( 'full', 'DESC', 'DEAT' );
	}

	public function lastDeathYear()
	{
		return $this->_mortalityQuery( 'year', 'DESC', 'DEAT' );
	}

	public function lastDeathName()
	{
		return $this->_mortalityQuery( 'name', 'DESC', 'DEAT' );
	}

	public function lastDeathPlace()
	{
		return $this->_mortalityQuery( 'place', 'DESC', 'DEAT' );
	}

	///////////////////////////////////////////////////////////////////////////////
// Lifespan                                                                  //
///////////////////////////////////////////////////////////////////////////////

	public function _longlifeQuery( $type = 'full', $sex = 'F' )
	{
		global $TBLPREFIX, $pgv_lang, $SHOW_ID_NUMBERS, $listDir, $gBitDb;

		$sex_search = ' 1=1';
		if ($sex == 'F') {
			$sex_search = " i_sex='F'";
		}
		elseif ($sex == 'M') {
			$sex_search = " i_sex='M'";
		}

		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' death.d_gid AS id,'
			. ' death.d_julianday2-birth.d_julianday1 AS age'
			. ' FROM'
			. " {$TBLPREFIX}dates AS death,"
			. " {$TBLPREFIX}dates AS birth,"
			. " {$TBLPREFIX}individuals AS indi"
			. ' WHERE'
			. ' indi.i_id=birth.d_gid AND'
			. ' birth.d_gid=death.d_gid AND'
			. " death.d_file={$this->_ged_id} AND"
			. ' birth.d_file=death.d_file AND'
			. ' birth.d_file=indi.i_file AND'
			. " birth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. " death.d_fact IN ('DEAT', 'BURI', 'CREM') AND"
			. ' birth.d_julianday1<>0 AND'
			. ' death.d_julianday1>birth.d_julianday2 AND'
			. $sex_search
			. ' ORDER BY'
			. ' age DESC'
		);
		//testing
		/*
		$rows = $gBitDb->getAll(''
			.' SELECT'
				.' i_id AS id,'
				.' death.d_julianday2-birth.d_julianday1 AS age'
			.' FROM'
				.' (SELECT d_gid, d_file, MIN(d_julianday1) AS birth_jd'
					.' FROM {$TBLPREFIX}date'
					." WHERE d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND d_julianday1>0"
					.' GROUP BY d_gid, d_file'
				.' ) AS birth'
			.' JOIN ('
				.' SELECT d_gid, d_file, MIN(d_julianday1) AS death_jd'
					.' FROM {$TBLPREFIX}date'
					." WHERE d_fact IN ('DEAT', 'BURI', 'CREM') AND d_julianday1>0"
					.' GROUP BY d_gid, d_file'
				.' ) AS death USING (d_gid, d_file)'
			.' JOIN {$TBLPREFIX}individuals ON (d_gid=i_id AND d_file=i_file)'
			.' WHERE'
				." i_file={$this->_ged_id} AND"
				.$sex_search
			.' ORDER BY'
				.' age DESC'
		);
		*/
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		$person = Person::getInstance( $row['id'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( displayDetailsById( $row['id'] ) ) ? $person->format_list( 'span', false, $person->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'age':
				$result = floor( $row['age'] / 365.25 );
				break;
			case 'name':
				$id = '';
				if ($SHOW_ID_NUMBERS) {
					$id = ( $listDir == 'rtl' ) ? "&nbsp;&nbsp;" . getRLM() . "({$row['id']})" . getRLM() : "&nbsp;&nbsp;({$row['id']})";
				}
				$result = "<a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . $person->getFullName() . "{$id}</a>";
				break;
		}
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function _topTenOldest( $type = 'list', $sex = 'BOTH', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang, $lang_short_cut, $LANGUAGE;

		if ($sex == 'F') {
			$sex_search = " AND i_sex='F'";
		}
		elseif ($sex == 'M') {
			$sex_search = " AND i_sex='M'";
		}
		else {
			$sex_search = '';
		}
		$total = ( $params !== null && isset( $params[0] ) ) ? $params[0] : 10;
		$rows = $gBitDb->getAll(
			' SELECT FIRST ?'
			. ' MAX(death.d_julianday2-birth.d_julianday1) AS age,'
			. ' death.d_gid AS deathdate'
			. ' FROM'
			. " {$TBLPREFIX}dates AS death,"
			. " {$TBLPREFIX}dates AS birth,"
			. " {$TBLPREFIX}individuals AS indi"
			. ' WHERE'
			. ' indi.i_id=birth.d_gid AND'
			. ' birth.d_gid=death.d_gid AND'
			. " death.d_file={$this->_ged_id} AND"
			. ' birth.d_file=death.d_file AND'
			. ' birth.d_file=indi.i_file AND'
			. " birth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. " death.d_fact IN ('DEAT', 'BURI', 'CREM') AND"
			. ' birth.d_julianday1<>0 AND'
			. ' death.d_julianday1>birth.d_julianday2'
			. $sex_search
			. ' GROUP BY'
			. ' deathdate'
			. ' ORDER BY'
			. ' age DESC'
			, [ $total ]
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$top10 = [];
		$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
		if (!function_exists( $func )) {
			$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
		}
		$show_years = true;
		foreach ( $rows as $row ) {
			$person = Person::getInstance( $row['deathdate'] );
			$age = $row['age'];
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else {
				$age .= 'd';
			}
			$func( $age, $show_years );
			if ($person->canDisplayDetails()) {
				$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . PrintReady( $person->getFullName() . "</a> [" . $age . "]" ) . "</li>\n" : "<a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . PrintReady( $person->getFullName() . "</a> [" . $age . "]" );
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ "[", "]", "(", ")", "+" ], [ "&rlm;[", "&rlm;]", "&rlm;(", "&rlm;)", "&rlm;+" ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		// Statstics are used by RSS feeds, etc., so need absolute URLs.
		return $top10;
	}

	public function _topTenOldestAlive( $type = 'list', $sex = 'BOTH', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang, $lang_short_cut, $LANGUAGE;

		if (!PGV_USER_CAN_ACCESS)
			return $pgv_lang["privacy_error"];
		if ($sex == 'F') {
			$sex_search = " AND i_sex='F'";
		}
		elseif ($sex == 'M') {
			$sex_search = " AND i_sex='M'";
		}
		else {
			$sex_search = '';
		}
		$total = ( $params !== null && isset( $params[0] ) ) ? $params[0] : 10;
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' birth.d_gid AS id,'
			. ' MIN(birth.d_julianday1) AS age'
			. ' FROM'
			. " {$TBLPREFIX}dates AS birth,"
			. " {$TBLPREFIX}individuals AS indi"
			. ' WHERE'
			. ' indi.i_id=birth.d_gid AND'
			. ' indi.i_isdead=0 AND'
			. " birth.d_file={$this->_ged_id} AND"
			. ' birth.d_file=indi.i_file AND'
			. " birth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. ' birth.d_julianday1<>0'
			. $sex_search
			. ' GROUP BY'
			. ' id'
			. ' ORDER BY'
			. ' age ASC'
			, $total );
		if (!isset( $rows )) {
			return 0;
		}
		$top10 = [];
		$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
		if (!function_exists( $func )) {
			$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
		}
		$show_years = true;
		foreach ( $rows as $row ) {
			$person = Person::getInstance( $row['id'] );
			$age = client_jd() - $row['age'];
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else {
				$age .= 'd';
			}
			$func( $age, $show_years );
			$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . PrintReady( $person->getFullName() . "</a> [" . $age . "]" ) . "</li>\n" : "<a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . PrintReady( $person->getFullName() . "</a> [" . $age . "]" );
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ "[", "]", "(", ")", "+" ], [ "&rlm;[", "&rlm;]", "&rlm;(", "&rlm;)", "&rlm;+" ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function _averageLifespanQuery( $sex = 'BOTH', $show_years = false )
	{
		global $TBLPREFIX, $gBitDb, $lang_short_cut, $LANGUAGE;
		if ($sex == 'F') {
			$sex_search = " AND i_sex='F'";
		}
		elseif ($sex == 'M') {
			$sex_search = " AND i_sex='M'";
		}
		else {
			$sex_search = '';
		}
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' AVG(death.d_julianday2-birth.d_julianday1) AS age'
			. ' FROM'
			. " {$TBLPREFIX}dates AS death,"
			. " {$TBLPREFIX}dates AS birth,"
			. " {$TBLPREFIX}individuals AS indi"
			. ' WHERE'
			. ' indi.i_id=birth.d_gid AND'
			. ' birth.d_gid=death.d_gid AND'
			. " death.d_file={$this->_ged_id} AND"
			. ' birth.d_file=death.d_file AND'
			. ' birth.d_file=indi.i_file AND'
			. " birth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. " death.d_fact IN ('DEAT', 'BURI', 'CREM') AND"
			. ' birth.d_julianday1<>0 AND'
			. ' death.d_julianday1>birth.d_julianday2'
			. $sex_search
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		$age = $row['age'];
		if ($show_years) {
			$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
			if (!function_exists( $func )) {
				$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
			}
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else if (!empty( $age )) {
				$age .= 'd';
			}
			$func( $age, $show_years );
			return $age;
		}
		else {
			return floor( $age / 365.25 );
		}
	}

	public function statsAge( $simple = true, $related = 'BIRT', $sex = 'BOTH', $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;

		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : '230x250';
			$sizes = explode( 'x', $size );
			$rows = $gBitDb->getAll( ''
				. ' SELECT'
				. ' ROUND(AVG(death.d_julianday2-birth.d_julianday1)/365.25,1) AS age,'
				. ' ROUND((death.d_year+49.1)/100) AS century,'
				. ' i_sex AS sex'
				. ' FROM'
				. " {$TBLPREFIX}dates AS death,"
				. " {$TBLPREFIX}dates AS birth,"
				. " {$TBLPREFIX}individuals AS indi"
				. ' WHERE'
				. ' indi.i_id=birth.d_gid AND'
				. ' birth.d_gid=death.d_gid AND'
				. " death.d_file={$this->_ged_id} AND"
				. ' birth.d_file=death.d_file AND'
				. ' birth.d_file=indi.i_file AND'
				. " birth.d_fact='BIRT' AND"
				. " death.d_fact='DEAT' AND"
				. ' birth.d_julianday1<>0 AND'
				. " birth.d_type='@#DGREGORIAN@' AND"
				. " death.d_type='@#DGREGORIAN@' AND"
				. ' death.d_julianday1>birth.d_julianday2'
				. ' GROUP BY century, sex ORDER BY century, sex' );
			if (empty( $rows ))
				return '';
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			$chxl = "0:|";
			$male = true;
			$temp = "";
			$countsm = "";
			$countsf = "";
			$countsa = "";
			foreach ( $rows as $values ) {
				if ($temp != $values['century']) {
					$temp = $values['century'];
					if ($sizes[0] < 980)
						$sizes[0] += 50;
					$century = ( function_exists( $func ) ) ? $func( $values['century'], false ) : $values['century'];
					$chxl .= $century . "|";
					if ($values['sex'] == "F") {
						if (!$male) {
							$countsm .= "0,";
							$countsa .= $fage . ",";
						}
						$countsf .= $values['age'] . ",";
						$fage = $values['age'];
						$male = false;
					}
					else if ($values['sex'] == "M") {
						$countsf .= "0,";
						$countsm .= $values['age'] . ",";
						$countsa .= $values['age'] . ",";
					}
					else if ($values['sex'] == "U") {
						$countsf .= "0,";
						$countsm .= "0,";
						$countsa .= "0,";
					}
				}
				else if ($values['sex'] == "M") {
					$countsm .= $values['age'] . ",";
					$countsa .= round( ( $fage + $values['age'] ) / 2, 1 ) . ",";
					$male = true;
				}
			}
			if (!$male) {
				$countsa .= $fage . ",";
			}
			$countsm = substr( $countsm, 0, -1 );
			$countsf = substr( $countsf, 0, -1 );
			$countsa = substr( $countsa, 0, -1 );
			$chd = "t2:{$countsm}|{$countsf}|{$countsa}";
			$chxl .= "1:||" . $pgv_lang["century"] . "|2:|0|10|20|30|40|50|60|70|80|90|100|3:||" . $pgv_lang["stat_age"] . "|";
			if (count( $rows ) > 4 || UTF8_strlen( $pgv_lang["stat_18_aard"] ) < 30) {
				$chtt = $pgv_lang["stat_18_aard"];
			}
			else {
				$offset = 0;
				$counter = [];
				while ( $offset = strpos( $pgv_lang["stat_18_aard"], " ", $offset + 1 ) ) {
					$counter[] = $offset;
				}
				$half = floor( count( $counter ) / 2 );
				$chtt = substr_replace( $pgv_lang["stat_18_aard"], '|', $counter[$half], 1 );
			}
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=bvg&amp;chs={$sizes[0]}x{$sizes[1]}&amp;chm=D,FF0000,2,0,3,1|N*f1*,000000,0,-1,11,1|N*f1*,000000,1,-1,11,1&amp;chf=bg,s,ffffff00|c,s,ffffff00&amp;chtt={$chtt}&amp;chd={$chd}&amp;chco=0000FF,FFA0CB,FF0000&amp;chbh=20,3&amp;chxt=x,x,y,y&amp;chxl={$chxl}&amp;chdl={$pgv_lang["male"]}|{$pgv_lang["female"]}|{$pgv_lang["stat_avg_age_at_death"]}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_18_aard"] . "\" title=\"" . $pgv_lang["stat_18_aard"] . "\" />";
		}
		else {
			$sex_search = '';
			$years = '';
			if ($sex == 'F') {
				$sex_search = " AND i_sex='F'";
			}
			elseif ($sex == 'M') {
				$sex_search = " AND i_sex='M'";
			}
			if ($year1 >= 0 && $year2 >= 0) {
				if ($related == 'BIRT') {
					$years = " AND birth.d_year BETWEEN '{$year1}' AND '{$year2}'";
				}
				else if ($related == 'DEAT') {
					$years = " AND death.d_year BETWEEN '{$year1}' AND '{$year2}'";
				}
			}
			$rows = $gBitDb->getAll( ''
				. ' SELECT'
				. ' death.d_julianday2-birth.d_julianday1 AS age'
				. ' FROM'
				. " {$TBLPREFIX}dates AS death,"
				. " {$TBLPREFIX}dates AS birth,"
				. " {$TBLPREFIX}individuals AS indi"
				. ' WHERE'
				. ' indi.i_id=birth.d_gid AND'
				. ' birth.d_gid=death.d_gid AND'
				. " death.d_file={$this->_ged_id} AND"
				. ' birth.d_file=death.d_file AND'
				. ' birth.d_file=indi.i_file AND'
				. " birth.d_fact='BIRT' AND"
				. " death.d_fact='DEAT' AND"
				. ' birth.d_julianday1<>0 AND'
				. ' death.d_julianday1>birth.d_julianday2'
				. $years
				. $sex_search
				. ' ORDER BY age DESC' );
			if (!isset( $rows )) {
				return 0;
			}
			return $rows;
		}
	}

	// Both Sexes

	public function longestLife()
	{
		return $this->_longlifeQuery( 'full', 'BOTH' );
	}

	public function longestLifeAge()
	{
		return $this->_longlifeQuery( 'age', 'BOTH' );
	}

	public function longestLifeName()
	{
		return $this->_longlifeQuery( 'name', 'BOTH' );
	}

	public function topTenOldest( $params = null )
	{
		return $this->_topTenOldest( 'nolist', 'BOTH', $params );
	}

	public function topTenOldestList( $params = null )
	{
		return $this->_topTenOldest( 'list', 'BOTH', $params );
	}

	public function topTenOldestAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'nolist', 'BOTH', $params );
	}

	public function topTenOldestListAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'list', 'BOTH', $params );
	}

	public function averageLifespan( $show_years = false )
	{
		return $this->_averageLifespanQuery( 'BOTH', $show_years );
	}

	// Female Only

	public function longestLifeFemale()
	{
		return $this->_longlifeQuery( 'full', 'F' );
	}

	public function longestLifeFemaleAge()
	{
		return $this->_longlifeQuery( 'age', 'F' );
	}

	public function longestLifeFemaleName()
	{
		return $this->_longlifeQuery( 'name', 'F' );
	}

	public function topTenOldestFemale( $params = null )
	{
		return $this->_topTenOldest( 'nolist', 'F', $params );
	}

	public function topTenOldestFemaleList( $params = null )
	{
		return $this->_topTenOldest( 'list', 'F', $params );
	}

	public function topTenOldestFemaleAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'nolist', 'F', $params );
	}

	public function topTenOldestFemaleListAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'list', 'F', $params );
	}

	public function averageLifespanFemale( $show_years = false )
	{
		return $this->_averageLifespanQuery( 'F', $show_years );
	}

	// Male Only

	public function longestLifeMale()
	{
		return $this->_longlifeQuery( 'full', 'M' );
	}

	public function longestLifeMaleAge()
	{
		return $this->_longlifeQuery( 'age', 'M' );
	}

	public function longestLifeMaleName()
	{
		return $this->_longlifeQuery( 'name', 'M' );
	}

	public function topTenOldestMale( $params = null )
	{
		return $this->_topTenOldest( 'nolist', 'M', $params );
	}

	public function topTenOldestMaleList( $params = null )
	{
		return $this->_topTenOldest( 'list', 'M', $params );
	}

	public function topTenOldestMaleAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'nolist', 'M', $params );
	}

	public function topTenOldestMaleListAlive( $params = null )
	{
		return $this->_topTenOldestAlive( 'list', 'M', $params );
	}

	public function averageLifespanMale( $show_years = false )
	{
		return $this->_averageLifespanQuery( 'M', $show_years );
	}

	///////////////////////////////////////////////////////////////////////////////
// Events                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function _eventQuery( $type, $direction, $facts )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $SHOW_ID_NUMBERS, $listDir;
		$eventTypes = [
			'BIRT' => $pgv_lang['htmlplus_block_birth'],
			'DEAT' => $pgv_lang['htmlplus_block_death'],
			'MARR' => $pgv_lang['htmlplus_block_marrage'],
			'ADOP' => $pgv_lang['htmlplus_block_adoption'],
			'BURI' => $pgv_lang['htmlplus_block_burial'],
			'CENS' => $pgv_lang['htmlplus_block_census'],
		];

		$fact_query = "IN ('" . str_replace( '|', "','", $facts ) . "')";

		if ($direction != 'ASC') {
			$direction = 'DESC';
		}
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' d_gid AS id,'
			. ' d_year AS n_year,'
			. ' d_fact AS fact,'
			. ' d_type AS type'
			. ' FROM'
			. " {$TBLPREFIX}dates"
			. ' WHERE'
			. " d_file={$this->_ged_id} AND"
			. " d_gid<>'HEAD' AND"
			. " d_fact {$fact_query} AND"
			. ' d_julianday1<>0'
			. ' ORDER BY'
			. " d_julianday1 {$direction}, d_type"
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		$record = GedcomRecord::getInstance( $row['id'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( $record->canDisplayDetails() ) ? $record->format_list( 'span', false, $record->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'year':
				$date = new GedcomDate( $row['type'] . ' ' . $row['n_year'] );
				$result = $date->Display( true );
				break;
			case 'type':
				$result = isset( $eventTypes[$row['fact']] ) ? $eventTypes[$row['fact']] : '';
				break;
			case 'name':
				$id = '';
				if ($SHOW_ID_NUMBERS) {
					$id = ( $listDir == 'rtl' ) ? "&nbsp;&nbsp;" . getRLM() . "({$row['id']})" . getRLM() : "&nbsp;&nbsp;({$row['id']})";
				}
				$result = "<a href=\"" . encode_url( $record->getLinkUrl() ) . "\">" . PrintReady( $record->getFullName() ) . "{$id}</a>";
				break;
			case 'place':
				$result = format_fact_place( $record->getFactByType( $row['fact'] ), true, true, true );
				break;
		}
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function firstEvent()
	{
		return $this->_eventQuery( 'full', 'ASC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function firstEventYear()
	{
		return $this->_eventQuery( 'year', 'ASC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function firstEventType()
	{
		return $this->_eventQuery( 'type', 'ASC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function firstEventName()
	{
		return $this->_eventQuery( 'name', 'ASC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function firstEventPlace()
	{
		return $this->_eventQuery( 'place', 'ASC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function lastEvent()
	{
		return $this->_eventQuery( 'full', 'DESC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function lastEventYear()
	{
		return $this->_eventQuery( 'year', 'DESC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function lastEventType()
	{
		return $this->_eventQuery( 'type', 'DESC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function lastEventName()
	{
		return $this->_eventQuery( 'name', 'DESC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	public function lastEventPlace()
	{
		return $this->_eventQuery( 'place', 'DESC', PGV_EVENTS_BIRT . '|' . PGV_EVENTS_MARR . '|' . PGV_EVENTS_DIV . '|' . PGV_EVENTS_DEAT );
	}

	///////////////////////////////////////////////////////////////////////////////
// Marriage                                                                  //
///////////////////////////////////////////////////////////////////////////////

	/*
	 * Query the database for marriage tags.
	 */
	public function _marriageQuery( $type = 'full', $age_dir = 'ASC', $sex = 'F', $show_years = false )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;
		$sex_field = ( $sex == 'F' ) ? 'f_wife' : 'f_husb';
		if ($age_dir != 'ASC') {
			$age_dir = 'DESC';
		}
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' fam.f_id AS famid,'
			. " fam.{$sex_field},"
			. ' married.d_julianday2-birth.d_julianday1 AS age,'
			. ' indi.i_id AS i_id'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS birth ON birth.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}individuals AS indi ON indi.i_file = {$this->_ged_id}"
			. ' WHERE'
			. ' birth.d_gid = indi.i_id AND'
			. ' married.d_gid = fam.f_id AND'
			. " indi.i_id = fam.{$sex_field} AND"
			. " fam.f_file = {$this->_ged_id} AND"
			. " birth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. " married.d_fact = 'MARR' AND"
			. ' birth.d_julianday1 <> 0 AND'
			. ' married.d_julianday2 > birth.d_julianday1 AND'
			. " i_sex='{$sex}'"
			. ' ORDER BY'
			. " married.d_julianday2-birth.d_julianday1 {$age_dir}"
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		if (isset( $row['famid'] ))
			$family = Family::getInstance( $row['famid'] );
		if (isset( $row['i_id'] ))
			$person = Person::getInstance( $row['i_id'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( $family->canDisplayDetails() ) ? $family->format_list( 'span', false, $person->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'name':
				$result = "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . $person->getFullName() . '</a>';
				break;
			case 'age':
				$age = $row['age'];
				if ($show_years) {
					$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
					if (!function_exists( $func )) {
						$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
					}
					if (floor( $age / 365.25 ) > 0) {
						$age = floor( $age / 365.25 ) . 'y';
					}
					else if (floor( $age / 30.43 ) > 0) {
						$age = floor( $age / 30.43 ) . 'm';
					}
					else {
						$age .= 'd';
					}
					$func( $age, $show_years );
					$result = $age;
				}
				else {
					$result = floor( $age / 365.25 );
				}
				break;
		}
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function _ageOfMarriageQuery( $type = 'list', $age_dir = 'ASC', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang, $lang_short_cut, $LANGUAGE;
		$total = ( $params !== null && isset( $params[0] ) ) ? $params[0] : 10;
		if ($age_dir != 'ASC') {
			$age_dir = 'DESC';
		}
		$hrows = $gBitDb->getAll( ''
			. ' SELECT DISTINCT'
			. ' fam.f_id AS family,'
			. ' MIN(husbdeath.d_julianday2-married.d_julianday1) AS age'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS husbdeath ON husbdeath.d_file = {$this->_ged_id}"
			. ' WHERE'
			. " fam.f_file = {$this->_ged_id} AND"
			. ' husbdeath.d_gid = fam.f_husb AND'
			. " husbdeath.d_fact IN ('DEAT', 'BURI', 'CREM') AND"
			. ' married.d_gid = fam.f_id AND'
			. " married.d_fact = 'MARR' AND"
			. ' married.d_julianday1 < husbdeath.d_julianday2 AND'
			. ' married.d_julianday1 <> 0'
			. ' GROUP BY'
			. ' family'
			. ' ORDER BY'
			. " age {$age_dir}"
		);
		$wrows = $gBitDb->getAll( ''
			. ' SELECT DISTINCT'
			. ' fam.f_id AS family,'
			. ' MIN(wifedeath.d_julianday2-married.d_julianday1) AS age'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS wifedeath ON wifedeath.d_file = {$this->_ged_id}"
			. ' WHERE'
			. " fam.f_file = {$this->_ged_id} AND"
			. ' wifedeath.d_gid = fam.f_wife AND'
			. " wifedeath.d_fact IN ('DEAT', 'BURI', 'CREM') AND"
			. ' married.d_gid = fam.f_id AND'
			. " married.d_fact = 'MARR' AND"
			. ' married.d_julianday1 < wifedeath.d_julianday2 AND'
			. ' married.d_julianday1 <> 0'
			. ' GROUP BY'
			. ' family'
			. ' ORDER BY'
			. " age {$age_dir}"
		);
		$drows = $gBitDb->getAll( ''
			. ' SELECT DISTINCT'
			. ' fam.f_id AS family,'
			. ' MIN(divorced.d_julianday2-married.d_julianday1) AS age'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS divorced ON divorced.d_file = {$this->_ged_id}"
			. ' WHERE'
			. " fam.f_file = {$this->_ged_id} AND"
			. ' married.d_gid = fam.f_id AND'
			. " married.d_fact = 'MARR' AND"
			. ' divorced.d_gid = fam.f_id AND'
			. " divorced.d_fact IN ('DIV', 'ANUL', '_SEPR', '_DETS') AND"
			. ' married.d_julianday1 < divorced.d_julianday2 AND'
			. ' married.d_julianday1 <> 0'
			. ' GROUP BY'
			. ' family'
			. ' ORDER BY'
			. " age {$age_dir}"
		);
		if (!isset( $hrows ) && !isset( $wrows ) && !isset( $drows )) {
			return 0;
		}
		$rows = [];
		foreach ( $drows as $family ) {
			$rows[$family['family']] = $family['age'];
		}
		foreach ( $hrows as $family ) {
			if (!isset( $rows[$family['family']] ))
				$rows[$family['family']] = $family['age'];
		}
		foreach ( $wrows as $family ) {
			if (!isset( $rows[$family['family']] )) {
				$rows[$family['family']] = $family['age'];
			}
			elseif ($rows[$family['family']] > $family['age']) {
				$rows[$family['family']] = $family['age'];
			}
		}
		if ($age_dir == 'DESC') {
			arsort( $rows );
		}
		else {
			asort( $rows );
		}
		$top10 = [];
		$i = 0;
		$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
		if (!function_exists( $func )) {
			$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
		}
		$show_years = true;
		foreach ( $rows as $fam => $age ) {
			$family = Family::getInstance( $fam );
			if ($type == 'name') {
				return $family->format_list( 'span', false, $family->getFullName() );
			}
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else {
				$age .= 'd';
			}
			$func( $age, $show_years );
			if ($type == 'age') {
				return $age;
			}
			$husb = $family->getHusband();
			$wife = $family->getWife();
			if (( $husb->getAllDeathDates() && $wife->getAllDeathDates() ) || !$husb->isDead() || !$wife->isDead()) {
				if ($family->canDisplayDetails()) {
					$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [" . $age . "]" ) . "</li>\n" : "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [" . $age . "]" );
				}
				if (++$i == $total)
					break;
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function _ageBetweenSpousesQuery( $type = 'list', $age_dir = 'DESC', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang, $lang_short_cut, $LANGUAGE;
		$total = ( $params !== null && isset( $params[0] ) ) ? $params[0] : 10;
		switch ($age_dir) {
			case 'DESC':
				$query1 = ' MIN(wifebirth.d_julianday2-husbbirth.d_julianday1) AS age';
				$query2 = ' wifebirth.d_julianday2 >= husbbirth.d_julianday1 AND'
					. ' husbbirth.d_julianday1 <> 0';
				break;
			default:
				$query1 = ' MIN(husbbirth.d_julianday2-wifebirth.d_julianday1) AS age';
				$query2 = ' wifebirth.d_julianday1 < husbbirth.d_julianday2 AND'
					. ' wifebirth.d_julianday1 <> 0';
				break;
		}
		$rows = $gBitDb->getAll( ''
			. ' SELECT FIRST ? DISTINCT'
			. ' fam.f_id AS family,'
			. $query1
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS wifebirth ON wifebirth.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS husbbirth ON husbbirth.d_file = {$this->_ged_id}"
			. ' WHERE'
			. " fam.f_file = {$this->_ged_id} AND"
			. ' husbbirth.d_gid = fam.f_husb AND'
			. " husbbirth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. ' wifebirth.d_gid = fam.f_wife AND'
			. " wifebirth.d_fact IN ('BIRT', 'CHR', 'BAPM', '_BRTM') AND"
			. $query2
			. ' GROUP BY'
			. ' family'
			. ' ORDER BY'
			. " age DESC"
			, [ $total ] );
		if (!isset( $rows[0] )) {
			return '';
		}
		$top10 = [];
		$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
		if (!function_exists( $func )) {
			$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
		}
		$show_years = true;
		foreach ( $rows as $fam ) {
			$family = Family::getInstance( $fam['family'] );
			if ($fam['age'] < 0)
				break;
			$age = $fam['age'];
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else {
				$age .= 'd';
			}
			$func( $age, $show_years );
			if ($family->canDisplayDetails()) {
				$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [" . $age . "]" ) . "</li>\n" : "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [" . $age . "]" );
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function _parentsQuery( $type = 'full', $age_dir = 'ASC', $sex = 'F', $show_years = false )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;
		$sex_field = ( $sex == 'F' ) ? 'WIFE' : 'HUSB';
		if ($age_dir != 'ASC') {
			$age_dir = 'DESC';
		}
		$rows = $gBitDb->getAll( ''
			. ' SELECT DISTINCT'
			. ' parentfamily.l_to AS id,'
			. ' childbirth.d_julianday2-birth.d_julianday1 AS age'
			. ' FROM'
			. " {$TBLPREFIX}link AS parentfamily"
			. ' JOIN'
			. " {$TBLPREFIX}link AS childfamily ON childfamily.l_file = {$this->_ged_id}"
			. ' JOIN'
			. " {$TBLPREFIX}dates AS birth ON birth.d_file = {$this->_ged_id}"
			. ' JOIN'
			. " {$TBLPREFIX}dates AS childbirth ON childbirth.d_file = {$this->_ged_id}"
			. ' WHERE'
			. ' birth.d_gid = parentfamily.l_to AND'
			. ' childfamily.l_to = childbirth.d_gid AND'
			. " childfamily.l_type = 'CHIL' AND"
			. " parentfamily.l_type = '{$sex_field}' AND"
			. ' childfamily.l_from = parentfamily.l_from AND'
			. " parentfamily.l_file = {$this->_ged_id} AND"
			. " birth.d_fact = 'BIRT' AND"
			. " childbirth.d_fact = 'BIRT' AND"
			. ' birth.d_julianday1 <> 0 AND'
			. ' childbirth.d_julianday2 > birth.d_julianday1'
			. ' ORDER BY'
			. " age {$age_dir}"
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		if (isset( $row['id'] ))
			$person = Person::getInstance( $row['id'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( $person->canDisplayDetails() ) ? $person->format_list( 'span', false, $person->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'name':
				$result = "<a href=\"" . encode_url( $person->getLinkUrl() ) . "\">" . $person->getFullName() . '</a>';
				break;
			case 'age':
				$age = $row['age'];
				if ($show_years) {
					$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
					if (!function_exists( $func )) {
						$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
					}
					if (floor( $age / 365.25 ) > 0) {
						$age = floor( $age / 365.25 ) . 'y';
					}
					else if (floor( $age / 30.43 ) > 0) {
						$age = floor( $age / 30.43 ) . 'm';
					}
					else {
						$age .= 'd';
					}
					$func( $age, $show_years );
					$result = $age;
				}
				else {
					$result = floor( $age / 365.25 );
				}
				break;
		}
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function statsMarr( $simple = true, $first = false, $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;

		if ($simple) {
			$sql = "SELECT ROUND((d_year+49.1)/100) AS century, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. 'd_year<>0 AND '
				. "d_fact='MARR' AND "
				. "d_type='@#DGREGORIAN@'";
			if ($year1 >= 0 && $year2 >= 0) {
				$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
			}
			$sql .= " GROUP BY century ORDER BY century";
		}
		else if ($first) {
			$years = '';
			if ($year1 >= 0 && $year2 >= 0) {
				$years = " married.d_year BETWEEN '{$year1}' AND '{$year2}' AND";
			}
			$sql = ''
				. ' SELECT'
				. ' fam.f_id AS fams,'
				. ' fam.f_husb, fam.f_wife,'
				. ' married.d_julianday2 AS age,'
				. ' married.d_month AS month,'
				. ' indi.i_id AS indi'
				. ' FROM'
				. " {$TBLPREFIX}families AS fam"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}individuals AS indi ON indi.i_file = {$this->_ged_id}"
				. ' WHERE'
				. ' married.d_gid = fam.f_id AND'
				. " fam.f_file = {$this->_ged_id} AND"
				. " married.d_fact = 'MARR' AND"
				. ' married.d_julianday2 <> 0 AND'
				. $years
				. ' (indi.i_id = fam.f_husb OR indi.i_id = fam.f_wife)'
				. ' ORDER BY fams, indi, age ASC';
		}
		else {
			$sql = "SELECT d_month, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. "d_fact='MARR'";
			if ($year1 >= 0 && $year2 >= 0) {
				$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
			}
			$sql .= " GROUP BY d_month";
		}
		$rows = $gBitDb->getAll( $sql );
		if (!isset( $rows )) {
			return 0;
		}
		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
			$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
			$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
			$sizes = explode( 'x', $size );
			$tot = 0;
			foreach ( $rows as $values ) {
				$tot += $values['total'];
			}
			// Beware divide by zero
			if ($tot == 0)
				return '';
			$centuries = "";
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			$counts = [];
			foreach ( $rows as $values ) {
				$century = ( function_exists( $func ) ) ? $func( $values['century'] ) : $values['century'];
				$counts[] = round( 100 * $values['total'] / $tot, 0 );
				$centuries .= $century . ' - ' . $values['total'] . '|';
			}
			$chd = self::_array_to_extended_encoding( $counts );
			$chl = substr( $centuries, 0, -1 );
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_7_marr"] . "\" title=\"" . $pgv_lang["stat_7_marr"] . "\" />";
		}
		return $rows;
	}

	public function statsDiv( $simple = true, $first = false, $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;

		if ($simple) {
			$sql = "SELECT ROUND((d_year+49.1)/100) AS century, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. 'd_year<>0 AND '
				. "d_fact IN ('DIV', 'ANUL', '_SEPR') AND "
				. "d_type='@#DGREGORIAN@'";
			if ($year1 >= 0 && $year2 >= 0) {
				$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
			}
			$sql .= " GROUP BY century ORDER BY century";
		}
		else if ($first) {
			$years = '';
			if ($year1 >= 0 && $year2 >= 0) {
				$years = " divorced.d_year BETWEEN '{$year1}' AND '{$year2}' AND";
			}
			$sql = ''
				. ' SELECT'
				. ' fam.f_id AS fams,'
				. ' fam.f_husb, fam.f_wife,'
				. ' divorced.d_julianday2 AS age,'
				. ' divorced.d_month AS month,'
				. ' indi.i_id AS indi'
				. ' FROM'
				. " {$TBLPREFIX}families AS fam"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS divorced ON divorced.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}individuals AS indi ON indi.i_file = {$this->_ged_id}"
				. ' WHERE'
				. ' divorced.d_gid = fam.f_id AND'
				. " fam.f_file = {$this->_ged_id} AND"
				. " divorced.d_fact IN ('DIV', 'ANUL', '_SEPR') AND"
				. ' divorced.d_julianday2 <> 0 AND'
				. $years
				. ' (indi.i_id = fam.f_husb OR indi.i_id = fam.f_wife)'
				. ' ORDER BY fams, indi, age ASC';
		}
		else {
			$sql = "SELECT d_month, COUNT(*) AS total FROM {$TBLPREFIX}dates "
				. "WHERE "
				. "d_file={$this->_ged_id} AND "
				. "d_fact IN ('DIV', 'ANUL', '_SEPR')";
			if ($year1 >= 0 && $year2 >= 0) {
				$sql .= " AND d_year BETWEEN '{$year1}' AND '{$year2}'";
			}
			$sql .= " GROUP BY d_month";
		}
		$rows = $gBitDb->getAll( $sql );
		if (!isset( $rows )) {
			return 0;
		}
		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
			$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
			$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
			$sizes = explode( 'x', $size );
			$tot = 0;
			foreach ( $rows as $values ) {
				$tot += $values['total'];
			}
			// Beware divide by zero
			if ($tot == 0)
				return '';
			$centuries = "";
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			$counts = [];
			foreach ( $rows as $values ) {
				$century = ( function_exists( $func ) ) ? $func( $values['century'] ) : $values['century'];
				$counts[] = round( 100 * $values['total'] / $tot, 0 );
				$centuries .= $century . ' - ' . $values['total'] . '|';
			}
			$chd = self::_array_to_extended_encoding( $counts );
			$chl = substr( $centuries, 0, -1 );
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_7_div"] . "\" title=\"" . $pgv_lang["stat_7_div"] . "\" />";
		}
		return $rows;
	}

	//
	// Marriage
	//
	public function firstMarriage()
	{
		return $this->_mortalityQuery( 'full', 'ASC', 'MARR' );
	}

	public function firstMarriageYear()
	{
		return $this->_mortalityQuery( 'year', 'ASC', 'MARR' );
	}

	public function firstMarriageName()
	{
		return $this->_mortalityQuery( 'name', 'ASC', 'MARR' );
	}

	public function firstMarriagePlace()
	{
		return $this->_mortalityQuery( 'place', 'ASC', 'MARR' );
	}

	public function lastMarriage()
	{
		return $this->_mortalityQuery( 'full', 'DESC', 'MARR' );
	}

	public function lastMarriageYear()
	{
		return $this->_mortalityQuery( 'year', 'DESC', 'MARR' );
	}

	public function lastMarriageName()
	{
		return $this->_mortalityQuery( 'name', 'DESC', 'MARR' );
	}

	public function lastMarriagePlace()
	{
		return $this->_mortalityQuery( 'place', 'DESC', 'MARR' );
	}

	//
	// Divorce
	//
	public function firstDivorce()
	{
		return $this->_mortalityQuery( 'full', 'ASC', 'DIV' );
	}

	public function firstDivorceYear()
	{
		return $this->_mortalityQuery( 'year', 'ASC', 'DIV' );
	}

	public function firstDivorceName()
	{
		return $this->_mortalityQuery( 'name', 'ASC', 'DIV' );
	}

	public function firstDivorcePlace()
	{
		return $this->_mortalityQuery( 'place', 'ASC', 'DIV' );
	}

	public function lastDivorce()
	{
		return $this->_mortalityQuery( 'full', 'DESC', 'DIV' );
	}

	public function lastDivorceYear()
	{
		return $this->_mortalityQuery( 'year', 'DESC', 'DIV' );
	}

	public function lastDivorceName()
	{
		return $this->_mortalityQuery( 'name', 'DESC', 'DIV' );
	}

	public function lastDivorcePlace()
	{
		return $this->_mortalityQuery( 'place', 'DESC', 'DIV' );
	}

	public function statsMarrAge( $simple = true, $sex = 'M', $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;

		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : '200x250';
			$sizes = explode( 'x', $size );
			$rows = $gBitDb->getAll( ''
				. ' SELECT'
				. ' ROUND(AVG(married.d_julianday2-birth.d_julianday1-182.5)/365.25,1) AS age,'
				. ' ROUND((married.d_year+49.1)/100) AS century,'
				. ' indi.i_sex AS sex'
				. ' FROM'
				. " {$TBLPREFIX}families AS fam"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS birth ON birth.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}individuals AS indi ON indi.i_file = {$this->_ged_id}"
				. ' WHERE'
				. ' birth.d_gid = indi.i_id AND'
				. ' married.d_gid = fam.f_id AND'
				. " (indi.i_id = fam.f_wife OR"
				. " indi.i_id = fam.f_husb) AND"
				. " fam.f_file = {$this->_ged_id} AND"
				. " birth.d_fact = 'BIRT' AND"
				. " married.d_fact = 'MARR' AND"
				. ' birth.d_julianday1 <> 0 AND'
				. " birth.d_type='@#DGREGORIAN@' AND"
				. " married.d_type='@#DGREGORIAN@' AND"
				. ' married.d_julianday2 > birth.d_julianday1'
				. ' GROUP BY century, sex ORDER BY century, sex' );
			if (empty( $rows ))
				return '';
			$max = 0;
			foreach ( $rows as $values ) {
				if ($max < $values['age'])
					$max = $values['age'];
			}
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			$chxl = "0:|";
			$chmm = "";
			$chmf = "";
			$i = 0;
			$male = true;
			$temp = "";
			$countsm = "";
			$countsf = "";
			$countsa = "";
			foreach ( $rows as $values ) {
				$chage = ( $max <= 50 ) ? $values['age'] * 2 : $values['age'];
				if ($temp != $values['century']) {
					$temp = $values['century'];
					if ($sizes[0] < 1000)
						$sizes[0] += 50;
					$century = ( function_exists( $func ) ) ? $func( $values['century'], false ) : $values['century'];
					$chxl .= $century . "|";
					if ($values['sex'] == "F") {
						if (!$male) {
							$countsm .= "0,";
							$chmm .= 't0,000000,0,' . ( $i - 1 ) . ',11,1|';
							$countsa .= $fage . ",";
						}
						$countsf .= $chage . ",";
						$chmf .= 't' . $values['age'] . ',000000,1,' . $i . ',11,1|';
						$fage = $chage;
						$male = false;
					}
					else if ($values['sex'] == "M") {
						$countsf .= "0,";
						$chmf .= 't0,000000,1,' . $i . ',11,1|';
						$countsm .= $chage . ",";
						$chmm .= 't' . $values['age'] . ',000000,0,' . $i . ',11,1|';
						$countsa .= $chage . ",";
					}
					else if ($values['sex'] == "U") {
						$countsf .= "0,";
						$chmf .= 't0,000000,1,' . $i . ',11,1|';
						$countsm .= "0,";
						$chmm .= 't0,000000,0,' . $i . ',11,1|';
						$countsa .= "0,";
					}
					$i++;
				}
				else if ($values['sex'] == "M") {
					$countsm .= $chage . ",";
					$chmm .= 't' . $values['age'] . ',000000,0,' . ( $i - 1 ) . ',11,1|';
					$countsa .= round( ( $fage + $chage ) / 2, 1 ) . ",";
					$male = true;
				}
			}
			if (!$male) {
				$countsa .= $fage . ",";
			}
			$countsm = substr( $countsm, 0, -1 );
			$countsf = substr( $countsf, 0, -1 );
			$countsa = substr( $countsa, 0, -1 );
			$chmf = substr( $chmf, 0, -1 );
			$chd = "t2:{$countsm}|{$countsf}|{$countsa}";
			if ($max <= 50)
				$chxl .= "1:||" . $pgv_lang["century"] . "|2:|0|10|20|30|40|50|3:||" . $pgv_lang["stat_age"] . "|";
			else
				$chxl .= "1:||" . $pgv_lang["century"] . "|2:|0|10|20|30|40|50|60|70|80|90|100|3:||" . $pgv_lang["stat_age"] . "|";
			if (count( $rows ) > 4 || UTF8_strlen( $pgv_lang["stat_19_aarm"] ) < 30) {
				$chtt = $pgv_lang["stat_19_aarm"];
			}
			else {
				$offset = 0;
				$counter = [];
				while ( $offset = strpos( $pgv_lang["stat_19_aarm"], " ", $offset + 1 ) ) {
					$counter[] = $offset;
				}
				$half = floor( count( $counter ) / 2 );
				$chtt = substr_replace( $pgv_lang["stat_19_aarm"], '|', $counter[$half], 1 );
			}
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=bvg&amp;chs={$sizes[0]}x{$sizes[1]}&amp;chm=D,FF0000,2,0,3,1|{$chmm}{$chmf}&amp;chf=bg,s,ffffff00|c,s,ffffff00&amp;chtt={$chtt}&amp;chd={$chd}&amp;chco=0000FF,FFA0CB,FF0000&amp;chbh=20,3&amp;chxt=x,x,y,y&amp;chxl={$chxl}&amp;chdl={$pgv_lang["male"]}|{$pgv_lang["female"]}|{$pgv_lang["avg_age"]}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_19_aarm"] . "\" title=\"" . $pgv_lang["stat_19_aarm"] . "\" />";
		}
		else {
			$years = '';
			if ($year1 >= 0 && $year2 >= 0) {
				$years = " AND married.d_year BETWEEN '{$year1}' AND '{$year2}'";
			}
			if ($sex == 'F') {
				$sex_field = 'fam.f_wife,';
				$sex_field2 = " indi.i_id = fam.f_wife AND";
				$sex_search = " AND i_sex='F'";
			}
			else if ($sex == 'M') {
				$sex_field = 'fam.f_husb,';
				$sex_field2 = " indi.i_id = fam.f_husb AND";
				$sex_search = " AND i_sex='M'";
			}
			$rows = $gBitDb->getAll( ''
				. ' SELECT'
				. ' fam.f_id,'
				. $sex_field
				. ' married.d_julianday2-birth.d_julianday1 AS age,'
				. ' indi.i_id AS indi'
				. ' FROM'
				. " {$TBLPREFIX}families AS fam"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS birth ON birth.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}individuals AS indi ON indi.i_file = {$this->_ged_id}"
				. ' WHERE'
				. ' birth.d_gid = indi.i_id AND'
				. ' married.d_gid = fam.f_id AND'
				. $sex_field2
				. " fam.f_file = {$this->_ged_id} AND"
				. " birth.d_fact = 'BIRT' AND"
				. " married.d_fact = 'MARR' AND"
				. ' birth.d_julianday1 <> 0 AND'
				. ' married.d_julianday2 > birth.d_julianday1'
				. $sex_search
				. $years
				. ' ORDER BY indi, age ASC' );
			if (!isset( $rows )) {
				return 0;
			}
			return $rows;
		}
	}

	//
	// Female only
	//
	public function youngestMarriageFemale()
	{
		return $this->_marriageQuery( 'full', 'ASC', 'F' );
	}

	public function youngestMarriageFemaleName()
	{
		return $this->_marriageQuery( 'name', 'ASC', 'F' );
	}

	public function youngestMarriageFemaleAge( $show_years = false )
	{
		return $this->_marriageQuery( 'age', 'ASC', 'F', $show_years );
	}

	public function oldestMarriageFemale()
	{
		return $this->_marriageQuery( 'full', 'DESC', 'F' );
	}

	public function oldestMarriageFemaleName()
	{
		return $this->_marriageQuery( 'name', 'DESC', 'F' );
	}

	public function oldestMarriageFemaleAge( $show_years = false )
	{
		return $this->_marriageQuery( 'age', 'DESC', 'F', $show_years );
	}

	//
	// Male only
	//
	public function youngestMarriageMale()
	{
		return $this->_marriageQuery( 'full', 'ASC', 'M' );
	}

	public function youngestMarriageMaleName()
	{
		return $this->_marriageQuery( 'name', 'ASC', 'M' );
	}

	public function youngestMarriageMaleAge( $show_years = false )
	{
		return $this->_marriageQuery( 'age', 'ASC', 'M', $show_years );
	}

	public function oldestMarriageMale()
	{
		return $this->_marriageQuery( 'full', 'DESC', 'M' );
	}

	public function oldestMarriageMaleName()
	{
		return $this->_marriageQuery( 'name', 'DESC', 'M' );
	}

	public function oldestMarriageMaleAge( $show_years = false )
	{
		return $this->_marriageQuery( 'age', 'DESC', 'M', $show_years );
	}

	public function ageBetweenSpousesMF( $params = null )
	{
		return $this->_ageBetweenSpousesQuery( $type = 'nolist', $age_dir = 'DESC', $params = null );
	}

	public function ageBetweenSpousesMFList( $params = null )
	{
		return $this->_ageBetweenSpousesQuery( $type = 'list', $age_dir = 'DESC', $params = null );
	}

	public function ageBetweenSpousesFM( $params = null )
	{
		return $this->_ageBetweenSpousesQuery( $type = 'nolist', $age_dir = 'ASC', $params = null );
	}

	public function ageBetweenSpousesFMList( $params = null )
	{
		return $this->_ageBetweenSpousesQuery( $type = 'list', $age_dir = 'ASC', $params = null );
	}

	public function topAgeOfMarriageFamily()
	{
		return $this->_ageOfMarriageQuery( 'name', 'DESC', [ '1' ] );
	}

	public function topAgeOfMarriage()
	{
		return $this->_ageOfMarriageQuery( 'age', 'DESC', [ '1' ] );
	}

	public function topAgeOfMarriageFamilies( $params = null )
	{
		return $this->_ageOfMarriageQuery( 'nolist', 'DESC', $params );
	}

	public function topAgeOfMarriageFamiliesList( $params = null )
	{
		return $this->_ageOfMarriageQuery( 'list', 'DESC', $params );
	}

	public function minAgeOfMarriageFamily()
	{
		return $this->_ageOfMarriageQuery( 'name', 'ASC', [ '1' ] );
	}

	public function minAgeOfMarriage()
	{
		return $this->_ageOfMarriageQuery( 'age', 'ASC', [ '1' ] );
	}

	public function minAgeOfMarriageFamilies( $params = null )
	{
		return $this->_ageOfMarriageQuery( 'nolist', 'ASC', $params );
	}

	public function minAgeOfMarriageFamiliesList( $params = null )
	{
		return $this->_ageOfMarriageQuery( 'list', 'ASC', $params );
	}

	//
	// Mother only
	//
	public function youngestMother()
	{
		return $this->_parentsQuery( 'full', 'ASC', 'F' );
	}

	public function youngestMotherName()
	{
		return $this->_parentsQuery( 'name', 'ASC', 'F' );
	}

	public function youngestMotherAge( $show_years = false )
	{
		return $this->_parentsQuery( 'age', 'ASC', 'F', $show_years );
	}

	public function oldestMother()
	{
		return $this->_parentsQuery( 'full', 'DESC', 'F' );
	}

	public function oldestMotherName()
	{
		return $this->_parentsQuery( 'name', 'DESC', 'F' );
	}

	public function oldestMotherAge( $show_years = false )
	{
		return $this->_parentsQuery( 'age', 'DESC', 'F', $show_years );
	}

	//
	// Father only
	//
	public function youngestFather()
	{
		return $this->_parentsQuery( 'full', 'ASC', 'M' );
	}

	public function youngestFatherName()
	{
		return $this->_parentsQuery( 'name', 'ASC', 'M' );
	}

	public function youngestFatherAge( $show_years = false )
	{
		return $this->_parentsQuery( 'age', 'ASC', 'M', $show_years );
	}

	public function oldestFather()
	{
		return $this->_parentsQuery( 'full', 'DESC', 'M' );
	}

	public function oldestFatherName()
	{
		return $this->_parentsQuery( 'name', 'DESC', 'M' );
	}

	public function oldestFatherAge( $show_years = false )
	{
		return $this->_parentsQuery( 'age', 'DESC', 'M', $show_years );
	}

	public function totalMarriedMales()
	{
		global $TBLPREFIX, $gBitDb;

		$rows = $gBitDb->getAll( "SELECT f_gedcom AS ged, f_husb AS husb FROM {$TBLPREFIX}families WHERE f_file=?"
			, [ $this->_ged_id ] );
		$husb = [];
		foreach ( $rows as $row ) {
			$factrec = trim( get_sub_record( 1, "1 MARR", $row->ged, 1 ) );
			if (!empty( $factrec )) {
				$husb[] = $row->husb . "<br />";
			}
		}
		return count( array_unique( $husb ) );
	}

	public function totalMarriedFemales()
	{
		global $TBLPREFIX, $gBitDb;

		$rows = $gBitDb->getAll( "SELECT f_gedcom AS ged, f_wife AS wife FROM {$TBLPREFIX}families WHERE f_file=?"
			, [ $this->_ged_id ] );
		$wife = [];
		foreach ( $rows as $row ) {
			$factrec = trim( get_sub_record( 1, "1 MARR", $row->ged, 1 ) );
			if (!empty( $factrec )) {
				$wife[] = $row->wife . "<br />";
			}
		}
		return count( array_unique( $wife ) );
	}

	///////////////////////////////////////////////////////////////////////////////
// Family Size                                                               //
///////////////////////////////////////////////////////////////////////////////

	public function _familyQuery( $type = 'full' )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang;
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' f_numchil AS tot,'
			. ' f_id AS id'
			. ' FROM'
			. " {$TBLPREFIX}families"
			. ' WHERE'
			. " f_file={$this->_ged_id}"
			. ' ORDER BY'
			. ' tot DESC'
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$row = $rows[0];
		$family = Family::getInstance( $row['id'] );
		switch ($type) {
			default:
			case 'full':
				$result = ( $family->canDisplayDetails() ) ? $family->format_list( 'span', false, $family->getFullName() ) : $pgv_lang['privacy_error'];
				break;
			case 'size':
				$result = $row['tot'];
				break;
			case 'name':
				$result = "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() ) . '</a>';
				break;
		}
		// Statistics are used by RSS feeds, etc., so need absolute URLs.
		return str_replace( '<a href="', '<a href="' . $this->_server_url, $result );
	}

	public function _topTenFamilyQuery( $type = 'list', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang;
		$total = ( $params !== null && isset( $params[0] ) ) ? $params[0] : 10;
		$rows = $gBitDb->getAll( ''
			. ' SELECT FIRST ?'
			. ' f_numchil AS tot,'
			. ' f_id AS id'
			. ' FROM'
			. " {$TBLPREFIX}families"
			. ' WHERE'
			. " f_file={$this->_ged_id}"
			. ' ORDER BY'
			. ' tot DESC'
			, [ $total ] );
		if (!isset( $rows[0] )) {
			return '';
		}
		if (count( $rows ) < $total) {
			$total = count( $rows );
		}
		$top10 = [];
		for ( $c = 0; $c < $total; $c++ ) {
			$family = Family::getInstance( $rows[$c]['id'] );
			if ($family->canDisplayDetails()) {
				$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [{$rows[$c]['tot']} {$pgv_lang['lchildren']}]" ) . "</li>\n" : "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [{$rows[$c]['tot']} {$pgv_lang['lchildren']}]" );
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function _ageBetweenSiblingsQuery( $type = 'list', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang, $lang_short_cut, $LANGUAGE;
		if ($params === null) {
			$params = [];
		}
		$total = $params[0] ?? 10;
		$one = $params[1] ?? false; // each family only once if true
		$rows = $gBitDb->getAll( ''
			. ' SELECT FIRST ? DISTINCT'
			. ' link1.l_from AS family,'
			. ' link1.l_to AS ch1,'
			. ' link2.l_to AS ch2,'
			. ' child1.d_julianday2-child2.d_julianday2 AS age'
			. ' FROM'
			. " {$TBLPREFIX}link AS link1"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS child1 ON child1.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS child2 ON child2.d_file = {$this->_ged_id}"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}link AS link2 ON link2.l_file = {$this->_ged_id}"
			. ' WHERE'
			. " link1.l_file = {$this->_ged_id} AND"
			. ' link1.l_from = link2.l_from AND'
			. " link1.l_type = 'CHIL' AND"
			. ' child1.d_gid = link1.l_to AND'
			. " child1.d_fact = 'BIRT' AND"
			. " link2.l_type = 'CHIL' AND"
			. ' child2.d_gid = link2.l_to AND'
			. " child2.d_fact = 'BIRT' AND"
			. ' child1.d_julianday2 > child2.d_julianday2 AND'
			. ' child2.d_julianday2 <> 0 AND'
			. ' child1.d_gid <> child2.d_gid'
			. ' ORDER BY'
			. " age DESC"
			, [ $total ] );
		if (!isset( $rows[0] )) {
			return '';
		}
		$top10 = [];
		$func = "age_localisation_{$lang_short_cut[$LANGUAGE]}";
		if (!function_exists( $func )) {
			$func = "\Bitweaver\Phpgedview\DefaultAgeLocalisation";
		}
		$show_years = true;
		if ($one)
			$dist = [];
		foreach ( $rows as $fam ) {
			$family = Family::getInstance( $fam['family'] );
			$child1 = Person::getInstance( $fam['ch1'] );
			$child2 = Person::getInstance( $fam['ch2'] );
			if ($type == 'name') {
				if ($child1->canDisplayDetails() && $child2->canDisplayDetails()) {
					$return = "<a href=\"" . encode_url( $child2->getLinkUrl() ) . "\">" . PrintReady( $child2->getFullName() ) . "</a> ";
					$return .= $pgv_lang["and"] . " ";
					$return .= "<a href=\"" . encode_url( $child1->getLinkUrl() ) . "\">" . PrintReady( $child1->getFullName() ) . "</a>";
					$return .= " <a href=\"family.php?famid=" . $fam['family'] . "\">[" . $pgv_lang["view_family"] . "]</a>\n";
				}
				else {
					$return = $pgv_lang['privacy_error'];
				}
				return $return;
			}
			$age = $fam['age'];
			if (floor( $age / 365.25 ) > 0) {
				$age = floor( $age / 365.25 ) . 'y';
			}
			else if (floor( $age / 30.43 ) > 0) {
				$age = floor( $age / 30.43 ) . 'm';
			}
			else {
				$age .= 'd';
			}
			$func( $age, $show_years );
			if ($type == 'age') {
				return $age;
			}
			switch ($type) {
				case 'list':
					if ($one && !in_array( $fam['family'], $dist )) {
						if ($child1->canDisplayDetails() && $child2->canDisplayDetails()) {
							$return = "\t<li>";
							$return .= "<a href=\"" . encode_url( $child2->getLinkUrl() ) . "\">" . PrintReady( $child2->getFullName() ) . "</a> ";
							$return .= $pgv_lang["and"] . " ";
							$return .= "<a href=\"" . encode_url( $child1->getLinkUrl() ) . "\">" . PrintReady( $child1->getFullName() ) . "</a>";
							$return .= " [" . $age . "]";
							$return .= " <a href=\"family.php?famid=" . $fam['family'] . "\">[" . $pgv_lang["view_family"] . "]</a>";
							$return .= "\t</li>\n";
							$top10[] = $return;
							$dist[] = $fam['family'];
						}
					}
					else if (!$one && $child1->canDisplayDetails() && $child2->canDisplayDetails()) {
						$return = "\t<li>";
						$return .= "<a href=\"" . encode_url( $child2->getLinkUrl() ) . "\">" . PrintReady( $child2->getFullName() ) . "</a> ";
						$return .= $pgv_lang["and"] . " ";
						$return .= "<a href=\"" . encode_url( $child1->getLinkUrl() ) . "\">" . PrintReady( $child1->getFullName() ) . "</a>";
						$return .= " [" . $age . "]";
						$return .= " <a href=\"family.php?famid=" . $fam['family'] . "\">[" . $pgv_lang["view_family"] . "]</a>";
						$return .= "\t</li>\n";
						$top10[] = $return;
					}
					break;
				default:
					if ($child1->canDisplayDetails() && $child2->canDisplayDetails()) {
						$return = $child2->format_list( 'span', false, $child2->getFullName() );
						$return .= "<br />" . $pgv_lang["and"] . "<br />";
						$return .= $child1->format_list( 'span', false, $child1->getFullName() );
						//$return .= "<br />[".$age."]";
						$return .= "<br /><a href=\"family.php?famid=" . $fam['family'] . "\">[" . $pgv_lang["view_family"] . "]</a>\n";
						return $return;
					}
					break;
			}
		}
		if ($type == 'list') {
			$top10 = join( "\n", $top10 );
		}
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function largestFamily()
	{
		return $this->_familyQuery( 'full' );
	}

	public function largestFamilySize()
	{
		return $this->_familyQuery( 'size' );
	}

	public function largestFamilyName()
	{
		return $this->_familyQuery( 'name' );
	}

	public function topTenLargestFamily( $params = null )
	{
		return $this->_topTenFamilyQuery( 'nolist', $params );
	}

	public function topTenLargestFamilyList( $params = null )
	{
		return $this->_topTenFamilyQuery( 'list', $params );
	}

	public function chartLargestFamilies( $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_L_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_L_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$total = ( isset( $params[3] ) && $params[3] != '' ) ? strtolower( $params[3] ) : 10;
		$sizes = explode( 'x', $size );
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' f_numchil AS tot,'
			. ' f_id AS id'
			. ' FROM'
			. " {$TBLPREFIX}families"
			. ' WHERE'
			. " f_file={$this->_ged_id}"
			. ' ORDER BY'
			. ' tot DESC'
		);
		if (!isset( $rows[0] )) {
			return '';
		}
		$tot = 0;
		foreach ( $rows as $row ) {
			$tot += $row['tot'];
		}
		$chd = '';
		$chl = [];
		foreach ( $rows as $row ) {
			$family = Family::getInstance( $row['id'] );
			if ($family->canDisplayDetails()) {
				$per = ( $tot == 0 ) ? 0 : round( 100 * $row['tot'] / $tot, 0 );
				$chd .= self::_array_to_extended_encoding( [ $per ] );
				$chl[] = strip_tags( unhtmlentities( $family->getFullName() ) ) . ' - ' . $row['tot'];
			}
		}
		$chl = join( '|', $chl );

		// the following does not print Arabic letters in names - encode_url shows still the letters
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_largest_families"] . "\" title=\"" . $pgv_lang["stat_largest_families"] . "\" />";
	}

	public function totalChildren()
	{
		global $TBLPREFIX, $gBitDb;

		return
			$gBitDb->getOne(
				"SELECT SUM(f_numchil) FROM {$TBLPREFIX}families WHERE f_file={$this->_ged_id}"
				, [ $this->_ged_id ] );
	}

	public function averageChildren()
	{
		global $TBLPREFIX, $gBitDb;
		$rows = $gBitDb->getAll( "SELECT AVG(f_numchil) AS tot FROM {$TBLPREFIX}families WHERE f_file={$this->_ged_id}" );
		$row = $rows[0];
		return sprintf( '%.2f', $row['tot'] );
	}

	public function statsChildren( $simple = true, $sex = 'BOTH', $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;

		if ($simple) {
			$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : '220x200';
			$sizes = explode( 'x', $size );
			$max = 0;
			$rows = $gBitDb->getAll( ''
				. ' SELECT'
				. ' ROUND(AVG(f_numchil),2) AS num,'
				. ' ROUND((married.d_year+49.1)/100) AS century'
				. ' FROM'
				. " {$TBLPREFIX}families AS fam"
				. ' LEFT JOIN'
				. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
				. ' WHERE'
				. ' married.d_gid = fam.f_id AND'
				. " fam.f_file = {$this->_ged_id} AND"
				. " married.d_fact = 'MARR'"
				. ' GROUP BY century ORDER BY century' );
			if (empty( $rows ))
				return '';
			foreach ( $rows as $values ) {
				if ($max < $values['num'])
					$max = $values['num'];
			}
			$chm = "";
			$chxl = "0:|";
			$i = 0;
			$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
			$counts = [];
			foreach ( $rows as $values ) {
				if ($sizes[0] < 980)
					$sizes[0] += 38;
				if (function_exists( $func )) {
					$chxl .= $func( $values['century'], false ) . "|";
				}
				else {
					$chxl .= $values['century'] . "|";
				}
				$counts[] = ( $max <= 5 ) ? round( $values['num'] * 819.2 - 1, 1 ) : round( $values['num'] * 409.6, 1 );
				$chm .= 't' . $values['num'] . ',000000,0,' . $i . ',11,1|';
				$i++;
			}
			$chd = self::_array_to_extended_encoding( $counts );
			$chm = substr( $chm, 0, -1 );
			if ($max <= 5)
				$chxl .= "1:||" . $pgv_lang["century"] . "|2:|0|1|2|3|4|5|3:||" . $pgv_lang["stat_21_nok"] . "|";
			else
				$chxl .= "1:||" . $pgv_lang["century"] . "|2:|0|1|2|3|4|5|6|7|8|9|10|3:||" . $pgv_lang["stat_21_nok"] . "|";
			return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=bvg&amp;chs={$sizes[0]}x{$sizes[1]}&amp;chf=bg,s,ffffff00|c,s,ffffff00&amp;chm=D,FF0000,0,0,3,1|{$chm}&amp;chd=e:{$chd}&amp;chco=0000FF&amp;chbh=30,3&amp;chxt=x,x,y,y&amp;chxl={$chxl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_average_children"] . "\" title=\"" . $pgv_lang["stat_average_children"] . "\" />";
		}
		else {
			if ($sex == 'M') {
				$sql = "SELECT num, COUNT(*) AS total FROM "
					. "(SELECT count(i_sex) AS num FROM {$TBLPREFIX}link "
					. "LEFT OUTER JOIN {$TBLPREFIX}individuals "
					. "ON l_from=i_id AND l_file=i_file AND i_sex='M' AND l_type='FAMC' "
					. "JOIN {$TBLPREFIX}families ON f_file=l_file AND f_id=l_to WHERE f_file={$this->_ged_id} GROUP BY l_to"
					. ") boys"
					. " GROUP BY num ORDER BY num ASC";
			}
			else if ($sex == 'F') {
				$sql = "SELECT num, COUNT(*) AS total FROM "
					. "(SELECT count(i_sex) AS num FROM {$TBLPREFIX}link "
					. "LEFT OUTER JOIN {$TBLPREFIX}individuals "
					. "ON l_from=i_id AND l_file=i_file AND i_sex='F' AND l_type='FAMC' "
					. "JOIN {$TBLPREFIX}families ON f_file=l_file AND f_id=l_to WHERE f_file={$this->_ged_id} GROUP BY l_to"
					. ") girls"
					. " GROUP BY num ORDER BY num ASC";
			}
			else {
				$sql = "SELECT f_numchil, COUNT(*) AS total FROM {$TBLPREFIX}families ";
				if ($year1 >= 0 && $year2 >= 0) {
					$sql .= "AS fam LEFT JOIN {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
						. ' WHERE'
						. ' married.d_gid = fam.f_id AND'
						. " fam.f_file = {$this->_ged_id} AND"
						. " married.d_fact = 'MARR' AND"
						. " married.d_year BETWEEN '{$year1}' AND '{$year2}'";
				}
				else {
					$sql .= 'WHERE '
						. "f_file={$this->_ged_id}";
				}
				$sql .= ' GROUP BY f_numchil';
			}
			$rows = $gBitDb->getAll( $sql );
			if (!isset( $rows )) {
				return 0;
			}
			return $rows;
		}
	}

	public function topAgeBetweenSiblingsName( $params = null )
	{
		return $this->_ageBetweenSiblingsQuery( $type = 'name', $params = null );
	}

	public function topAgeBetweenSiblings( $params = null )
	{
		return $this->_ageBetweenSiblingsQuery( $type = 'age', $params = null );
	}

	public function topAgeBetweenSiblingsFullName( $params = null )
	{
		return $this->_ageBetweenSiblingsQuery( $type = 'nolist', $params = null );
	}

	public function topAgeBetweenSiblingsList( $params = null )
	{
		return $this->_ageBetweenSiblingsQuery( $type = 'list', $params = null );
	}

	public function noChildrenFamilies()
	{
		global $TBLPREFIX, $gBitDb;
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' COUNT(*) AS tot'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' WHERE'
			. ' f_numchil = 0 AND'
			. " fam.f_file = {$this->_ged_id}" );
		$row = $rows[0];
		return $row['tot'];
	}

	public function noChildrenFamiliesList( $type = 'list' )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION;
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' f_id AS family'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' WHERE'
			. ' f_numchil = 0 AND'
			. " fam.f_file = {$this->_ged_id}" );
		if (!isset( $rows[0] )) {
			return '';
		}
		$top10 = [];
		foreach ( $rows as $row ) {
			$family = Family::getInstance( $row['family'] );
			if ($family->canDisplayDetails()) {
				$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() ) . "</a></li>\n" : "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() ) . "</a>";
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function chartNoChildrenFamilies( $year1 = -1, $year2 = -1, $params = null )
	{
		global $TBLPREFIX, $gBitDb, $pgv_lang, $lang_short_cut, $LANGUAGE;

		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : '220x200';
		$sizes = explode( 'x', $size );
		$years = ( $year1 >= 0 && $year2 >= 0 ) ? " married.d_year BETWEEN '{$year1}' AND '{$year2}' AND" : "";
		$max = 0;
		$tot = 0;
		$rows = $gBitDb->getAll( ''
			. ' SELECT'
			. ' COUNT(*) AS num,'
			. ' ROUND((married.d_year+49.1)/100) AS century'
			. ' FROM'
			. " {$TBLPREFIX}families AS fam"
			. ' LEFT JOIN'
			. " {$TBLPREFIX}dates AS married ON married.d_file = {$this->_ged_id}"
			. ' WHERE'
			. ' f_numchil = 0 AND'
			. ' married.d_gid = fam.f_id AND'
			. " fam.f_file = {$this->_ged_id} AND"
			. $years
			. " married.d_fact = 'MARR' AND"
			. " married.d_type='@#DGREGORIAN@'"
			. ' GROUP BY century ORDER BY century' );
		if (empty( $rows ))
			return '';
		foreach ( $rows as $values ) {
			if ($max < $values['num'])
				$max = $values['num'];
			$tot += $values['num'];
		}
		$unknown = $this->noChildrenFamilies() - $tot;
		if ($unknown > $max)
			$max = $unknown;
		$chm = "";
		$chxl = "0:|";
		$i = 0;
		$func = "century_localisation_{$lang_short_cut[$LANGUAGE]}";
		foreach ( $rows as $values ) {
			if ($sizes[0] < 980)
				$sizes[0] += 38;
			if (function_exists( $func )) {
				$chxl .= $func( $values['century'], false ) . "|";
			}
			else {
				$chxl .= $values['century'] . "|";
			}
			$counts[] = round( 4095 * $values['num'] / ( $max + 1 ) );
			$chm .= 't' . $values['num'] . ',000000,0,' . $i . ',11,1|';
			$i++;
		}
		$counts[] = round( 4095 * $unknown / ( $max + 1 ) );
		$chd = self::_array_to_extended_encoding( $counts );
		$chm .= 't' . $unknown . ',000000,0,' . $i . ',11,1';
		$chxl .= $pgv_lang["no_date_fam"] . "|1:||" . $pgv_lang["century"] . "|2:|0|";
		$step = $max + 1;
		for ( $d = floor( $max + 1 ); $d > 0; $d-- ) {
			if (( $max + 1 ) < ( $d * 10 + 1 ) && fmod( $max + 1, $d ) == 0) {
				$step = $d;
			}
		}
		if ($step == floor( $max + 1 )) {
			for ( $d = floor( $max ); $d > 0; $d-- ) {
				if ($max < ( $d * 10 + 1 ) && fmod( $max, $d ) == 0) {
					$step = $d;
				}
			}
		}
		for ( $n = $step; $n <= ( $max + 1 ); $n += $step ) {
			$chxl .= $n . "|";
		}
		$chxl .= "3:||" . $pgv_lang["statnfam"] . "|";
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=bvg&amp;chs={$sizes[0]}x{$sizes[1]}&amp;chf=bg,s,ffffff00|c,s,ffffff00&amp;chm=D,FF0000,0,0:" . ( $i - 1 ) . ",3,1|{$chm}&amp;chd=e:{$chd}&amp;chco=0000FF,ffffff00&amp;chbh=30,3&amp;chxt=x,x,y,y&amp;chxl={$chxl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $pgv_lang["stat_22_fwok"] . "\" title=\"" . $pgv_lang["stat_22_fwok"] . "\" />";
	}

	public function _topTenGrandFamilyQuery( $type = 'list', $params = null )
	{
		global $TBLPREFIX, $gBitDb, $TEXT_DIRECTION, $pgv_lang;
		$total = $params !== null && isset( $params[0] ) ? $params[0] : 10;
		$rows = $gBitDb->getAll( ''
			. ' SELECT FIRST ?'
			. ' COUNT(*) AS tot,'
			. ' f_id AS id'
			. ' FROM'
			. " {$TBLPREFIX}families"
			. ' JOIN'
			. " {$TBLPREFIX}link AS children ON children.l_file = {$this->_ged_id}"
			. ' JOIN'
			. " {$TBLPREFIX}link AS mchildren ON mchildren.l_file = {$this->_ged_id}"
			. ' JOIN'
			. " {$TBLPREFIX}link AS gchildren ON gchildren.l_file = {$this->_ged_id}"
			. ' WHERE'
			. " f_file={$this->_ged_id} AND"
			. " children.l_from=f_id AND"
			. " children.l_type='CHIL' AND"
			. " children.l_to=mchildren.l_from AND"
			. " mchildren.l_type='FAMS' AND"
			. " mchildren.l_to=gchildren.l_from AND"
			. " gchildren.l_type='CHIL'"
			. ' GROUP BY'
			. ' id'
			. ' ORDER BY'
			. ' tot DESC'
			, [ $total ] );
		if (!isset( $rows[0] )) {
			return '';
		}
		$top10 = [];
		foreach ( $rows as $row ) {
			$family = Family::getInstance( $row['id'] );
			if ($family->canDisplayDetails()) {
				$top10[] = ( $type == 'list' ) ? "\t<li><a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [{$row['tot']} {$pgv_lang['grandchildren']}]" ) . "</li>\n" : "<a href=\"" . encode_url( $family->getLinkUrl() ) . "\">" . PrintReady( $family->getFullName() . "</a> [{$row['tot']} {$pgv_lang['grandchildren']}]" );
			}
		}
		$top10 = ( $type == 'list' ) ? join( "\n", $top10 ) : join( ';&nbsp; ', $top10 );
		if ($TEXT_DIRECTION == 'rtl') {
			$top10 = str_replace( [ '[', ']', '(', ')', '+' ], [ '&rlm;[', '&rlm;]', '&rlm;(', '&rlm;)', '&rlm;+' ], $top10 );
		}
		if ($type == 'list') {
			return "<ul>\n{$top10}</ul>\n";
		}
		return $top10;
	}

	public function topTenLargestGrandFamily( $params = null )
	{
		return $this->_topTenGrandFamilyQuery( 'nolist', $params );
	}

	public function topTenLargestGrandFamilyList( $params = null )
	{
		return $this->_topTenGrandFamilyQuery( 'list', $params );
	}

	///////////////////////////////////////////////////////////////////////////////
// Surnames                                                                  //
///////////////////////////////////////////////////////////////////////////////

	public static function _commonSurnamesQuery( $type = 'list', $show_tot = false, $params = null )
	{
		global $TEXT_DIRECTION, $COMMON_NAMES_THRESHOLD, $SURNAME_LIST_STYLE;

		$threshold = ( is_array( $params ) && isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $COMMON_NAMES_THRESHOLD;
		$maxtoshow = ( is_array( $params ) && isset( $params[1] ) && $params[1] != '' && $params[1] >= 0 ) ? strtolower( $params[1] ) : false;
		$sorting = ( is_array( $params ) && isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : 'alpha';
		$surname_list = get_common_surnames( $threshold );
		if (count( $surname_list ) == 0)
			return '';
		uasort( $surname_list, [ '\Bitweaver\Phpgedview\stats', '_name_total_rsort' ] );
		if ($maxtoshow > 0)
			$surname_list = array_slice( $surname_list, 0, $maxtoshow );

		switch ($sorting) {
			default:
			case 'alpha':
				uasort( $surname_list, [ '\Bitweaver\Phpgedview\stats', '_name_name_sort' ] );
				break;
			case 'ralpha':
				uasort( $surname_list, [ '\Bitweaver\Phpgedview\stats', '_name_name_rsort' ] );
				break;
			case 'count':
				uasort( $surname_list, [ '\Bitweaver\Phpgedview\stats', '_name_total_sort' ] );
				break;
			case 'rcount':
				uasort( $surname_list, [ '\Bitweaver\Phpgedview\stats', '_name_total_rsort' ] );
				break;
		}

		// Note that we count/display SPFX SURN, but sort/group under just SURN
		$surnames = [];
		foreach ( array_keys( $surname_list ) as $surname ) {
			$surnames = array_merge( $surnames, get_indilist_surns( $surname, '', false, false, PGV_GED_ID ) );
		}

		return format_surname_list( $surnames, $type == 'list' ? 1 : 2, $show_tot );
	}

	public function getCommonSurname()
	{
		$surnames = array_keys( get_top_surnames( $this->_ged_id, 1, 1 ) );
		return array_shift( $surnames );
	}

	public static function commonSurnames( $params = [ '', '', 'alpha' ] )
	{
		return self::_commonSurnamesQuery( 'nolist', false, $params );
	}

	public static function commonSurnamesTotals( $params = [ '', '', 'rcount' ] )
	{
		return self::_commonSurnamesQuery( 'nolist', true, $params );
	}

	public static function commonSurnamesList( $params = [ '', '', 'alpha' ] )
	{
		return self::_commonSurnamesQuery( 'list', false, $params );
	}

	public static function commonSurnamesListTotals( $params = [ '', '', 'rcount' ] )
	{
		return self::_commonSurnamesQuery( 'list', true, $params );
	}

	public function chartCommonSurnames( $params = null )
	{
		global $pgv_lang, $COMMON_NAMES_THRESHOLD, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$threshold = ( isset( $params[3] ) && $params[3] != '' ) ? strtolower( $params[3] ) : $COMMON_NAMES_THRESHOLD;
		$maxtoshow = ( isset( $params[4] ) && $params[4] != '' ) ? strtolower( $params[4] ) : 7;
		$sizes = explode( 'x', $size );
		$tot_indi = $this->totalIndividuals();
		$surnames = get_top_surnames( PGV_GED_ID, $threshold, 0 );
		if (count( $surnames ) <= 0) {
			return '';
		}
		uasort( $surnames, [ '\Bitweaver\Phpgedview\stats', '_name_total_rsort' ] );
		$surnames = array_slice( $surnames, 0, $maxtoshow );
		$all_surnames = [];
		foreach ( array_keys( $surnames ) as $n => $surname ) {
			if ($n >= $maxtoshow) {
				break;
			}
			$all_surnames = array_merge( $all_surnames, get_indilist_surns( UTF8_strtoupper( $surname ), '', false, false, PGV_GED_ID ) );
		}
		$tot = 0;
		$per = 0;
		foreach ( $surnames as $indexval => $surname ) {
			$tot += $surname['match'];
		}
		$chart_title = "";
		$chd = '';
		$chl = [];
		foreach ( $all_surnames as $surn => $surns ) {
			$count_per = 0;
			$max_name = 0;
			$top_name = 0;
			foreach ( $surns as $spfxsurn => $indis ) {
				$per = count( $indis );
				$count_per += $per;
				// select most common surname from all variants
				if ($per > $max_name) {
					$max_name = $per;
					$top_name = $spfxsurn;
				}
			}
			$per = round( 100 * $count_per / $tot_indi, 0 );
			$chd .= self::_array_to_extended_encoding( $per );
			//ToDo: RTL names are often printed LTR when also LTR names are present
			$chl[] = $top_name . ' - ' . $count_per;
			$chart_title .= $top_name . ' - ' . $count_per . ', ';

		}
		$per = round( 100 * ( $tot_indi - $tot ) / $tot_indi, 0 );
		$chd .= self::_array_to_extended_encoding( $per );
		$chl[] = $pgv_lang["other"] . ' - ' . ( $tot_indi - $tot );
		$chart_title .= $pgv_lang["other"] . ' - ' . ( $tot_indi - $tot );

		$chl = join( '|', $chl );
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
	}

	///////////////////////////////////////////////////////////////////////////////
// Given Names                                                               //
///////////////////////////////////////////////////////////////////////////////

	/*
	 * [ 1977282 ] Most Common Given Names Block
	 * Original block created by kiwi_pgv
	 */
	public static function _commonGivenQuery( $sex = 'B', $type = 'list', $show_tot = false, $params = null )
	{
		global $TEXT_DIRECTION, $GEDCOM, $TBLPREFIX, $gBitDb, $pgv_lang;
		static $sort_types = [ 'count' => 'asort', 'rcount' => 'arsort', 'alpha' => 'ksort', 'ralpha' => 'krsort' ];
		static $sort_flags = [ 'count' => SORT_NUMERIC, 'rcount' => SORT_NUMERIC, 'alpha' => SORT_STRING, 'ralpha' => SORT_STRING ];

		$threshold = ( is_array( $params ) && isset( $params[0] ) && $params[0] != '' && $params[0] >= 0 ) ? strtolower( $params[0] ) : 1;
		$maxtoshow = ( is_array( $params ) && isset( $params[1] ) && $params[1] != '' && $params[1] >= 0 ) ? strtolower( $params[1] ) : 10;
		$sorting = ( is_array( $params ) && isset( $params[2] ) && $params[2] != '' && isset( $sort_types[strtolower( $params[2] )] ) ) ? strtolower( $params[2] ) : 'rcount';

		switch ($sex) {
			case 'M':
				$sex_sql = "i_sex='M'";
				break;
			case 'F':
				$sex_sql = "i_sex='F'";
				break;
			case 'U':
				$sex_sql = "i_sex='U'";
				break;
			case 'B':
				$sex_sql = "i_sex<>'U'";
				break;
		}
		$ged_id = get_id_from_gedcom( $GEDCOM );

		$result = $gBitDb->getAll( "SELECT n_givn, COUNT(*) AS num FROM {$TBLPREFIX}name JOIN {$TBLPREFIX}individuals ON (n_id=i_id AND n_file=i_file) WHERE n_file={$ged_id} AND n_type!='_MARNM' AND n_givn NOT LIKE '%@P.N.%' AND CHAR_LENGTH(n_givn)>1 AND {$sex_sql} GROUP BY n_id, n_givn" );
		$nameList = [];
		foreach ( $result as $row ) {
			// Split "John Thomas" into "John" and "Thomas" and count against both totals
			foreach ( explode( ' ', $row['n_givn'] ) as $given ) {
				$given = str_replace( [ '*', '"' ], '', $given );
				if (strlen( $given ) > 1) {
					if (array_key_exists( $given, $nameList )) {
						$nameList[$given] += $row['num'];
					}
					else {
						$nameList[$given] = $row['num'];
					}
				}
			}
		}
		arsort( $nameList, SORT_NUMERIC );
		$nameList = array_slice( $nameList, 0, $maxtoshow );

		if (count( $nameList ) == 0)
			return '';
		if ($type == 'chart')
			return $nameList;
		$common = [];
		foreach ( $nameList as $given => $total ) {
			if ($maxtoshow !== -1) {
				if ($maxtoshow-- <= 0) {
					break;
				}
			}
			if ($total < $threshold) {
				break;
			}
			if ($show_tot) {
				$tot = PrintReady( "[{$total}]" );
				if ($TEXT_DIRECTION == 'ltr') {
					$totL = '';
					$totR = '&nbsp;' . $tot;
				}
				else {
					$totL = $tot . '&nbsp;';
					$totR = '';
				}
			}
			else {
				$totL = '';
				$totR = '';
			}
			switch ($type) {
				case 'table':
					$common[] = '<tr><td class="optionbox">' . PrintReady( UTF8_substr( $given, 0, 1 ) . UTF8_strtolower( UTF8_substr( $given, 1 ) ) ) . '</td><td class="optionbox">' . $total . '</td></tr>';
					break;
				case 'list':
					$common[] = "\t<li>{$totL}" . PrintReady( UTF8_substr( $given, 0, 1 ) . UTF8_strtolower( UTF8_substr( $given, 1 ) ) ) . "{$totR}</li>\n";
					break;
				case 'nolist':
					$common[] = $totL . PrintReady( UTF8_substr( $given, 0, 1 ) . UTF8_strtolower( UTF8_substr( $given, 1 ) ) ) . $totR;
					break;
			}
		}
		if ($common) {
			switch ($type) {
				case 'table':
					$lookup = [ 'M' => $pgv_lang['male'], 'F' => $pgv_lang['female'], 'U' => $pgv_lang['unknown'], 'B' => $pgv_lang['all'] ];
					return '<table><tr><td colspan="2" class="descriptionbox center">' . $lookup[$sex] . '</td></tr><tr><td class="descriptionbox center">' . $pgv_lang['names'] . '</td><td class="descriptionbox center">' . $pgv_lang['count'] . '</td></tr>' . join( '', $common ) . '</table>';
				case 'list':
					return "<ul>\n" . join( "\n", $common ) . "</ul>\n";
				case 'nolist':
					return join( ';&nbsp; ', $common );
			}
		}
		else {
			return '';
		}
	}

	public static function commonGiven( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'B', 'nolist', false, $params );
	}

	public static function commonGivenTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'B', 'nolist', true, $params );
	}

	public static function commonGivenList( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'B', 'list', false, $params );
	}

	public static function commonGivenListTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'B', 'list', true, $params );
	}

	public static function commonGivenTable( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'B', 'table', false, $params );
	}

	public static function commonGivenFemale( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'F', 'nolist', false, $params );
	}

	public static function commonGivenFemaleTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'F', 'nolist', true, $params );
	}

	public static function commonGivenFemaleList( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'F', 'list', false, $params );
	}

	public static function commonGivenFemaleListTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'F', 'list', true, $params );
	}

	public static function commonGivenFemaleTable( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'F', 'table', false, $params );
	}

	public static function commonGivenMale( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'M', 'nolist', false, $params );
	}

	public static function commonGivenMaleTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'M', 'nolist', true, $params );
	}

	public static function commonGivenMaleList( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'M', 'list', false, $params );
	}

	public static function commonGivenMaleListTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'M', 'list', true, $params );
	}

	public static function commonGivenMaleTable( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'M', 'table', false, $params );
	}

	public static function commonGivenUnknown( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'U', 'nolist', false, $params );
	}

	public static function commonGivenUnknownTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'U', 'nolist', true, $params );
	}

	public static function commonGivenUnknownList( $params = [ 1, 10, 'alpha' ] )
	{
		return self::_commonGivenQuery( 'U', 'list', false, $params );
	}

	public static function commonGivenUnknownListTotals( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'U', 'list', true, $params );
	}

	public static function commonGivenUnknownTable( $params = [ 1, 10, 'rcount' ] )
	{
		return self::_commonGivenQuery( 'U', 'table', false, $params );
	}

	public function chartCommonGiven( $params = null )
	{
		global $pgv_lang, $COMMON_NAMES_THRESHOLD, $PGV_STATS_CHART_COLOR1, $PGV_STATS_CHART_COLOR2, $PGV_STATS_S_CHART_X, $PGV_STATS_S_CHART_Y;
		if ($params === null) {
			$params = [];
		}
		$size = ( isset( $params[0] ) && $params[0] != '' ) ? strtolower( $params[0] ) : $PGV_STATS_S_CHART_X . "x" . $PGV_STATS_S_CHART_Y;
		$color_from = ( isset( $params[1] ) && $params[1] != '' ) ? strtolower( $params[1] ) : $PGV_STATS_CHART_COLOR1;
		$color_to = ( isset( $params[2] ) && $params[2] != '' ) ? strtolower( $params[2] ) : $PGV_STATS_CHART_COLOR2;
		$threshold = ( isset( $params[3] ) && $params[3] != '' ) ? strtolower( $params[3] ) : $COMMON_NAMES_THRESHOLD;
		$maxtoshow = ( isset( $params[4] ) && $params[4] != '' ) ? strtolower( $params[4] ) : 7;
		$sizes = explode( 'x', $size );
		$tot_indi = $this->totalIndividuals();
		$given = self::_commonGivenQuery( 'B', 'chart' );
		if (!is_array( $given ))
			return '';
		$given = array_slice( $given, 0, $maxtoshow );
		if (count( $given ) <= 0) {
			return '';
		}
		$tot = 0;
		foreach ( $given as $givn => $count ) {
			$tot += $count;
		}
		$chart_title = "";
		$chd = '';
		$chl = [];
		foreach ( $given as $givn => $count ) {
			$per = ( $tot == 0 ) ? 0 : round( 100 * $count / $tot_indi, 0 );
			$chd .= self::_array_to_extended_encoding( $per );
			//ToDo: RTL names are often printed LTR when also LTR names are present
			$chl[] = $givn . ' - ' . $count;
			$chart_title .= $givn . ' - ' . $count . ', ';

		}
		$per = round( 100 * ( $tot_indi - $tot ) / $tot_indi, 0 );
		$chd .= self::_array_to_extended_encoding( $per );
		$chl[] = $pgv_lang["other"] . ' - ' . ( $tot_indi - $tot );
		$chart_title .= $pgv_lang["other"] . ' - ' . ( $tot_indi - $tot );

		$chl = join( '|', $chl );
		return "<img src=\"" . encode_url( PHPGEDVIEW_PKG_URL."chart.php?cht=p3&amp;chd=e:{$chd}&amp;chs={$size}&amp;chco={$color_from},{$color_to}&amp;chf=bg,s,ffffff00&amp;chl={$chl}" ) . "\" width=\"{$sizes[0]}\" height=\"{$sizes[1]}\" alt=\"" . $chart_title . "\" title=\"" . $chart_title . "\" />";
	}

	///////////////////////////////////////////////////////////////////////////////
// Users                                                                     //
///////////////////////////////////////////////////////////////////////////////

	public static function _usersLoggedIn( $type = 'nolist' )
	{
		global $PGV_SESSION_TIME, $pgv_lang;
		// Log out inactive users
		foreach ( get_idle_users( time() - $PGV_SESSION_TIME ) as $user_id => $user_name ) {
			if ($user_id != PGV_USER_ID) {
				userLogout( $user_id );
			}
		}

		$content = '';
		// List active users
		$NumAnonymous = 0;
		$loggedusers = [];
		$x = get_logged_in_users();
		foreach ( $x as $user_id => $user_name ) {
			if (PGV_USER_IS_ADMIN || get_user_setting( $user_id, 'visibleonline' ) == 'Y') {
				$loggedusers[$user_id] = $user_name;
			}
			else {
				$NumAnonymous++;
			}
		}
		$LoginUsers = count( $loggedusers );
		if (( $LoginUsers == 0 ) and ( $NumAnonymous == 0 )) {
			return $pgv_lang['no_login_users'];
		}
		$Advisory = 'anon_user';
		if ($NumAnonymous > 1) {
			$Advisory .= 's';
		}
		if ($NumAnonymous > 0) {
			$pgv_lang['global_num1'] = $NumAnonymous; // Make it visible
			$content .= '<b>' . print_text( $Advisory, 0, 1 ) . '</b>';
		}
		$Advisory = 'login_user';
		if ($LoginUsers > 1) {
			$Advisory .= 's';
		}
		if ($LoginUsers > 0) {
			$pgv_lang['global_num1'] = $LoginUsers; // Make it visible
			if ($NumAnonymous) {
				if ($type == 'list') {
					$content .= "<br /><br />\n";
				}
				else {
					$content .= " {$pgv_lang['and']} ";
				}
			}
			if ($type == 'list') {
				$content .= '<b>' . print_text( $Advisory, 0, 1 ) . "</b>\n<ul>\n";
			}
			else {
				$content .= '<b>' . print_text( $Advisory, 0, 1 ) . "</b>: ";
			}
		}
		if (PGV_USER_ID) {
			foreach ( $loggedusers as $user_id => $user_name ) {
				if ($type == 'list') {
					$content .= "\t<li>" . PrintReady( getUserFullName( $user_id ) ) . " - {$user_name}";
				}
				else {
					$content .= PrintReady( getUserFullName( $user_id ) ) . " - {$user_name}";
				}
				if (PGV_USER_ID != $user_id && get_user_setting( $user_id, 'contactmethod' ) != 'none') {
					if ($type == 'list') {
						$content .= "<br /><a href=\"javascript:;\" onclick=\"return message('{$user_id}');\">{$pgv_lang['message']}</a>";
					}
					else {
						$content .= " <a href=\"javascript:;\" onclick=\"return message('{$user_id}');\">{$pgv_lang['message']}</a>";
					}
				}
				if ($type == 'list') {
					$content .= "</li>\n";
				}
			}
		}
		if ($type == 'list') {
			$content .= '</ul>';
		}
		return $content;
	}

	public static function _usersLoggedInTotal( $type = 'all' )
	{
		global $PGV_SESSION_TIME;

		foreach ( get_idle_users( time() - $PGV_SESSION_TIME ) as $user_id => $user_name ) {
			if ($user_id != PGV_USER_ID) {
				userLogout( $user_id );
			}
		}
		$anon = 0;
		$visible = 0;
		$x = get_logged_in_users();
		foreach ( $x as $user_id => $user_name ) {
			if (PGV_USER_IS_ADMIN || get_user_setting( $user_id, 'visibleonline' ) == 'Y') {
				$visible++;
			}
			else {
				$anon++;
			}
		}
		if ($type == 'anon') {
			return $anon;
		}
		elseif ($type == 'visible') {
			return $visible;
		}
		else {
			return $visible + $anon;
		}
	}

	public static function usersLoggedIn()
	{
		return self::_usersLoggedIn( 'nolist' );
	}

	public static function usersLoggedInList()
	{
		return self::_usersLoggedIn( 'list' );
	}

	public static function usersLoggedInTotal()
	{
		return self::_usersLoggedInTotal( 'all' );
	}

	public static function usersLoggedInTotalAnon()
	{
		return self::_usersLoggedInTotal( 'anon' );
	}

	public static function usersLoggedInTotalVisible()
	{
		return self::_usersLoggedInTotal( 'visible' );
	}

	public static function userID()
	{
		return getUserId();
	}

	public static function userName()
	{
		return getUserName();
	}

	public static function userFullName()
	{
		return getUserFullName( getUserId() );
	}

	public static function userFirstName()
	{
		return get_user_setting( getUserId(), 'firstname' );
	}

	public static function userLastName()
	{
		return get_user_setting( getUserId(), 'lastname' );
	}

	public static function _getLatestUserData( $type = 'userid', $params = null )
	{
		global $DATE_FORMAT, $TIME_FORMAT, $pgv_lang;
		static $user_id = null;

		if ($user_id === null) {
			$user_id = get_newest_registered_user();
		}

		switch ($type) {
			default:
			case 'userid':
				return $user_id;
			case 'username':
				return get_user_name( $user_id );
			case 'fullname':
				return getUserFullName( $user_id );
			case 'firstname':
				return get_user_setting( $user_id, 'firstname' );
			case 'lastname':
				return get_user_setting( $user_id, 'lastname' );
			case 'regdate':
				$datestamp = ( is_array( $params ) && isset( $params[0] ) && $params[0] != '' ) ? $params[0] : $DATE_FORMAT;
				return date( $datestamp, get_user_setting( $user_id, 'reg_timestamp' ) );
			case 'regtime':
				$datestamp = ( is_array( $params ) && isset( $params[0] ) && $params[0] != '' ) ? $params[0] : $TIME_FORMAT;
				return date( $datestamp, get_user_setting( $user_id, 'reg_timestamp' ) );
			case 'loggedin':
				$yes = ( is_array( $params ) && isset( $params[0] ) && $params[0] != '' ) ? $params[0] : $pgv_lang['yes'];
				$no = ( is_array( $params ) && isset( $params[1] ) && $params[1] != '' ) ? $params[1] : $pgv_lang['no'];
				return ( get_user_setting( $user_id, 'loggedin' ) == 'Y' ) ? $yes : $no;
		}
	}

	public static function latestUserId()
	{
		return self::_getLatestUserData( 'userid' );
	}

	public static function latestUserName()
	{
		return self::_getLatestUserData( 'username' );
	}

	public static function latestUserFullName()
	{
		return self::_getLatestUserData( 'fullname' );
	}

	public static function latestUserFirstName()
	{
		return self::_getLatestUserData( 'firstname' );
	}

	public static function latestUserLastName()
	{
		return self::_getLatestUserData( 'lastname' );
	}

	public static function latestUserRegDate( $params = null )
	{
		return self::_getLatestUserData( 'regdate', $params );
	}

	public static function latestUserRegTime( $params = null )
	{
		return self::_getLatestUserData( 'regtime', $params );
	}

	public static function latestUserLoggedin( $params = null )
	{
		return self::_getLatestUserData( 'loggedin', $params );
	}

	///////////////////////////////////////////////////////////////////////////////
// Contact                                                                   //
///////////////////////////////////////////////////////////////////////////////

	public static function contactWebmaster()
	{
		return user_contact_link( get_user_id( $GLOBALS['WEBMASTER_EMAIL'] ), $GLOBALS['SUPPORT_METHOD'] );
	}

	public static function contactGedcom()
	{
		return user_contact_link( get_user_id( $GLOBALS['CONTACT_EMAIL'] ), $GLOBALS['CONTACT_METHOD'] );
	}

	///////////////////////////////////////////////////////////////////////////////
// Date & Time                                                               //
///////////////////////////////////////////////////////////////////////////////

	public static function serverDate()
	{
		return timestamp_to_gedcom_date( time() )->Display( false );
	}

	public static function serverTime()
	{
		return date( 'g:i a' );
	}

	public static function serverTime24()
	{
		return date( 'G:i' );
	}

	public static function serverTimezone()
	{
		return date( 'T' );
	}

	public static function browserDate()
	{
		return timestamp_to_gedcom_date( client_time() )->Display( false );
	}

	public static function browserTime()
	{
		return date( 'g:i a', client_time() );
	}

	public static function browserTime24()
	{
		return date( 'G:i', client_time() );
	}

	public static function browserTimezone()
	{
		return date( 'T', client_time() );
	}

	///////////////////////////////////////////////////////////////////////////////
// Tools                                                                     //
///////////////////////////////////////////////////////////////////////////////

	/*
	 * Leave for backwards compatability? Anybody using this?
	 */
	public static function _getEventType( $type )
	{
		global $pgv_lang;
		$eventTypes = [
			'BIRT' => $pgv_lang['htmlplus_block_birth'],
			'DEAT' => $pgv_lang['htmlplus_block_death'],
			'MARR' => $pgv_lang['htmlplus_block_marrage'],
			'ADOP' => $pgv_lang['htmlplus_block_adoption'],
			'BURI' => $pgv_lang['htmlplus_block_burial'],
			'CENS' => $pgv_lang['htmlplus_block_census'],
		];
		if (isset( $eventTypes[$type] )) {
			return $eventTypes[$type];
		}
		return false;
	}

	// http://bendodson.com/news/google-extended-encoding-made-easy/
	public static function _array_to_extended_encoding($a) {
		if (!is_array($a)) {$a = [ $a ];}
		$encoding = '';
		foreach ($a as $value) {
			$value = round( $value,0);
			if ($value < 0) $value = 0;
			if ($value > 4095) $value = 4095;
			$first = ($value >> 6) & 0x3F;
			$second = $value & 0x3F;
			$encoding .= self::$_xencoding[$first].self::$_xencoding[$second];
		}
		return $encoding;
	}

	public static function _name_name_sort($a, $b) {
		return compareStrings(strip_prefix($a['name']), strip_prefix($b['name']), true);  // Case-insensitive compare
	}

	public static function _name_name_rsort($a, $b) {
		return compareStrings(strip_prefix($b['name']), strip_prefix($a['name']), true);  // Case-insensitive compare
	}

	public static function _name_total_sort($a, $b) {
		return $a['match']-$b['match'];
	}

	public static function _name_total_rsort($a, $b) {
		return $b['match']-$a['match'];
	}

	public static function _runSQL($sql, $count=0) {
		global $gBitDb;
		
		static $cache = [];
		$id = md5($sql)."_{$count}";
		if (isset($cache[$id])) {
			return $cache[$id];
		}
		$rows = $gBitDb->getAssoc($sql, [], $count);
		$cache[$id]=$rows;
		return $rows;
	}
}
