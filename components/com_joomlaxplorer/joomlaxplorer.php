<?php
// ensure this file is being included by a parent file
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );
/**
 * @version $Id: joomlaxplorer.php 99 2008-04-20 15:10:20Z soeren $
 * @package joomlaXplorer
 * @copyright soeren 2007
 * @author The joomlaXplorer project (http://joomlacode.org/gf/project/joomlaxplorer/)
 * @author The  The QuiX project (http://quixplorer.sourceforge.net)
 * @license
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * Alternatively, the contents of this file may be used under the terms
 * of the GNU General Public License Version 2 or later (the "GPL"), in
 * which case the provisions of the GPL are applicable instead of
 * those above. If you wish to allow use of your version of this file only
 * under the terms of the GPL and not to allow others to use
 * your version of this file under the MPL, indicate your decision by
 * deleting  the provisions above and replace  them with the notice and
 * other provisions required by the GPL.  If you do not delete
 * the provisions above, a recipient may use your version of this file
 * under either the MPL or the GPL."
 * 
*/

require( $mosConfig_absolute_path.'/components/com_joomlaxplorer/configuration.jx.php' );

if( !$frontend_enabled || empty( $subdir ) || $subdir == '/' || $subdir == '\\' ) {
	echo _NOT_EXIST;
	return;
}

$GLOBALS["home_dir"] = $mosConfig_absolute_path . $subdir;
// the url corresponding with the home directory: (no trailing '/')
$GLOBALS["home_url"] = $mosConfig_live_site.'/downloads';

require( $mosConfig_absolute_path.'/components/com_joomlaxplorer/joomlaxplorer.init.php');
include( $mosConfig_absolute_path.'/components/com_joomlaxplorer/joomlaxplorer.list.php');

if( !empty($GLOBALS['ERROR']) || defined( 'JXPLORER_NOEXEC')) {
	echo '<h2>'.$GLOBALS['ERROR'].'</h2>';
	return;
}

$database->setQuery( 'SELECT id, name FROM `#__menu` WHERE link LIKE \'%option=com_joomlaxplorer%\' ORDER BY `id` LIMIT 1');
$database->loadObject( $res );
if( is_object( $res )) {
	$name = $res->name;
}
else {
	$name = '';
}

if( $name || $dir ) {
	$mainframe->setPageTitle( $name.' - '.$dir );
}
$action = mosGetParam( $_REQUEST, 'action', 'list');
$item = mosGetParam( $_REQUEST, 'item', '');

// Here we allow *download* and *directory listing*, nothing more, nothing less
switch( $action ) {
	case 'download':
		require _QUIXPLORER_PATH . "/include/fun_down.php";
	  	@ob_end_clean(); // get rid of cached unwanted output
	  	download_item($dir, $item);
	  	ob_start(false); // prevent unwanted output
	  	exit;
	case 'list':
	default:
		list_dir($dir);
		break;
}

// A small nice footer. Remove if you don't want to give credit to the developer.
echo '<br style="clear:both;"/>
	<small>
	<a class="title" href="'.$GLOBALS['jx_home'].'" target="_blank">powered by joomlaXplorer</a>
	</small>
	';
	
?>
