<?php
/**
 *  Entry point for SOAP web service
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
 * @subpackage Charts
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;

define('PGV_SCRIPT_NAME', 'genservice.php');
// require './config.php';

/**
 * we have to manually pull the SID from the SOAP request
 * in order to set the correct session during initialization.
 */
$SID = "";
//Only include and set the session if it's not a wsdl request
if(!isset($_SERVER['QUERY_STRING']) || strstr($_SERVER['QUERY_STRING'],'wsdl')===false)
{
	if (isset($HTTP_RAW_POST_DATA)) {
	//-- set the session id
	//	<SID xsi:type='xsd:string'>6ca1b44936bf4zb7202e6bd8ce4bkcbd<\SID>
		$ct = preg_match("~<[^>]*SID[^>]*>(.*)</\SID[^>]*>~", $HTTP_RAW_POST_DATA, $match);
		if ($ct>0) $SID = trim($match[1]);
		$MANUAL_SESSION_START = true;

		//-- set the gedcom id
	//	<gedcom_id xsi:type='xsd:string'>caposele<\gedcom_id>
		$ct = preg_match("~<[^>]*gedcom_id[^>]*>(.*)</\gedcom_id[^>]*>~", $HTTP_RAW_POST_DATA, $match);
		if ($ct>0) $_REQUEST['ged'] = trim($match[1]);

		//AddToLog("Setting SID to ".$SID." ".$HTTP_RAW_POST_DATA);
		//require_once PGV_ROOT.'includes/functions/functions_edit.php';
	}
}

require './config.php';

/**
 * load up the service implementation
 */
require_once './webservice/PGVServiceLogic.class.php';

$genealogyServer = new PGVServiceLogic();
//-- process the SOAP request
$server = $genealogyServer->process();
?>
