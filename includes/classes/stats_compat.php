<?php
/**
 * GEDCOM Statistics Compatability Class
 *
 * This class provides backwards compatability for older Advanced HTML block
 * tags.  It should not be used for new projects.
 *
 * phpGedView: Genealogy Viewer
 * Copyright (C) 2002 to 2009  PGV Development Team.  All rights reserved.
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
 * @author Patrick Kellum
 * @package PhpGedView
 * @subpackage Lists
 * @version $Id$
 */

namespace Bitweaver\Phpgedview;

define('PGV_CLASS_STATS_COMPAT_PHP', '');

class stats_compat extends stats
{
///////////////////////////////////////////////////////////////////////////////
// GEDCOM                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function GEDCOM() {return $this->gedcomFilename();}
	public function GEDCOM_ID() {return $this->gedcomID();}
	public function GEDCOM_TITLE() {return $this->gedcomTitle();}
	public function CREATED_SOFTWARE() {return $this->gedcomCreatedSoftware();}
	public function CREATED_VERSION() {return $this->gedcomCreatedVersion();}
	public function CREATED_DATE() {return $this->gedcomDate();}
	public function GEDCOM_UPDATED() {return $this->gedcomUpdated();}
	public function HIGHLIGHT() {return $this->gedcomHighlight();}
	public function HIGHLIGHT_LEFT() {return $this->gedcomHighlightLeft();}
	public function HIGHLIGHT_RIGHT() {return $this->gedcomHighlightRight();}

///////////////////////////////////////////////////////////////////////////////
// Totals                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function TOTAL_INDI() {return $this->totalIndividuals();}
	public function TOTAL_FAM() {return $this->totalFamilies();}
	public function TOTAL_SOUR() {return $this->totalSources();}
	public function TOTAL_OTHER() {return $this->totalOtherRecords();}
	public function TOTAL_SURNAMES() {return $this->totalSurnames();}
	public function TOTAL_EVENTS() {return $this->totalEvents();}
	public function TOTAL_EVENTS_BIRTH() {return $this->totalEventsBirth();}
	public function TOTAL_EVENTS_DEATH() {return $this->totalEventsDeath();}
	public function TOTAL_EVENTS_MARRIAGE() {return $this->totalEventsMarriage();}
	public function TOTAL_EVENTS_OTHER() {return $this->totalEventsOther();}
	public function TOTAL_MALES() {return $this->totalSexMales();}
	public function TOTAL_FEMALES() {return $this->totalSexFemales();}
	public function TOTAL_UNKNOWN_SEX() {return $this->totalSexUnknown();}
	public function TOTAL_USERS() {return $this->totalUsers();}
	public function TOTAL_MEDIA() {return $this->totalMedia();}

///////////////////////////////////////////////////////////////////////////////
// Births                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function FIRST_BIRTH() {return $this->firstBirth();}
	public function FIRST_BIRTH_YEAR() {return $this->firstBirthYear();}
	public function FIRST_BIRTH_NAME() {return $this->firstBirthName();}
	public function FIRST_BIRTH_PLACE() {return $this->firstBirthPlace();}
	public function LAST_BIRTH() {return $this->lastBirth();}
	public function LAST_BIRTH_YEAR() {return $this->lastBirthYear();}
	public function LAST_BIRTH_NAME() {return $this->lastBirthName();}
	public function LAST_BIRTH_PLACE() {return $this->lastBirthPlace();}

///////////////////////////////////////////////////////////////////////////////
// Deaths                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function FIRST_DEATH() {return $this->firstDeath();}
	public function FIRST_DEATH_YEAR() {return $this->firstDeathYear();}
	public function FIRST_DEATH_NAME() {return $this->firstDeathName();}
	public function FIRST_DEATH_PLACE() {return $this->firstDeathPlace();}
	public function LAST_DEATH() {return $this->lastDeath();}
	public function LAST_DEATH_YEAR() {return $this->lastDeathYear();}
	public function LAST_DEATH_NAME() {return $this->lastDeathName();}
	public function LAST_DEATH_PLACE() {return $this->lastDeathPlace();}

///////////////////////////////////////////////////////////////////////////////
// Lifespan                                                                  //
///////////////////////////////////////////////////////////////////////////////

	public function LONG_LIFE() {return $this->longestLife();}
	public function LONG_LIFE_AGE() {return $this->longestLifeAge();}
	public function LONG_LIFE_NAME() {return $this->longestLifeName();}
	public function TOP10_OLDEST() {return $this->topTenOldest();}
	public function TOP10_OLDEST_LIST() {return $this->topTenOldestList();}
	public function AVG_LIFE() {return $this->averageLifespan();}

///////////////////////////////////////////////////////////////////////////////
// Events                                                                    //
///////////////////////////////////////////////////////////////////////////////

	public function FIRST_EVENT() {return $this->firstEvent();}
	public function FIRST_EVENT_YEAR() {return $this->firstEventYear();}
	public function FIRST_EVENT_TYPE() {return $this->firstEventType();}
	public function FIRST_EVENT_NAME() {return $this->firstEventName();}
	public function FIRST_EVENT_PLACE() {return $this->firstEventPlace();}
	public function LAST_EVENT() {return $this->lastEvent();}
	public function LAST_EVENT_YEAR() {return $this->lastEventYear();}
	public function LAST_EVENT_TYPE() {return $this->lastEventType();}
	public function LAST_EVENT_NAME() {return $this->lastEventName();}
	public function LAST_EVENT_PLACE() {return $this->lastEventPlace();}

///////////////////////////////////////////////////////////////////////////////
// Family Size                                                               //
///////////////////////////////////////////////////////////////////////////////

	public function MOST_CHILD() {return $this->largestFamily();}
	public function MOST_CHILD_TOTAL() {return $this->largestFamilySize();}
	public function MOST_CHILD_NAME() {return $this->largestFamilyName();}
	public function TOP10_BIGFAM() {return $this->topTenLargestFamily();}
	public function TOP10_BIGFAM_LIST() {return $this->topTenLargestFamilyList();}
	public function AVG_CHILD() {return $this->averageChildren();}

///////////////////////////////////////////////////////////////////////////////
// Contact                                                                   //
///////////////////////////////////////////////////////////////////////////////

	public function WEBMASTER_CONTACT() {return $this->contactWebmaster();}
	public function GEDCOM_CONTACT() {return $this->contactGedcom();}

///////////////////////////////////////////////////////////////////////////////
// Date & Time                                                               //
///////////////////////////////////////////////////////////////////////////////

	public function SERVER_DATE() {return $this->serverDate();}
	public function SERVER_TIME() {return $this->serverTime();}
	public function SERVER_TIME_24() {return $this->serverTime24();}
	public function SERVER_TIMEZONE() {return $this->serverTimezone();}
	public function LOCAL_DATE() {return $this->browserDate();}
	public function LOCAL_TIME() {return $this->browserTime();}
	public function LOCAL_TIME_24() {return $this->browserTime24();}
	public function LOCAL_TIMEZONE() {return $this->browserTimezone();}

///////////////////////////////////////////////////////////////////////////////
// Misc.                                                                     //
///////////////////////////////////////////////////////////////////////////////

	public function COMMON_SURNAMES() {return $this->commonSurnames();}
}
