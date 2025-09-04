<?php

/**
 * Report Header Parser
 *
 * used by the SAX parser to generate PDF reports from the XML report file.
 *
 * @package PhpGedView
 * @subpackage Reports
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;

define('PGV_REPORTHEADER_PHP', '');

class XMLHandler {

	/**
	 * element handlers array
	 *
	 * An array of element handler functions
	 * @global array $elementHandler
	 */
	public $elementHandler = [];
	public $text = "";
	public $report_array = [];

	public function __construct () {
		$this->elementHandler["PGVReport"]["start"]			= [ $this, "PGVReportSHandler" ];
		$this->elementHandler["PGVRvar"]["start"]			= [ $this, "PGVRvarSHandler" ];
		$this->elementHandler["PGVRTitle"]["start"]			= [ $this, "PGVRTitleSHandler" ];
		$this->elementHandler["PGVRTitle"]["end"]			= [ $this, "PGVRTitleEHandler" ];
		$this->elementHandler["PGVRDescription"]["end"]		= [ $this, "PGVRDescriptionEHandler" ];
		$this->elementHandler["PGVRInput"]["start"]			= [ $this, "PGVRInputSHandler" ];
		$this->elementHandler["PGVRInput"]["end"]			= [ $this, "PGVRInputEHandler" ];
	}

	/**
	 * xml start element handler
	 *
	 * this function is called whenever a starting element is reached
	 * @param resource $parser the resource handler for the xml parser
	 * @param string $name the name of the xml element parsed
	 * @param array $attrs an array of key value pairs for the attributes
	 */
	public function startElement($parser, $name, $attrs) {
		global $processIfs;

		if (($processIfs==0) || ($name=="PGVRif")) {
			if (isset($this->elementHandler[$name]["start"])) {
				call_user_func($this->elementHandler[$name]["start"], $attrs);
			}
		}
	}

	/**
	 * xml end element handler
	 *
	 * this function is called whenever an ending element is reached
	 * @param resource $parser the resource handler for the xml parser
	 * @param string $name the name of the xml element parsed
	 */
	public function endElement($parser, $name) {
		global $processIfs;

		if (($processIfs==0) || ($name=="PGVRif")) {
			if (isset($this->elementHandler[$name]["end"])) {
				call_user_func($this->elementHandler[$name]["end"] );
			}
		}
	}

	/**
	 * xml character data handler
	 *
	 * this function is called whenever raw character data is reached
	 * just print it to the screen
	 * @param resource $parser the resource handler for the xml parser
	 * @param string $data the name of the xml element parsed
	 */
	public function characterData($parser, $data) {
		global $text;

		$text .= $data;
	}

	public function PGVReportSHandler($attrs) {
		global $report_array, $PRIV_PUBLIC, $PRIV_USER, $PRIV_NONE, $PRIV_HIDE;

		$access = $PRIV_PUBLIC;
		if (isset($attrs["access"])) {
			if (isset(${$attrs["access"]})) {
				$access = ${$attrs["access"]};
			}
		}
		$report_array["access"] = $access;

		$report_array["icon"] = $attrs["icon"] ?? "";
	}

	public function PGVRvarSHandler($attrs) {
		global $text, $vars, $pgv_lang, $factarray, $fact, $desc, $type, $generation;

		$var = $attrs["var"];
		if (!empty($var)) {
			$match = [];
			$tfact = $fact;
			if ($fact=="EVEN") {
				$tfact = $type;
			}
			$var = str_replace([ "[", "]", "@fact", "@desc" ], [ "['", "']", $tfact, $desc ], $var);
			eval("if (!empty(\$$var)) \$var = \$$var;");
			if (preg_match("/factarray\['(.*)'\]/", $var, $match)>0) {
				$var = $match[1];
			}
			$text .= $var;
		}
	}

	public function PGVRTitleSHandler() {
		global $text;

		$text = "";
	}

	public function PGVRTitleEHandler() {
		global $report_array, $text;

		$report_array["title"] = $text;
		$text = "";
	}

	public function PGVRDescriptionEHandler() {
		global $report_array, $text;

		$report_array["description"] = $text;
		$text = "";
	}

	public function PGVRInputSHandler($attrs) {
		global $input, $text;

		$text ="";
		$input = [];
		$input["name"] = "";
		$input["type"] = "";
		$input["lookup"] = "";
		$input["default"] = "";
		$input["value"] = "";
		$input["options"] = "";
		if (isset($attrs["name"])) {
			$input["name"] = $attrs["name"];
		}
		if (isset($attrs["type"])) {
			$input["type"] = $attrs["type"];
		}
		if (isset($attrs["lookup"])) {
			$input["lookup"] = $attrs["lookup"];
		}
		if (isset($attrs["default"])) {
			if ($attrs["default"]=="NOW") {
				$input["default"] = date("d M Y");
			} else {
				$match = [];
				if (preg_match("/NOW\s*([+\-])\s*(\d+)/", $attrs['default'], $match)>0) {
					$plus = 1;
					if ($match[1]=="-") {
						$plus = -1;
					}
					$input["default"] = date("d M Y", time()+$plus*60*60*24*$match[2]);
				} else {
					$input["default"] = $attrs["default"];
				}
			}
		}
		if (isset($attrs["options"])) {
			$input["options"] = $attrs["options"];
		}
	}

	public function PGVRInputEHandler() {
		global $report_array, $text, $input;

		$input["value"] = $text;
		if (!isset($report_array["inputs"])) {
			$report_array["inputs"] = [];
		}
		$report_array["inputs"][] = $input;
		$text = "";
	}

}