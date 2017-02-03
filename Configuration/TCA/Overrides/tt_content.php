<?php

defined('TYPO3_MODE') or die();

$temporaryColumns = array (
    'poll' => array(
        'exclude' => 1,
        'label' => 'for Poll',
        'config' => array(
            'type' => 'check',
        ),
    ),
);

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'tt_content',
    $temporaryColumns
);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'tt_content',
    'poll'
);