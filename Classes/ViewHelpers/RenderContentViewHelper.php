<?php
namespace ZerosOnes\DoiPoll\ViewHelpers;

class RenderContentViewHelper extends  \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractTagBasedViewHelper
{

    public function initializeArguments()
    {
        parent::initializeArguments();

        $this->registerArgument('contentUid', 'string', 'The uid of content');
    }

    public function render()
    {
        $conf['table'] = 'tt_content';
        $conf['select.']['where'] = 'uid = ' . (int) $this->arguments['contentUid'];
        //$conf['select.']['pidInList'] = $content->getPid();

        $cObject = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\CMS\Frontend\ContentObject\ContentObjectRenderer');

        return $cObject->getContentObject('CONTENT')->render($conf);
    }

}