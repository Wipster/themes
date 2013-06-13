<?php

class Tx_Themes_Hook_ThemesDomainRepositoryThemeRepositoryInitHook {
	protected $ignoredExtensions = array(
		'themes',
		'skinselector_content',
		'skinpreview',
		'templavoila',
		'piwik',
		'piwikintegration',
		'templavoila_framework',
		'be_acl',
		'sitemgr',
		'sitemgr_template',
		'sitemgr_fesettings',
		'sitemgr_fe_notfound',
		'cal',
		'extension_builder',
		'coreupdate',
		'contextswitcher',
		'extdeveval',
		'powermail',
		'kickstarter',
		'tt_news',
		'dyncss',
		'dyncss_less',
		'dyncss_scss',
		'dyncss_turbine',
		'static_info_tables',
		'realurl',
	);

	function init(&$params, $pObj) {
		// exclude extensions, which are not worth to check them
		$extensionsToCheck = array_diff(
			explode(',', t3lib_extMgm::getEnabledExtensionList()),
			explode(',', t3lib_extMgm::getRequiredExtensionList()),
			$this->ignoredExtensions,
			scandir(PATH_typo3 . 'sysext')
		);

		// check extensions, which are worth to check
		foreach($extensionsToCheck as $extensionName) {
			$extPath = t3lib_extMgm::extPath($extensionName);
			if(file_exists($extPath . 'Configuration/Theme') && file_exists($extPath . 'Configuration/Theme/setup.ts')) {
				$pObj->add(new Tx_Themes_Domain_Model_Theme($extensionName));
			}
		}
	}
}