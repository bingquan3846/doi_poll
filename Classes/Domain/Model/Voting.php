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
 * Voting
 */
class Voting extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{

    /**
     * active
     *
     * @var bool
     */
    protected $active = false;

    /**
     * poll
     *
     * @var \ZerosOnes\DoiPoll\Domain\Model\Poll
     */
    protected $poll;

    /**
     * @var \ZerosOnes\DoiPoll\Domain\Model\Answers
     */
    protected $answer;
    
    /**
     * Returns the active
     *
     * @return bool $active
     */
    public function getActive()
    {
        return $this->active;
    }
    
    /**
     * Sets the active
     *
     * @param bool $active
     * @return void
     */
    public function setActive($active)
    {
        $this->active = $active;
    }
    
    /**
     * Returns the boolean state of active
     *
     * @return bool
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * @return Answers
     */
    public function getAnswer()
    {
        return $this->answer;
    }

    /**
     * @param Answers $answer
     */
    public function setAnswer($answer)
    {
        $this->answer = $answer;
    }


    /**
     * @return Poll
     */
    public function getPoll()
    {
        return $this->poll;
    }

    /**
     * @param Poll $poll
     */
    public function setPoll($poll)
    {
        $this->poll = $poll;
    }





}