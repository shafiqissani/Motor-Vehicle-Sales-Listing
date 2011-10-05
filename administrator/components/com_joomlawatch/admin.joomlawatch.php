<?php


/**
* JoomlaWatch - A real-time ajax joomla monitor and live stats
* @version 1.2.x
* @package JoomlaWatch
* @license http://www.gnu.org/licenses/gpl-3.0.txt 	GNU General Public License v3
* @copyright (C) 2008 by Matej Koval - All rights reserved! 
* @website http://www.codegravity.com
**/

/** ensure this file is being included by a parent file */
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' ); 

error_reporting(E_ALL);

if (!defined('_JEXEC')) define('_JEXEC', 1);
if (!defined('DS')) define('DS', DIRECTORY_SEPARATOR);
$jBasePath = dirname(__FILE__).DS."..".DS."..".DS."..";
if (!defined('JPATH_BASE')) define('JPATH_BASE', $jBasePath);

define('JPATH_BASE2', $jBasePath);
if (!defined('DS'))
	define('DS', DIRECTORY_SEPARATOR);

if (@ file_exists(JPATH_BASE2 . DIRECTORY_SEPARATOR . "globals.php"))
	@ define('JOOMLAWATCH_JOOMLA_15', 0);
else
	@ define('JOOMLAWATCH_JOOMLA_15', 1);

if (JOOMLAWATCH_JOOMLA_15) {
	if (!defined('JPATH_ROOT'))
		require_once (JPATH_BASE2 . DS . 'includes' . DS . 'defines.php');
	if (!defined('JDEBUG'))
		@ require_once (JPATH_BASE2 . DS . 'includes' . DS . 'framework.php');
	$mainframe = & JFactory :: getApplication('site');
	$mainframe->initialise();
} else {
	// defines for Joomla 1.0
}

require_once (JPATH_BASE2 . DS . "components" . DS . "com_joomlawatch" . DS . "config.php");
require_once (JPATH_BASE2 . DS . "components" . DS . "com_joomlawatch" . DS . "class.ip2country.php");
require_once (JPATH_BASE2 . DS . "components" . DS . "com_joomlawatch" . DS . "class.joomlawatch.php");
require_once (JPATH_BASE2 . DS . "components" . DS . "com_joomlawatch" . DS . "class.joomlawatch.html.php");
require_once (JPATH_BASE2 . DS . "components" . DS . "com_joomlawatch" . DS . "admin.joomlawatch.html.php");

$adminJoomlaWatchHTML = new AdminJoomlaWatchHTML("/administrator");
$joomlaWatch = new JoomlaWatch();
$joomlaWatchHTML = new JoomlaWatchHTML("/administrator");

$action = @ $_GET['action'];

switch ($task) {

	case "backup" :
		{
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$joomlaWatch->backupTables();
			$adminJoomlaWatchHTML->renderBody($option);
			break;
		}

	case "licenseAccepted" :
		{
			
			$joomlaWatch->licenseAccepted();
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$adminJoomlaWatchHTML->renderBody($option);
			break;
		}

	case "trends" :
		{
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			echo $joomlaWatchHTML->renderTrends();

			break;
		}

	case "credits" :
		{
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			echo $adminJoomlaWatchHTML->renderCredits();

			break;
		}
	case "goals" :
		{
			if (@ $action == "insert") {
				$adminJoomlaWatchHTML->renderAdminStyles();
				$adminJoomlaWatchHTML->renderHeader();
				echo $adminJoomlaWatchHTML->renderBackToGoals();
				$adminJoomlaWatchHTML->renderGoalsInsert();

			} else
				if (@ $action == "save") {
					$adminJoomlaWatchHTML->renderAdminStyles();
					$adminJoomlaWatchHTML->renderHeader();
					$joomlaWatch->saveGoal($_POST);
					$adminJoomlaWatchHTML->renderGoals(@ $result);

				} else
					if (@ $action == "edit") {
						$adminJoomlaWatchHTML->renderAdminStyles();
						$adminJoomlaWatchHTML->renderHeader();
						echo $adminJoomlaWatchHTML->renderBackToGoals();
						$adminJoomlaWatchHTML->renderGoalEdit(@ $_GET['goalId']);

					} else
						if (@ $action == "delete") {
							$adminJoomlaWatchHTML->renderAdminStyles();
							$adminJoomlaWatchHTML->renderHeader();
							$result = $joomlaWatch->deleteGoal(@ $_GET['goalId']);
							$adminJoomlaWatchHTML->renderGoals(@ $result);
						} else
							if (@ $action == "enable") {
								$adminJoomlaWatchHTML->renderAdminStyles();
								$adminJoomlaWatchHTML->renderHeader();
								$result = $joomlaWatch->enableGoal(@ $_GET['goalId']);
								$adminJoomlaWatchHTML->renderGoals(@ $result);
							} else
								if (@ $action == "disable") {
									$adminJoomlaWatchHTML->renderAdminStyles();
									$adminJoomlaWatchHTML->renderHeader();
									$result = $joomlaWatch->disableGoal(@ $_GET['goalId']);
									$adminJoomlaWatchHTML->renderGoals(@ $result);
								} else {
									$adminJoomlaWatchHTML->renderAdminStyles();
									$adminJoomlaWatchHTML->renderHeader();
									$adminJoomlaWatchHTML->renderGoals(@ $result);
								}

			break;
		}
	case "settings" :
		{
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$adminJoomlaWatchHTML->renderSettings(@ $result);

			break;
		}
	case "settingsSave" :
		{
			$result = $joomlaWatch->saveSettings($_POST);
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$adminJoomlaWatchHTML->renderSettings(@ $result);

			break;
		}
	case "resetData" :
		{
			$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$result = $joomlaWatch->resetData($_POST);
			$adminJoomlaWatchHTML->renderResetData($result);
			break;
		}

	default :
		if ($joomlaWatch->checkLicenseAccepted()) {
		$adminJoomlaWatchHTML->renderAdminStyles();
			$adminJoomlaWatchHTML->renderHeader();
			$adminJoomlaWatchHTML->renderBody($option);
		} else {
			$adminJoomlaWatchHTML->renderAdminStyles();
			echo $adminJoomlaWatchHTML->renderAcceptLicense();
		}
		break;
}
?>
