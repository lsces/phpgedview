<?php
/**
 * Abstract Genealogy Service Interface class
 * This file is released under the LGPL so that others may use it when
 * building compatible web services for their respective applications.
 *
 * To build a compatible web service simply include this file and extend
 * it with your own class and implement the following abstract methods:
 * - postAuthenticate($username, $password, $gedcom_id, $compression)
 * - getServiceInfo()
 * - getVar($SID, $varName)
 * - append($SID, $RID, $gedrec)
 * - delete($SID, $RID)
 * - postUpdateRecord($SID, $RID, $gedcom)
 * - postGetPersonByID($SID, $PID)
 * - postGetGedcomRecord($SID, $PID)
 * - postSearch($SID, $query, $start, $maxResults)
 * - postCheckUpdatesByID($SID,$RID,$lastUpdate)
 * - getKnownServers($SID,$limit)
 * - postGetAncestry($SID, $rootID, $generations, $returnGedcom)
 * - postGetDescendants($SID, $rootID, $generations, $returnGedcom)
 *
 * See the PGVServiceLogic.class.php file for details about how this was
 * done in PhpGedView.
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2011  PGV Development Team
 *
 * This library is free software; you can redistribute it and/or modify it
 * under the terms of the GNU Lesser General Public License as published by the
 * Free Software Foundation; either version 2.1 of the License, or (at your
 * option) any later version.
 *
 * This library is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE. See the GNU Lesser General Public License
 * for more details.
 *
 * You can obtain a copy of the GNU Lesser General Public License here:
 * http://www.opensource.org/licenses/lgpl-license.php
 *
 * Or by writing to the Free Software Foundation, Inc., 59 Temple Place, Suite
 * 330,Boston, MA 02111-1307 USA
 *
 * @package PhpGedView
 * @subpackage Webservice
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;

define('PGV_GENEALOGYSERVICE_PHP', '');

require_once UTIL_PKG_INCLUDE_PATH.'pear/SOAP/Server.php';

// Genealogy class
class GenealogyService
{
	public $__varValues = [];
	public $__dispatch_map = [];
	public $__typeref = [];
	public $__namespace = 'Genealogy';
	public $service_version = '1.1';
	public $varNames = [];
	public $logging = false;
	protected $__typedef = [];

	public function GenealogyService()
	{
		/*
		 * SOAP Method declarations
		 * Here is where you declare the methods
		 * and paramaters that are used in the service
		 */

		/**
		* serviceInfo
		*/
		$this->__dispatch_map['serviceInfo'] =
			[
				'in'  => [],//takes no params
				'out' => [
					'result' => "{urn:{$this->__namespace}}serviceInfoResult"
				],
			];

		/**
		* Authenticate
		*/
		$this->__dispatch_map['Authenticate'] =
			[
				'in'  => [
					'username'    => 'string',
					'password'    => 'string',
					'gedcom'      => 'string',
					'compression' => 'string', //not implemented
					'data_type'   => 'string',
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}authResult"//declared below
				],
			];

		/**
		* Authenticate
		*/
		$this->__dispatch_map['changeGedcom'] =
			[
				'in'  => [
					'gedcom' => 'string',
				],
				'out' => [
					'result' => 'string',
				],
			];

		/**
		* Gets requested variable's value
		*/
		$this->__dispatch_map['getVar'] =
			[
				'in'  => [
					'SID' => 'string', //session
					'var' => 'string', //variable name
				],
				'out' => [
					'value' => 'string',
				],
			];

		/**
		* Appends a record
		*/
		$this->__dispatch_map['appendRecord'] =
			[
				'in'  => [
					'SID'    => 'string', //session
					'gedrec' => 'string' //record to append
				],
				'out' => [
					'message' => 'string',
				],
			];

		/**
		* Deletes a record
		*/
		$this->__dispatch_map['deleteRecord'] =
			[
				'in'  => [
					'SID' => 'string', //session
					'RID' => 'string', //record id of record to delete
				],
				'out' => [
					'message' => 'string',
				],
			];

		/**
		* Updates a record
		*/
		$this->__dispatch_map['updateRecord'] =
			[
				'in'  => [
					'SID'    => 'string', //session
					'RID'    => 'string', //record id
					'gedcom' => 'string' //return gedcom (bool)
				],
				'out' => [
					'message' => 'string',
				],
			];

		/**
 		 * Check updates
 		 */
		$this->__dispatch_map['checkUpdates'] =
			[
				'in'  => [
					'SID'        => 'string',//session id
					'lastUpdate' => 'string' //last update date
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}ArrayOfIds"
				],
			];
		/**
		* check updates by id
		*/
		$this->__dispatch_map['checkUpdatesByID'] =
			[
				'in'  => [
					'SID'        => 'string',//session id
					'RID'        => 'string', //record ID
					'lastUpdate' => 'string'//last update date
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}Person",
				],
			];

		/**
		 * get known servers
		*/
		$this->__dispatch_map['getKnownServers'] =
			[
				'in'  => [
					'SID'   => 'string',//session id
					'limit' => 'int' //limit results 0 = all
				],
				'out' => [
					'servers' => "{urn:{$this->__namespace}}ArrayOfServer"
				],
			];

		/**
		* doSearch
		*/
		$this->__dispatch_map['search'] =
			[
				'in'  => [
					'SID'        => 'string', //session ID
					'query'      => 'string', //query string
					'start'      => 'int', //index to start at
					'maxResults' => 'int' //max results to return
				],
				'out' => [
					'Results' => "{urn:{$this->__namespace}}SearchResult"
				],
			];
		/**
		* getpersonbyid
		*/
		$this->__dispatch_map['getPersonByID'] =
			[
				'in'  => [
					'SID' => 'string', //Session ID
					'PID' => 'string', //person ID
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}Person"
				],
			];
		/**
		* getfamilybyid
		*/
		$this->__dispatch_map['getFamilyByID'] =
			[
				'in'  => [
					'SID' => 'string', //Session ID
					'FID' => 'string', //Family ID
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}Family"
				],
			];
		/**
		 * getsourcebyid
		 */
		 $this->__dispatch_map['getSourceByID'] =
			[
				'in'  => [
					'SID'  => 'string', //Session ID
					'SCID' => 'string', //Source ID
				],
				'out' => [
					'result' => "{urn:{$this->__namespace}}Source"
				],
			];

		/*
		* getgedcomrecord
		*/
		$this->__dispatch_map['getGedcomRecord'] =
			[
				'in'  => [
					'SID' => 'string', //Session ID
					'PID' => 'string', //person ID
				],
				'out' => [
					'result' => 'string',
				],
			];
		/*
		* getAncestry
		*/
		$this->__dispatch_map['getAncestry'] =
			[
				'in'  => [
					'SID'          => 'string', //session ID
					'rootID'       => 'string', //id to start at
					'generations'  => 'int', //# of gens. to go
					'returnGedcom' => 'boolean'//return gedcom with result
				],
				'out' => [
					'results' => "{urn:{$this->__namespace}}ArrayOfPerson"
				],
			];

		/*
		* getDescendants
		*/
		$this->__dispatch_map['getDescendants'] =
			[
				'in'  => [
					'SID'          => 'string', //session ID
					'rootID'       => 'string', //id to start at
					'generations'  => 'int', //# of gens. to go
					'returnGedcom' => 'boolean' //return gedcom with result
				],
				'out' => [
					'results' => "{urn:{$this->__namespace}}ArrayOfPerson"
				],
			];

		/*
		* getXref
		*/
		$this->__dispatch_map['getXref'] =
			[
				'in'  => [
					'SID'      => 'string', //session ID
					'position' => 'string', // first, last, next, prev, new
					'type'     => 'string' // type of record
				],
				'out' => [
					'results' => "{urn:{$this->__namespace}}ArrayOfIds"
				],
			];

		/*
		 * Type declarations (Complex types)
		 */

		$this->__typedef['updateResult'] =
			[
				'gedcom' => 'string',
			];

		$this->__typedef['authResult'] =
			[
				'SID'               => 'string',
				'message'           => 'string',
				'gedcom_id'         => 'string',
				'compressionMethod' => 'string',
				'data_type'         => 'string',
			];

		$this->__typedef['serviceInfoResult'] =
			[
				'compression' => 'string', //none, zlib, etc
				'apiVersion'  => 'string',
				'server'      => 'string',
				'gedcoms'     => "{urn:{$this->__namespace}}ArrayOfGedcomList"
			];

		$this->__typedef['GedcomInfo'] =
			[
				'title' => 'string',
				'ID'    => 'string',
			];

		$this->__typedef['ArrayOfGedcomList'] =
			[
				[
					'item' => "{urn:{$this->__namespace}}GedcomInfo"
				],
			];

		// Person complex type
		$this->__typedef['Person'] =
			[
				'PID'            => 'string',
				'gedcomName'     => 'string',
				'birthDate'      => 'string',
				'birthPlace'     => 'string',
				'deathPlace'     => 'string',
				'deathDate'      => 'string',
				'gender'         => 'string',
				'gedcom'         => 'string',
				'spouseFamilies' => "{urn:{$this->__namespace}}ArrayOfIds",
				'childFamilies'  => "{urn:{$this->__namespace}}ArrayOfIds"
			];

		//Source complex type
		$this->__typedef['Source'] =
			[
				'SCID'      => 'string',
				'title'     => 'string',
				'published' => 'string',
				'author'    => 'string',
				'gedcom'    => 'string',

			];

		// Family complex type
		$this->__typedef['Family'] =
			[
				'FID'      => 'string',
				'HUSBID'   => 'string',
				'WIFEID'   => 'string',
				'CHILDREN' => "{urn:{$this->__namespace}}ArrayOfIds",
				'gedcom'   => 'string',
			];

		$this->__typedef['SearchResult'] =
			[
				'totalResults' => 'int',
				'persons'      => "{urn:{$this->__namespace}}ArrayOfPerson"
			];

		$this->__typedef['Server'] =
			[
				'name'    => 'string',
				'address' => 'string' //address to server URL/IP
			];

		$this->__typedef['{urn:' . $this->__namespace . '}ArrayOfServer'] =
			[
				[
					'server' => "{urn:{$this->__namespace}}Server"
				],
			];
		//Creates the Person array type
		$this->__typedef['{urn:' . $this->__namespace . '}ArrayOfPerson'] =
			[
				[
					'item' => "{urn:{$this->__namespace}}Person"
				],
			];
		//Creates the Family array type
		$this->__typedef['{urn:' . $this->__namespace . '}ArrayOfFamily'] =
			[
				[
					'item' => "{urn:{$this->__namespace}}Family"
				],
			];
		//Creates the array of strings
		$this->__typedef['{urn:' . $this->__namespace . '}ArrayOfIds'] =
			[
				[
					'id' => 'string',
				],
			];
	}

	// Required function by SOAP_Server
	public function __dispatch($methodname)
	{
		if (isset($this->__dispatch_map[$methodname]))
			return $this->__dispatch_map[$methodname];
		return NULL;
	}

	//@todo comment and organize :-)
	//@todo Create a function to cast variables
	//@todo naming conventions

	//webservice methods
	/***
	* Returns information about the service
	*/
	public function serviceInfo()
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") ServiceInfo");
		$result = $this->postServiceInfo();

		if($result !== false)
		{
			return $result;
		}

		return new \SOAP_Fault('Unable to retrieve service info',
							  'Server',
							  '',
							  null);

	}
	/***
	* Method to override
	*/
	public function postServiceInfo()
	{
		return false;
	}

	/**
	* Authenticates a user on the given server
	* @param string username
	* @param string password
	* @param string gedcom id of the gedcom to use
	* @param string compression compression lib to use (not implemented)
	* @param string $type specifies a raw data type with current valid values of GEDCOM, or GRAMPS
	*/
	public function Authenticate($username, $password, $gedcom, $compression, $data_type="GEDCOM")
	{
		if (empty($data_type)) $data_type='GEDCOM';

		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") Authenticate($username, '****', $gedcom, $compression, $data_type)");
		$result = $this->postAuthenticate($username, $password, $gedcom, $compression, $data_type);
		if($result !== false)
		{
			//if everything worked set the session value to true
			if (!\PEAR::isError($result))
				$_SESSION["SOAP_CONNECTED"] = true;
			return $result;
		}

		return new \SOAP_Fault('Unable to login',
							'Server',
							'',
							null);
	}

	/**
	* Method to override
	*/
	public function postAuthenticate($username, $password, $gedcom_id, $compression, $data_type="GEDCOM")
	{
		return false;
	}

	/**
	* Switches GEDCOM
	* @param string gedcom id of the gedcom to use
	* @return string	returns the id of the currently active gedcom
	*/
	public function changeGedcom($gedcom)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") changeGedcom($gedcom)");
		$result = $this->postChangeGedcom($gedcom);
		if($result !== false)
		{
			//if everything worked set the session value to true
			if (!\PEAR::isError($result))
				$_SESSION["SOAP_CONNECTED"] = true;
			return $result;
		}

		return new \SOAP_Fault('Unable to change gedcom',
							'Server',
							'',
							null);
	}

	/**
	* Method to override
	*/
	public function postChangeGedcom($gedcom)
	{
		return false;
	}

	/***
	* Retrieves a person with the given id
	* @param string SID session id
	* @param string PID person id
	*/
	public function getPersonByID($SID, $PID)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getPersonByID($SID, $PID)");
		//check the session
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;
		//session id is valid continue the call
		$result = $this->postGetPersonByID($SID, $PID);
		if($result !== false)
		{
			return $result;
		}
		//method was not overriden
		return new \SOAP_Fault('Unable to get person by id '.$PID,'Server','',null);
	}

	/***
	 * Retrieves a family with the given id
	 * @param string FID family id
	 * @param string SID session id
	 ***/
	public function getFamilyByID($SID,$FID)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getFamilyByID($SID, $FID)");
		//check the session
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;
		//session id is valid continue the call
		$result = $this->postGetFamilyByID($SID,$FID);
		if($result !== false)
		{
			return $result;
		}
		//method was not overriden
		return new \SOAP_Fault('Unable to get family by id '.$FID,'Server','',null);
	}

	/***
	 * Method to be overriden
	 * @param string SID session id
	 * @param string SCID Source id
	 */
	public function getSourceByID($SID,$SCID)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getSourceByID($SID, $SCID)");
		//check the session
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;
		//session id is valid continue the call
		$result = $this->postGetSourceByID($SID,$SCID);
		if($result !== false)
		{
			return $result;
		}
		//method was not overriden
		return new \SOAP_Fault('Unable to get source by id '.$SCID,'Server','',null);
	}

	/***
	* Method to be overriden
	* @param string SID session id
	* @param string PID person id
	***/
	public function postGetPersonByID($SID, $PID)
	{
		return false;
	}

	/***
	* Method to be overriden
	* @param string FID Family id
	* @param string SID session id
	***/
	public function postGetFamilyByID($SID,$FID)
	{
		return false;
	}

	/***
	 * Method to be overriden
	 * @param string SID session id
	 * @param string SCID Source id
	 */
	public function postGetSourceByID($SID, $SCID)
	{
		return false;
	}

	/***
	* Retrieves the gedcom for a person with the given PID
	* @param string $SID session id
	* @param string PID person id
	*/
	public function getGedcomRecord($SID, $PID)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getGedcomRecord($SID, $PID)");
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;

		$result = $this->postGetGedcomRecord($SID, $PID);
		if($result !== false)
		{
			return $result;
		}
		return new \SOAP_Fault('Unable to get gedcom record with id '.$PID,'Server','',null);
	}

	/**
	* Method to override
	**/
	public function postGetGedcomRecord($SID, $PID)
	{
		return false;
	}

	/***
	* Returns the value of the specified variable
	* @param string $SID session id
	* @param string $var variable name
	*/
	public function getVar($SID, $var)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getVar($SID, $var)");
		//check the session
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;
		//session id is valid continue the call
		$result = $this->postGetVar($SID, $var);
		if($result !== false)
		{
			return $result;
		}
		return new \SOAP_Fault('Unable to get variable: '.$var,'Server','',null);
	}
	/**
	* Method to override
	**/
	public function postGetVar($SID, $var)
	{
		return false;
	}

	/***
	* Returns the ancestry of a person with the given PID
	* @param string SID
	* @param string rootID person id to start the ancestry at
	* @param string generations number of generations to traverse
	* @param bool returnGedcom return a gedcom with the results
	*/
	public function getAncestry($SID, $rootID, $generations, $returnGedcom)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getGedcomRecord($SID, $rootID, $generations, $returnGedcom)");
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;
		//if ($returnGedcom=="false") $returnGedcom=false;

		$result = $this->postGetAncestry($SID, $rootID, $generations, $returnGedcom);

		if($result !== false)
			return $result;

		return new \SOAP_Fault('Unable to retrieve ancestry','Server','',null);
	}

	/**
	* Method to override
	*/
	public function postGetAncestry($SID, $rootID, $generations, $returnGedcom)
	{
		return false;
	}

	/***
	* Returns the decendancy of a person
	* @param string SID
	* @param string rootID person id to start with
	* @param string generations number of generations to traverse
	* @param boolean returnGedcom return a with the results
	*/
	public function getDescendants($SID, $rootID, $generations, $returnGedcom)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getDescendants($SID, $rootID, $generations, $returnGedcom)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		//if($returnGedcom == 'false') $returnGedcom = false;

		$result = $this->postGetDescendants($SID, $rootID, $generations, $returnGedcom);

		if($result !== false)
			return $result;

		return new \SOAP_Fault('Unable to retrieve descendants','Server','',null);
	}

	/*
	* method to override
	*/
	public function postGetDescendants($SID, $rootID, $generations, $returnGedcom)
	{
		return false;
	}

	/***
	* Appends the provided record to the gedcom with the provided record id
	*
	* @param string $SID session id of authenticated user
	* @param string $gedrec record to append
	*
	* @return mixed SOAP_Fault or array of result from the postAppendRecord method
	*/
	public function appendRecord($SID, $gedrec)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") appendRecord($SID, $gedrec)");
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;

		$result = $this->postAppendRecord($SID, $gedrec);

		if($result !== false)
		{

			return $result;
		}

		return new \SOAP_Fault('Unable to append record!', 'Server', '', null);
	}
	/**
	* method to override
	*/
	public function postAppendRecord($SID, $gedrec)
	{
		return false;
	}

	/***
	* Deletes the record with the provided record id
	*
	* @param string $SID session id of authenticated user
	* @param string $RID record id of record to delete
	*
	* @return mixed SOAP_Fault or array of result from the postAppendRecord method
	*/
	public function deleteRecord($SID, $RID)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") deleteRecord($SID, $RID)");
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;

		$result = $this->postDeleteRecord($SID, $RID);

		if($result !== false)
		{

			return $result;
		}

		return new \SOAP_Fault('Unable to delete record!', 'Server', '', null);
	}
	/**
	* method to override
	*/
	public function postDeleteRecord($SID, $RID)
	{
		return false;
	}

	/***
	* Updates a record with the provided gedcom record for a record id
	* @param string SID
	* @param string RID record id to update
	* @param string gedcom Updated gedcom to replace result
	*/
	public function updateRecord($SID, $RID, $gedcom)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") updateRecord($SID, $RID, $gedcom)");
		$result = $this->start_session($SID);
		if ($result !== true)
			return $result;

		$result = $this->postUpdateRecord($SID,$RID, $gedcom);

		if($result !== false)
		{

			return $result;
		}

		return new \SOAP_Fault('Unable to update record!',
							'Server',
							'',
							null);
	}
	/**
	* method to override
	*/
	public function postUpdateRecord($SID, $RID, $gedcom)
	{
		return false;
	}

	/**
	* Checks for updates to the record
	* @param string SID
	* @param string RID record id
	* @param string lastUpdate last date since update
	*/
	public function checkUpdatesByID($SID,$RID,$lastUpdate)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") checkUpdatesByID($SID,$RID,$lastUpdate)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		$result = $this->postCheckUpdatesByID($SID,$RID,$lastUpdate);

		if($result !== false)
			return $result;
		//AddToLog('Unable to complete update check');
		return new \SOAP_Fault('Unable to complete update check','Server','',null);
	}
	/**
	* Method to override
	*/
	public function postCheckUpdatesByID($SID,$RID,$lastUpdate)
	{
		return false;
	}

	/**
	* Checks for updates to the record
	* @param string SID
	* @param string lastUpdate last date since update
	*/
	public function checkUpdates($SID,$lastUpdate)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") checkUpdates($SID,$lastUpdate)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		$result = $this->postCheckUpdates($SID,$lastUpdate);

		if($result !== false)
			return $result;
		//AddToLog('Unable to complete update check');
		return new \SOAP_Fault('Unable to complete update check','Server','',null);
	}
	/**
	* Method to override
	*/
	public function postCheckUpdates($SID,$lastUpdate)
	{
		return false;
	}

	/***
	* Returns the list of known servers
	* @param string SID
	* @param int limit limit the number of servers coming back
	*/
	public function getKnownServers($SID,$limit)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getKnownServers($SID,$limit)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		$result = $this->postGetKnownServers($SID,$limit);

		if($result !== false)
			return $result;
		new \SOAP_Fault('Unable to complete get known servers','Server','',null);
	}
	/*
	* method to override
	*/
	public function postGetKnownServers($SID,$limit)
	{
		return false;
	}

	/***
	 * Searches the server
	* @param string SID
	* @param string query query to use for the search
	* @param string start index to start the search at
	* @param string maxResults maximum results to return
	*/
	public function search($SID, $query, $start, $maxResults)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") search($SID, $query, $start, $maxResults)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		$result = $this->postSearch($SID, $query, $start, $maxResults);

		if($result !== false)
			return $result;
		return new \SOAP_Fault('Unable to complete search','Server','',null);
	}
	/**
	* Method to override
	*/
	public function postSearch($SID, $query, $start, $maxResults)
	{
		return false;
	}

	/***
	 * Gets an XREF Identifier
	* @param string SID
	* @param string position
	* @param string type
	*/
	public function getXref($SID, $position, $type)
	{
		if ($this->logging) AddToLog(basename(__FILE__)." (".__LINE__.") getXref($SID, $position, $type)");
		$result = $this->start_session($SID);
		if($result !== true)
			return $result;

		$result = $this->postGetXref($SID, $position, $type);

		if($result !== false)
			return $result;
		return new \SOAP_Fault('Unable to get XREF','Server','',null);
	}
	/**
	* Method to override
	*/
	public function postGetXref($SID, $position, $type)
	{
		return false;
	}


	/***
	* Starts the session with the given SID
	*
	* @param $SID php session id
	* @returns SOAP_Fault invalid session id
	***/
	public function start_session($SID)
	{
		if (!isset($_SESSION["SOAP_CONNECTED"]) || $_SESSION["SOAP_CONNECTED"]!==true)
		{
			return new \SOAP_Fault('Invalid session id '.$SID.'. Please authenticate',
								'Client',
								'',
								null);
		}
		return true;
	}
	/**
	* Depricated
	*/
	public function cleanSID($sid)
	{
		$sid = str_replace('PHPSESSID=','',$sid);
		return strip_tags($sid);
	}
	/* Process this file.  Handles soap requests and wsdl requests
	*/
	public function &process() {
		global $HTTP_RAW_POST_DATA;

		// Fire up PEAR::SOAP_Server
		$server = new \SOAP_Server();

		// Add your object to SOAP server (note namespace)
		$server->addObjectMap($this,'urn:' . $this->__namespace);

		// Handle SOAP requests coming is as POST data
		if (isset($_SERVER['REQUEST_METHOD']) &&
			$_SERVER['REQUEST_METHOD']=='POST')
		{

			$server->service($HTTP_RAW_POST_DATA);
			return $server;
		}
		else
		{
			// Deal with WSDL / Disco here
			require_once UTIL_PKG_INCLUDE_PATH.'pear/SOAP/Disco.php';

			// Create the Disco server
			$disco = new \SOAP_DISCO_Server($server,$this->__namespace);

			header("Content-type: text/xml");

			if (isset($_SERVER['QUERY_STRING']) &&
				strcasecmp($_SERVER['QUERY_STRING'],'wsdl')==0)
			{
				echo $disco->getWSDL(); // if we're talking http://www.example.com/index.php?wsdl
			}
			else
			{
				echo $disco->getDISCO();
			}
			exit;
		}
	}
}
?>
