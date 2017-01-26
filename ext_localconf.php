<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
	'ZerosOnes.' . $_EXTKEY,
	'Poll',
	array(
		'Poll' => 'show,voting',
		
	),
	// non-cacheable actions
	array(
		'Poll' => 'voting',
		'Answers' => '',
		'Voting' => '',
		
	)
);
