<?php
/**
 * Base class for all gedcom records
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2005	John Finlay and Others
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
 * Page does not validate see line number 1109 -> 15 August 2005
 *
 * @package PhpGedView
 * @subpackage DataModel
 * @version $Id$
 */

require_once('includes/person_class.php');
require_once('includes/family_class.php');
require_once('includes/source_class.php');
require_once('includes/repository_class.php');
class GedcomRecord {
	var $gedrec = "";
	var $xref = "";
	var $type = "";
	var $changed = false;
	var $rfn = null;

	/**
	 * constructor for this class
	 */
	function GedcomRecord($gedrec, $simple=false) {
		if (empty($gedrec)) return;

		//-- lookup the record from another gedcom
		$remoterfn = get_gedcom_value("RFN", 1, $gedrec);
		if (!empty($remoterfn)) {
			$parts = preg_split("/:/", $remoterfn);
			if (count($parts)==2) {
				$servid = $parts[0];
				$aliaid = $parts[1];
				if (!empty($servid)&&!empty($aliaid)) {
					require_once 'includes/serviceclient_class.php';
					$serviceClient = ServiceClient::getInstance($servid);
					if (!is_null($serviceClient)) {
						if (!$simple || $serviceClient->type=='local') {
							$gedrec = $serviceClient->mergeGedcomRecord($aliaid, $gedrec);
						}
					}
				}
			}
		}

		//-- set the gedcom record a privatized version
		$this->gedrec = privatize_gedcom($gedrec);
		$ct = preg_match("/0 @(.*)@ (.*)/", $this->gedrec, $match);
		if ($ct>0) {
			$this->xref = trim($match[1]);
			$this->type = trim($match[2]);
		}
	}

	/**
	 * Static function used to get an instance of an object
	 * @param string $pid	the ID of the object to retrieve
	 */
	function &getInstance($pid, $simple=true) {
		global $indilist, $famlist, $sourcelist, $repo_id_list, $otherlist, $GEDCOM, $GEDCOMS, $pgv_changes;

		//-- first check for the object in the cache
		if (isset($indilist[$pid]) && $indilist[$pid]['gedfile']==$GEDCOMS[$GEDCOM]['id']) {
			if (isset($indilist[$pid]['object'])) return $indilist[$pid]['object'];
		}
		if (isset($famlist[$pid]) && $famlist[$pid]['gedfile']==$GEDCOMS[$GEDCOM]['id']) {
			if (isset($famlist[$pid]['object'])) return $famlist[$pid]['object'];
		}
		if (isset($sourcelist[$pid]) && $sourcelist[$pid]['gedfile']==$GEDCOMS[$GEDCOM]['id']) {
			if (isset($sourcelist[$pid]['object'])) return $sourcelist[$pid]['object'];
		}
		if (isset($repo_id_list[$pid]) && $repo_id_list[$pid]['gedfile']==$GEDCOMS[$GEDCOM]['id']) {
			if (isset($repo_id_list[$pid]['object'])) return $repo_id_list[$pid]['object'];
		}
		if (isset($otherlist[$pid]) && $otherlist[$pid]['gedfile']==$GEDCOMS[$GEDCOM]['id']) {
			if (isset($otherlist[$pid]['object'])) return $otherlist[$pid]['object'];
		}

		//-- look for the gedcom record
		$indirec = find_gedcom_record($pid);
		if (empty($indirec)) {
			$ct = preg_match("/(\w+):(.+)/", $pid, $match);
			//-- check if it is a remote object
			if ($ct>0) {
				$servid = trim($match[1]);
				$remoteid = trim($match[2]);
				$service = ServiceClient::getInstance($servid);
				//-- the INDI will be replaced with the type from the remote record
				$newrec= $service->mergeGedcomRecord($remoteid, "0 @".$pid."@ INDI\r\n1 RFN ".$pid, false);
				$indirec = $newrec;
			}
		}
		//-- check if it is a new object not yet in the database
		if (empty($indirec)) {
			if (userCanEdit(getUserName()) && isset($pgv_changes[$pid."_".$GEDCOM])) {
				$indirec = find_updated_record($pid);
				$fromfile = true;
			}
		}
		if (empty($indirec)) return null;

		$ct = preg_match("/0 @.*@ (\w*)/", $indirec, $match);
		if ($ct>0) {
			$type = trim($match[1]);
			if ($type=="INDI") {
				$person = new Person($indirec, $simple);
				if (!empty($fromfile)) $person->setChanged(true);
				$indilist[$pid]['object'] = &$person;
				return $person;
			}
			else if ($type=="FAM") {
				$person = new Family($indirec, $simple);
				if (!empty($fromfile)) $person->setChanged(true);
				$famlist[$pid]['object'] = &$person;
				return $person;
			}
			else if ($type=="SOUR") {
				$person = new Source($indirec, $simple);
				if (!empty($fromfile)) $person->setChanged(true);
				$sourcelist[$pid]['object'] = &$person;
				return $person;
			}
			else {
				$person = new GedcomRecord($indirec, $simple);
				if (!empty($fromfile)) $person->setChanged(true);
				$otherlist[$pid]['object'] = &$person;
				return $person;
			}
		}
		return null;
	}

