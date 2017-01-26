<?php
namespace ZerosOnes\DoiPoll\Controller;

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
use TYPO3\CMS\Core\Utility\GeneralUtility;
use ZerosOnes\DoiPoll\Domain\Model\Poll;
use ZerosOnes\DoiPoll\Domain\Model\Voting;

/**
 * PollController
 */
class PollController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * pollRepository
     *
     * @var \ZerosOnes\DoiPoll\Domain\Repository\PollRepository
     * @inject
     */
    protected $pollRepository = NULL;

    /**
     * answersRepository
     *
     * @var \ZerosOnes\DoiPoll\Domain\Repository\AnswersRepository
     */
    protected $answersRepository = NULL;


    /**
     * action list
     *
     * @return void
     */
    public function listAction()
    {
        $polls = $this->pollRepository->findAll();
        $this->view->assign('polls', $polls);
    }
    
    public function showAction()
    {
        $settings = $this->settings;
        if( empty($settings['doi_poll']['uid']))
        {
            $message = 'The poll is not selected';
            $this->forward('message', NULL, NULL, array('message' => $message));
        }

        $poll = $this->pollRepository->findByUid($settings['doi_poll']['uid']);
        $this->view->assign('poll', $poll);
    }
    
    public function votingAction(Poll $poll)
    {
        $arguments = $this->request->getArguments();

        if(!empty($arguments['answers'])){
            $this->answersRepository = $this->objectManager->get('ZerosOnes\\DoiPoll\\Domain\\Repository\\AnswersRepository');
            $voting = new Voting();
            $voting->setPoll($poll);
            $voting->setAnswer($this->answersRepository->findByUid($arguments['answers']));

            $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
            $persistenceManager->add($voting);
            $persistenceManager->persistAll();

            $message = 'you have voted sucessfully';
            $this->addFlashMessage($message);
            $this->forward('show');
        }else{
            $message = 'Please select one option';
            $this->addFlashMessage($message);
            $this->forward('show');
        }

        return $arguments;
    }

}