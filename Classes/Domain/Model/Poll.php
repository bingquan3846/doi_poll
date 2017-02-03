<?php
namespace ZerosOnes\DoiPoll\Domain\Model;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Bingquan Bao <Bingquan.bao@diva-e.com>, ZerosOnes
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * Poll
 */
class Poll extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * contents
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Contents>
     */
    protected $contents = '';
    
    /**
     * answers
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Answers>
     */
    protected $answers = null;


    /**
     * multiple
     *
     * @var boolean
     */
    protected $multiple = null;
    
    /**
     * voting
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Voting>
     * @cascade remove
     */
    protected $voting = null;
    
    /**
     * __construct
     */
    public function __construct()
    {
        //Do not remove the next line: It would break the functionality
        $this->initStorageObjects();
    }
    
    /**
     * Initializes all ObjectStorage properties
     * Do not modify this method!
     * It will be rewritten on each save in the extension builder
     * You may modify the constructor of this class instead
     *
     * @return void
     */
    protected function initStorageObjects()
    {
        $this->contents = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->answers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
        $this->voting = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
    }
    
    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }
    
    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }
    
    /**
     * Adds a Answers
     *
     * @param \ZerosOnes\DoiPoll\Domain\Model\Answers $answer
     * @return void
     */
    public function addAnswer(\ZerosOnes\DoiPoll\Domain\Model\Answers $answer)
    {
        $this->answers->attach($answer);
    }
    
    /**
     * Removes a Answers
     *
     * @param \ZerosOnes\DoiPoll\Domain\Model\Answers $answerToRemove The Answers to be removed
     * @return void
     */
    public function removeAnswer(\ZerosOnes\DoiPoll\Domain\Model\Answers $answerToRemove)
    {
        $this->answers->detach($answerToRemove);
    }
    
    /**
     * Returns the answers
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Answers> $answers
     */
    public function getAnswers()
    {
        return $this->answers;
    }
    
    /**
     * Sets the answers
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Answers> $answers
     * @return void
     */
    public function setAnswers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $answers)
    {
        $this->answers = $answers;
    }

    /**
     * @return boolean
     */
    public function isMultiple()
    {
        return $this->multiple;
    }

    /**
     * @param boolean $multiple
     */
    public function setMultiple($multiple)
    {
        $this->multiple = $multiple;
    }



    /**
     * @param Contents $content
     */
    public function addContent(\ZerosOnes\DoiPoll\Domain\Model\Contents $content)
    {
        $this->contents->attach($content);
    }

    /**
     * @param Contents $contentToRemove
     */
    public function removeContent(\ZerosOnes\DoiPoll\Domain\Model\Contents $contentToRemove)
    {
        $this->contents->detach($contentToRemove);
    }

    /**
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage
     */
    public function getContents()
    {
        return $this->contents;
    }

    /**
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $contents
     */
    public function setContents(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $contents)
    {
        $this->contents = $contents;
    }
    
    /**
     * Adds a Voting
     *
     * @param \ZerosOnes\DoiPoll\Domain\Model\Voting $voting
     * @return void
     */
    public function addVoting(\ZerosOnes\DoiPoll\Domain\Model\Voting $voting)
    {
        $this->voting->attach($voting);
    }
    
    /**
     * Removes a Voting
     *
     * @param \ZerosOnes\DoiPoll\Domain\Model\Voting $votingToRemove The Voting to be removed
     * @return void
     */
    public function removeVoting(\ZerosOnes\DoiPoll\Domain\Model\Voting $votingToRemove)
    {
        $this->voting->detach($votingToRemove);
    }
    
    /**
     * Returns the voting
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Voting> $voting
     */
    public function getVoting()
    {
        return $this->voting;
    }
    
    /**
     * Sets the voting
     *
     * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\ZerosOnes\DoiPoll\Domain\Model\Voting> $voting
     * @return void
     */
    public function setVoting(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $voting)
    {
        $this->voting = $voting;
    }

}