	/**
	 * get the xref
	 */
	function getXref() {
		return $this->xref;
	}
	/**
	 * get the object type
	 */
	function getType() {
		return $this->type;
	}
	/**
	 * get gedcom record
	 */
	function getGedcomRecord() {
		return $this->gedrec;
	}
	/**
	 * set gedcom record
	 */
	function setGedcomRecord($gcRec) {
		$this->gedrec = $gcRec;
	}
	/**
	 * set if this is a changed record from the gedcom file
	 * @param boolean $changed
	 */
	function setChanged($changed) {
		$this->changed = $changed;
	}
	/**
	 * get if this is a changed record from the gedcom file
	 * @return boolean
	 */
	function getChanged() {
		return $this->changed;
	}

	/**
	 * is this person from another server
	 * @return boolean 	return true if this person was linked from another server
	 */
	function isRemote() {
		if (is_null($this->rfn)) $this->rfn = get_gedcom_value("RFN", 1, $this->gedrec);
		$parts = preg_split("/:/", $this->rfn);
		if (count($parts)==2) {
			return true;
		}
		return false;
	}

	/**
	 * check if this object is equal to the given object
	 * basically just checks if the IDs are the same
	 * @param GedcomRecord $obj
	 */
	function equals(&$obj) {
		if (is_null($obj)) return false;
		if ($this->xref==$obj->getXref()) return true;
		return false;
	}

	/**
	 * get the URL to link to this person
	 * This method should be overriden in child sub-classes
	 * @string a url that can be used to link to this person
	 */
	function getLinkUrl() {
		global $GEDCOM, $SERVER_URL;

		$url = "index.php";
		if ($this->isRemote()) {
			$parts = preg_split("/:/", $this->rfn);
			$servid = $parts[0];
			$aliaid = $parts[1];
			$servrec = find_gedcom_record($servid);
			if (empty($servrec)) $servrec = find_updated_record($servid);
			if (!empty($servrec)) {
				$surl = get_gedcom_value("URL", 1, $servrec);
				$url = dirname($surl);
				$gedcom = get_gedcom_value("_DBID", 1, $servrec);
				if (!empty($gedcom)) $url.="?ged=".$gedcom;
			}
		}
		return $url;
	}

	/**
	 * return an absolute url for linking to this record from another site
	 *
	 */
	function getAbsoluteLinkUrl() {
		global $SERVER_URL;
		return $SERVER_URL . $this->getLinkUrl();
	}

	/**
	 * Undo the latest change to this gedcom record
	 */
	function undoChange() {
		global $GEDCOM, $pgv_changes;
		require_once('includes/functions_edit.php');
		if (!userCanAccept(getUserName())) return false;
		$cid = $this->xref."_".$GEDCOM;
		if (!isset($pgv_changes[$cid])) return false;
		$index = count($pgv_changes[$cid])-1;
		if (undo_change($cid, $index)) return true;
		return false;
	}

	/**
	 * check if this record has been marked for deletion
	 * @return boolean
	 */
	function isMarkedDeleted() {
		global $pgv_changes, $GEDCOM;

		if (!userCanEdit(getUserName())) return false;
		if (isset($pgv_changes[$this->xref."_".$GEDCOM])) {
			$change = end($pgv_changes[$this->xref."_".$GEDCOM]);
			if ($change['type']=='delete') return true;
		}

		return false;
	}

	/**
	 * can the details of this record be shown
	 * This method should be overridden in sub classes
	 * @return boolean
	 */
	function canDisplayDetails() {
		return displayDetails($this->gedrec, $this->type);
	}

	/**
	 * get the URL to link to a date
	 * @string a url that can be used to link to calendar
	 */
	function getDateUrl($gedcom_date) {
		global $GEDCOM;
		$pdate = parse_date($gedcom_date);
		if ($pdate[0]["year"]==0) return "javascript:;";
		$url = "calendar.php?action=year&amp;day=".$pdate[0]["day"]."&amp;month=".$pdate[0]["month"]."&amp;year=".$pdate[0]["year"]."&amp;ged=".$GEDCOM;
		return $url;
	}

	/**
	 * get the URL to link to a place
	 * @string a url that can be used to link to placelist
	 */
	function getPlaceUrl($gedcom_place) {
		global $GEDCOM;
		$exp = explode(",", $gedcom_place);
		$level = count($exp);
		$url = "placelist.php?action=show&amp;level=".$level;
		for ($i=0; $i<$level; $i++) $url .= "&amp;parent[".$i."]=".urlencode(trim($exp[$level-$i-1]));
		$url .= "&amp;ged=".$GEDCOM;
		return $url;
	}

	/**
	 * get the first part of a place record
	 * @string a url that can be used to link to placelist
	 */
	function getPlaceShort($gedcom_place) {
		global $GEDCOM;
		$gedcom_place = trim($gedcom_place, " ,");
		$exp = explode(",", $gedcom_place);
		return trim($exp[0]);
	}

	/**
	 * get  lastchange record
	 * @return string the lastchange record
	 */
	function getLastchangeRecord() {
		return trim(get_sub_record(1, "1 CHAN", $this->gedrec));
	}

	/**
	 * get  lastchange date
	 * @return string the lastchange date
	 */
	function getLastchangeDate() {
		return get_gedcom_value("DATE", 2, $this->getLastchangeRecord(), '', false);
	}

	/**
	 * get sortable lastchange date
	 * @return string the lastchange date in sortable format YYYY-MM-DD HH:MM
	 */
	function getSortableLastchangeDate() {
		$pdate = parse_date($this->getLastchangeDate());
		$ptime = get_gedcom_value("DATE:TIME", 2, $this->getLastchangeRecord());
		$sdate = sprintf("%04d-%02d-%02d %s", $pdate[0]["year"], $pdate[0]["mon"], $pdate[0]["day"], $ptime);
		return $sdate;
	}
}
