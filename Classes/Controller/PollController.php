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

    /**
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
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
        $this->view->assign('voting', $poll->getVoting()->current());
    }

    /**
     * @param Poll $poll
     * @return array
     * @throws \TYPO3\CMS\Extbase\Mvc\Exception\StopActionException
     */
    public function votingAction(Poll $poll)
    {
        $arguments = $this->request->getArguments();

        if(!empty($arguments['answers'])){
            if(!is_array($arguments['answers'])){
                $arguments['answers'] = array($arguments['answers']);
            }

            foreach($arguments['answers'] as $answer){
                $this->submitVoting($answer, $poll);
            }

            $message = 'you have voted sucessfully';
            $this->addFlashMessage($message);
            $this->forward('show');
        }else{
            $message = 'Please select one option';
            $this->addFlashMessage($message);
            $this->forward('show');
        }

    }


    public function submitVoting($answer, $poll)
    {
        $this->answersRepository = $this->objectManager->get('ZerosOnes\\DoiPoll\\Domain\\Repository\\AnswersRepository');
        $voting = new Voting();
        if(!$this->getTsfe()->loginUser){
            $voting->setActive(true);
        }else{
            //send email to front user
            $user = $this->getTsfe()->fe_user->user;
            $voting->setCruserId($user['uid']);
            $email = $user['email'];

        }
        $voting->setPoll($poll);
        $answerObject = $this->answersRepository->findByUid($answer);
        $voting->setAnswer($answerObject);

        $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
        $persistenceManager->add($voting);
        $persistenceManager->persistAll();

        if(!empty($email)){
            $uriBuilder = $this->uriBuilder;
            $uriBuilder->setTargetPageUid($this->getTsfe()->id);

            $activateUrl = $uriBuilder->uriFor('activate', array('voting' => $voting->getUid() ), 'Poll', 'doipoll', 'poll');

            $mail = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Core\\Mail\\MailMessage');
            $mail->setSubject('Activate your voting for ' . $poll->getTitle());
            $mail->setFrom(array($this->settings['send_email'] => $this->settings['send_name']));
            $mail->setTo(array($email));
            $mail->setBody('Please click the link to activate the voting ' . $activateUrl . ' <br/> option: ' .$answerObject->getTitle()  );
            $mail->addPart('<q>Here is the message itself</q>', 'text/html');
            $mail->send();
        }

        return true;
    }

    /**
     *
     */
    public function activateAction(Voting $voting)
    {
        if($this->getTsfe()->loginUser){

            $user = $this->getTsfe()->fe_user->user;
            if($user['uid'] == $voting->getCruserId()){
                $voting->setActive(true);
                $persistenceManager = $this->objectManager->get("TYPO3\\CMS\\Extbase\\Persistence\\Generic\\PersistenceManager");
                $persistenceManager->add($voting);
                $persistenceManager->persistAll();

                $message = 'Your voting is activated';
                $this->addFlashMessage($message);
                $this->redirect('show');
            }else{
                $message = 'You can not activate this voting ';
                $this->addFlashMessage($message);
                $this->redirect('show');
            }

        }else{

            $message = 'Please login to activate the voting ';
            $this->addFlashMessage($message);
            $this->redirect('show');

        }
    }

    /**
     *
     */
    public function showResultAction(Poll $poll)
    {
        $answers = $poll->getAnswers();
        $votings = $poll->getVoting();
        $results = [];

        if(count($answers)){
            foreach($answers as $answer){
                $count = 0;
                if(count($votings)){
                    foreach($votings as $voting){
                        if($voting->getActive() && $voting->getAnswer()->getUid() == $answer->getUid()){
                            $count ++ ;
                        }
                    }
                }
                $results[] = ['answer' => $answer, 'count' => $count];
            }
        }

        $this->view->assign('poll', $poll);
        $this->view->assign('results', $results);

    }



    /**
     * @return mixed
     */
    public function getTsfe(){
        return $GLOBALS['TSFE'];
    }

}