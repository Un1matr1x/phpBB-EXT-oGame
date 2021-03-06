<?php
/**
*
* @package phpBB Extension - oGame
*
* @copyright (c) 2015 un1matr1x
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
* @author Falk Seidel (un1matr1x)
*/

namespace un1matr1x\ogame\tests\acp\main_info;

require_once dirname(__FILE__).'/../../acp/main_info.php';

/**
* @group cr4me_acp
*/
class main_info_test extends \phpbb_test_case
{
	/**
	 * Define the extensions to be tested
	 *
	 * @return string[] vendor/name of extension(s) to test
	 */
	protected static function setup_extensions()
	{
		return array('un1matr1x/ogame');
	}

	/**
	 * test main_info version is the same as the composer annouces
	 *
	 * @return array
	 */
	public function test_version_agains_composer()
	{
		$main_info     = new \un1matr1x\ogame\acp\main_info;
		$output        = $main_info->module();
		$composer_json = json_decode(file_get_contents(dirname(__FILE__).'/../../composer.json'), true);

		$this->assertEquals($composer_json['version'], $output['version']);

		return $output;
	}

	/**
	 * test main_info version is the same as the web-versioncheck annouces
	 *
	 * @return void
	 * @depends test_version_agains_composer
	 */
	public function test_version_agains_versioncheck($output)
	{
		$composer_json = json_decode(file_get_contents(
						'http://un1matr1x.github.io/phpBB-EXT-oGame/versioncheck/un1matr1x_ogame_version.json'), true);

		$this->assertEquals($composer_json['unstable']['0.3']['current'], $output['version']);
	}
}
