<?php
if (!defined('TYPO3_MODE')) {
	die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
	'ZerosOnes.' . $_EXTKEY,
	'Poll',
	'Poll'
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile($_EXTKEY, 'Configuration/TypoScript', 'Double opt in Poll');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_doipoll_domain_model_poll', 'EXT:doi_poll/Resources/Private/Language/locallang_csh_tx_doipoll_domain_model_poll.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_doipoll_domain_model_poll');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_doipoll_domain_model_answers', 'EXT:doi_poll/Resources/Private/Language/locallang_csh_tx_doipoll_domain_model_answers.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_doipoll_domain_model_answers');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr('tx_doipoll_domain_model_voting', 'EXT:doi_poll/Resources/Private/Language/locallang_csh_tx_doipoll_domain_model_voting.xlf');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages('tx_doipoll_domain_model_voting');


$pluginSignature = 'doipoll_poll';
$TCA['tt_content']['types']['list']['subtypes_addlist'][$pluginSignature] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue($pluginSignature, 'FILE:EXT:doi_poll/Configuration/flexform.xml');