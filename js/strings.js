/**
 * Common strings functions
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
 * @subpackage Display
 * @version $Id$
 */
	function trim(str) {
		return str.replace(/(^\s*)|(\s*$)/g,'');
	}
	function strclean(s) {
		if (s=='') return s;
		// Latin-1 Supplement
		// See http://www.unicode.org/charts/PDF/U0080.pdf
		s=s.replace(/[\u00C0-\u00C5]/g,'A');
		s=s.replace(/[\u00C6]/g,'AE');
		s=s.replace(/[\u00C7]/g,'C');
		s=s.replace(/[\u00C8-\u00CB]/g,'E');
		s=s.replace(/[\u00CC-\u00CF]/g,'I');
		s=s.replace(/[\u00D0\u00DE]/g,'TH');
		s=s.replace(/[\u00D1]/g,'N');
		s=s.replace(/[\u00D2-\u00D6]/g,'O');
		s=s.replace(/[\u00D8]/g,'O');
		s=s.replace(/[\u00D9-\u00DC]/g,'U');
		s=s.replace(/[\u00DD]/g,'Y');
		s=s.replace(/[\u00DF]/g,'ss');
		s=s.replace(/[\u00E0-\u00E5]/g,'a');
		s=s.replace(/[\u00E6-\u00E6]/g,'ae');
		s=s.replace(/[\u00E7]/g,'c');
		s=s.replace(/[\u00E8-\u00EB]/g,'e');
		s=s.replace(/[\u00EC-\u00EF]/g,'i');
		s=s.replace(/[\u00F0\u00FE]/g,'th');
		s=s.replace(/[\u00F1]/g,'n');
		s=s.replace(/[\u00F2-\u00F6]/g,'o');
		s=s.replace(/[\u00F8]/g,'o');
		s=s.replace(/[\u00F9-\u00FC]/g,'u');
		s=s.replace(/[\u00FD\u00FF]/g,'y');
		// Latin Extended-A
		// See http://www.unicode.org/charts/PDF/U0100.pdf
		s=s.replace(/[\u0100\u0102\u0104]/g,'A');
		s=s.replace(/[\u0101\u0103\u0105]/g,'a');
		s=s.replace(/[\u0106\u0108\u010A\u010C]/g,'C');
		s=s.replace(/[\u0107\u0109\u010B\u010D]/g,'c');
		s=s.replace(/[\u010E\u0110]/g,'D');
		s=s.replace(/[\u010F\u0111]/g,'d');
		s=s.replace(/[\u0112\u0114\u0116\u0118\u011A]/g,'E');
		s=s.replace(/[\u0113\u0115\u0117\u0119\u011B]/g,'e');
		s=s.replace(/[\u011C\u011E\u0120\u0122]/g,'G');
		s=s.replace(/[\u011D\u011F\u0121\u0123]/g,'g');
		s=s.replace(/[\u0124\u0126]/g,'H');
		s=s.replace(/[\u0125\u0127]/g,'h');
		s=s.replace(/[\u0128\u012A\u012C\u012E\u0130]/g,'I');
		s=s.replace(/[\u0129\u012B\u012D\u012F\u0131]/g,'i');
		s=s.replace(/[\u0132]/g,'IJ');
		s=s.replace(/[\u0133]/g,'ij');
		s=s.replace(/[\u0134]/g,'J');
		s=s.replace(/[\u0135]/g,'j');
		s=s.replace(/[\u0136]/g,'K');
		s=s.replace(/[\u0137\u0138]/g,'k');
		s=s.replace(/[\u0139\u013B\u013D\u013F\u0141]/g,'L');
		s=s.replace(/[\u013A\u013C\u013E\u0140\u0142]/g,'l');
		s=s.replace(/[\u0143\u0145\u0147\u014A]/g,'N');
		s=s.replace(/[\u0144\u0146\u0148\u0149\u014B]/g,'n');
		s=s.replace(/[\u014C\u014E\u0150]/g,'O');
		s=s.replace(/[\u014D\u014F\u0151]/g,'o');
		s=s.replace(/[\u0152]/g,'OE');
		s=s.replace(/[\u0153]/g,'oe');
		s=s.replace(/[\u0154\u0156\u0158]/g,'R');
		s=s.replace(/[\u0155\u0157\u0159]/g,'r');
		s=s.replace(/[\u015A\u015C\u015E\u0160]/g,'S');
		s=s.replace(/[\u015B\u015D\u015F\u0161]/g,'s');
		s=s.replace(/[\u0162\u0164\u0166]/g,'T');
		s=s.replace(/[\u0163\u0165\u0167]/g,'t');
		s=s.replace(/[\u0168\u016A\u016C\u016E\u0170\u0172]/g,'U');
		s=s.replace(/[\u0169\u016B\u016D\u016F\u0171\u0173]/g,'u');
		s=s.replace(/[\u0174]/g,'W');
		s=s.replace(/[\u0175]/g,'w');
		s=s.replace(/[\u0176\u0178]/g,'Y');
		s=s.replace(/[\u0177]/g,'y');
		s=s.replace(/[\u0179\u017B\u017D]/g,'Z');
		s=s.replace(/[\u017A\u017C\u017E]/g,'z');
		s=s.replace(/[\u017F]/g,'s');
		// Latin Extended-B (Specific to Vietnamese)
		// See http://www.unicode.org/charts/PDF/U0180.pdf
		// See http://vietunicode.sourceforge.net/charset/v3.htm
		s=s.replace(/[\u01A0]/g,'O');
		s=s.replace(/[\u01A1]/g,'o');
		s=s.replace(/[\u01AF]/g,'U');
		s=s.replace(/[\u01B0]/g,'u');
		// Latin Extended Additional (general use extension and Vietnamese)
		// See http://www.unicode.org/charts/PDF/U1E00.pdf
		s=s.replace(/[\u1E00\u1EA0\u1EA2\u1EA4\u1EA6\u1EA8\u1EAA\u1EAC\u1EAE\u1EB0\u1EB2\u1EB4\u1EB6]/g,'A');
		s=s.replace(/[\u1E01\u1E9A\u1EA1\u1EA3\u1EA5\u1EA7\u1EA9\u1EAB\u1EAD\u1EAF\u1EB1\u1EB3\u1EB5\u1EB7]/g,'a');
		s=s.replace(/[\u1E02\u1E04\u1E06]/g,'B');
		s=s.replace(/[\u1E03\u1E05\u1E07]/g,'b');
		s=s.replace(/[\u1E08]/g,'C');
		s=s.replace(/[\u1E09]/g,'c');
		s=s.replace(/[\u1E0A\u1E0C\u1E0E\u1E10\u1E12]/g,'D');
		s=s.replace(/[\u1E0B\u1E0D\u1E0F\u1E11\u1E13]/g,'d');
		s=s.replace(/[\u1E14\u1E16\u1E18\u1E1A\u1E1C\u1EB8\u1EBA\u1EBC\u1EBE\u1EC0\u1EC2\u1EC4\u1EC6]/g,'E');
		s=s.replace(/[\u1E15\u1E17\u1E17\u1E1B\u1E1D\u1EB9\u1EBB\u1EBD\u1EBF\u1EC1\u1EC3\u1EC5\u1EC7]/g,'e');
		s=s.replace(/[\u1E1E]/g,'F');
		s=s.replace(/[\u1E1F]/g,'f');
		s=s.replace(/[\u1E20]/g,'G');
		s=s.replace(/[\u1E21]/g,'g');
		s=s.replace(/[\u1E22\u1E24\u1E26\u1E28\u1E2A]/g,'H');
		s=s.replace(/[\u1E23\u1E25\u1E27\u1E29\u1E2C\u1E96]/g,'h');
		s=s.replace(/[\u1E2C\u1E2E\u1EC8\u1ECA]/g,'I');
		s=s.replace(/[\u1E2D\u1E2F\u1EC9\u1ECB]/g,'i');
		s=s.replace(/[\u1E30\u1E32\u1E34]/g,'K');
		s=s.replace(/[\u1E31\u1E33\u1E35]/g,'k');
		s=s.replace(/[\u1E36\u1E38\u1E3A\u1E3C]/g,'L');
		s=s.replace(/[\u1E37\u1E39\u1E3B\u1E3D\u1E9B]/g,'l');
		s=s.replace(/[\u1E3E\u1E40\u1E42]/g,'M');
		s=s.replace(/[\u1E3F\u1E41\u1E43]/g,'m');
		s=s.replace(/[\u1E44\u1E46\u1E48\u1E4A]/g,'N');
		s=s.replace(/[\u1E45\u1E47\u1E49\u1E4B]/g,'n');
		s=s.replace(/[\u1E4C\u1E4E\u1E50\u1E52\u1ECC\u1ECE\u1ED0\u1ED2\u1ED4\u1ED6\u1ED8\u1EDA\u1EDC\u1EDE\u1EE0\u1EE2]/g,'O');
		s=s.replace(/[\u1E4D\u1E4F\u1E51\u1E53\u1ECD\u1ECF\u1ED1\u1ED3\u1ED5\u1ED7\u1ED9\u1EDB\u1EDD\u1EDF\u1EE1\u1EE3]/g,'o');
		s=s.replace(/[\u1E54\u1E56]/g,'P');
		s=s.replace(/[\u1E55\u1E57]/g,'p');
		s=s.replace(/[\u1E58\u1E5A\u1E5C\u1E5E]/g,'R');
		s=s.replace(/[\u1E59\u1E5B\u1E5D\u1E5F]/g,'r');
		s=s.replace(/[\u1E60\u1E62\u1E64\u1E66\u1E68]/g,'S');
		s=s.replace(/[\u1E61\u1E63\u1E65\u1E67\u1E69]/g,'s');
		s=s.replace(/[\u1E6A\u1E6C\u1E6E\u1E70]/g,'T');
		s=s.replace(/[\u1E6B\u1E6D\u1E6F\u1E71\u1E97]/g,'t');
		s=s.replace(/[\u1E72\u1E74\u1E76\u1E78\u1E7A\u1EE4\u1EE6\u1EE8\u1EEA\u1EEC\u1EEE\u1EF0]/g,'U');
		s=s.replace(/[\u1E73\u1E75\u1E77\u1E79\u1E7B\u1EE5\u1EE7\u1EE9\u1EEB\u1EED\u1EEF\u1EF1]/g,'u');
		s=s.replace(/[\u1E7C\u1E7E]/g,'V');
		s=s.replace(/[\u1E7D\u1E7F]/g,'v');
		s=s.replace(/[\u1E80\u1E82\u1E84\u1E86\u1E88\u1E98]/g,'W');
		s=s.replace(/[\u1E81\u1E83\u1E85\u1E87\u1E89]/g,'w');
		s=s.replace(/[\u1E8A\u1E8C]/g,'X');
		s=s.replace(/[\u1E8B\u1E8D]/g,'x');
		s=s.replace(/[\u1E8E\u1EF2\u1EF4\u1EF6\u1EF8]/g,'Y');
		s=s.replace(/[\u1E8F\u1E99\u1EF3\u1EF5\u1EF7\u1EF9]/g,'y');
		s=s.replace(/[\u1E90\u1E92\u1E94]/g,'Z');
		s=s.replace(/[\u1E91\u1E93\u1E95]/g,'z');
		s=s.replace(/[\s\']/g,'-');
		s=s.replace(/<[^>]+>/g,''); // remove html tags
		return s;
	}
