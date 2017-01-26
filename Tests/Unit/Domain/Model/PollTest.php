<?php

namespace ZerosOnes\DoiPoll\Tests\Unit\Domain\Model;

/***************************************************************
 *  Copyright notice
 *
 *  (c) 2017 Bingquan Bao <Bingquan.bao@diva-e.com>, ZerosOnes
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \ZerosOnes\DoiPoll\Domain\Model\Poll.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Bingquan Bao <Bingquan.bao@diva-e.com>
 */
class PollTest extends \TYPO3\CMS\Core\Tests\UnitTestCase
{
	/**
	 * @var \ZerosOnes\DoiPoll\Domain\Model\Poll
	 */
	protected $subject = NULL;

	public function setUp()
	{
		$this->subject = new \ZerosOnes\DoiPoll\Domain\Model\Poll();
	}

	public function tearDown()
	{
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString()
	{
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle()
	{
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswersReturnsInitialValueForAnswers()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setAnswersForObjectStorageContainingAnswersSetsAnswers()
	{
		$answer = new \ZerosOnes\DoiPoll\Domain\Model\Answers();
		$objectStorageHoldingExactlyOneAnswers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAnswers->attach($answer);
		$this->subject->setAnswers($objectStorageHoldingExactlyOneAnswers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAnswers,
			'answers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAnswerToObjectStorageHoldingAnswers()
	{
		$answer = new \ZerosOnes\DoiPoll\Domain\Model\Answers();
		$answersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$answersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answers', $answersObjectStorageMock);

		$this->subject->addAnswer($answer);
	}

	/**
	 * @test
	 */
	public function removeAnswerFromObjectStorageHoldingAnswers()
	{
		$answer = new \ZerosOnes\DoiPoll\Domain\Model\Answers();
		$answersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$answersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answers', $answersObjectStorageMock);

		$this->subject->removeAnswer($answer);

	}

	/**
	 * @test
	 */
	public function getVotingReturnsInitialValueForVoting()
	{
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getVoting()
		);
	}

	/**
	 * @test
	 */
	public function setVotingForObjectStorageContainingVotingSetsVoting()
	{
		$voting = new \ZerosOnes\DoiPoll\Domain\Model\Voting();
		$objectStorageHoldingExactlyOneVoting = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneVoting->attach($voting);
		$this->subject->setVoting($objectStorageHoldingExactlyOneVoting);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneVoting,
			'voting',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addVotingToObjectStorageHoldingVoting()
	{
		$voting = new \ZerosOnes\DoiPoll\Domain\Model\Voting();
		$votingObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$votingObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($voting));
		$this->inject($this->subject, 'voting', $votingObjectStorageMock);

		$this->subject->addVoting($voting);
	}

	/**
	 * @test
	 */
	public function removeVotingFromObjectStorageHoldingVoting()
	{
		$voting = new \ZerosOnes\DoiPoll\Domain\Model\Voting();
		$votingObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$votingObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($voting));
		$this->inject($this->subject, 'voting', $votingObjectStorageMock);

		$this->subject->removeVoting($voting);

	}
}
