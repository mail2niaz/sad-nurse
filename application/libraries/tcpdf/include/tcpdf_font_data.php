<?php
//============================================================+
// File name   : tcpdf_font_data.php
// Version     : 1.0.001
// Begin       : 2008-01-01
// Last Update : 2013-04-01
// Author      : Nicola Asuni - Tecnick.com LTD - www.tecnick.com - info@tecnick.com
// License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
// -------------------------------------------------------------------
// Copyright (C) 2008-2013 Nicola Asuni - Tecnick.com LTD
//
// This file is part of TCPDF software library.
//
// TCPDF is free software: you can redistribute it and/or modify it
// under the terms of the GNU Lesser General Public License as
// published by the Free Software Foundation, either version 3 of the
// License, or (at your option) any later version.
//
// TCPDF is distributed in the hope that it will be useful, but
// WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
// See the GNU Lesser General Public License for more details.
//
// You should have received a copy of the GNU Lesser General Public License
// along with TCPDF.  If not, see <http://www.gnu.org/licenses/>.
//
// See LICENSE.TXT file for more information.
// -------------------------------------------------------------------
//
// Description : Unicode data and encoding maps for TCPDF.
//
//============================================================+

/**
 * @file
 * Unicode data and encoding maps for TCPDF.
 * @author Nicola Asuni
 * @package com.tecnick.tcpdf
 */

/**
 * @class TCPDF_FONT_DATA
 * Unicode data and encoding maps for TCPDF.
 * @package com.tecnick.tcpdf
 * @version 1.0.001
 * @author Nicola Asuni - info@tecnick.com
 */
class TCPDF_FONT_DATA {

/**
 * Unicode code for Left-to-Right Mark.
 * @public
 */
public static $uni_LRM = 8206;

/**
 * Unicode code for Right-to-Left Mark.
 * @public
 */
public static $uni_RLM = 8207;

/**
 * Unicode code for Left-to-Right Embedding.
 * @public
 */
public static $uni_LRE = 8234;

/**
 * Unicode code for Right-to-Left Embedding.
 * @public
 */
public static $uni_RLE = 8235;

/**
 * Unicode code for Pop Directional Format.
 * @public
 */
public static $uni_PDF = 8236;

/**
 * Unicode code for Left-to-Right Override.
 * @public
 */
public static $uni_LRO = 8237;

/**
 * Unicode code for Right-to-Left Override.
 * @public
 */
public static $uni_RLO = 8238;

/**
 * Pattern to test RTL (Righ-To-Left) strings using regular expressions.
 * @public
 */
public static $uni_RE_PATTERN_RTL = "/(
	  \xD6\xBE                                             # R
	| \xD7[\x80\x83\x86\x90-\xAA\xB0-\xB4]                 # R
	| \xDF[\x80-\xAA\xB4\xB5\xBA]                          # R
	| \xE2\x80\x8F                                         # R
	| \xEF\xAC[\x9D\x9F\xA0-\xA8