<?php
namespace ZerosOnes\DoiPoll\Domain\Model;

use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;

/**
 * Class Content
 * @package ZerosOnes\DoiPoll\Domain\Model
 */
class Contents extends AbstractEntity{


    /**
     * @var string
     */
    protected $uid = '' ;

    /**
     * @return string
     */
    public function getUid()
    {
        return $this->uid;
    }

    /**
     * @param string $uid
     */
    public function setUid($uid)
    {
        $this->uid = $uid;
    }
}