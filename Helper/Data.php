<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace HTCMage\CommentHistoryUser\Helper;

/**
 * 
 * @author      HTCMage_CommentHistoryUser
 */

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{   
    /**
     * @var \Magento\User\Model\ResourceModel\User\CollectionFactory
     */
    
    protected $userCollectionFactory;

    protected $adminUserData;

    function __construct(
        \Magento\Framework\App\Helper\Context $context,
        \Magento\User\Model\ResourceModel\User\CollectionFactory $userCollectionFactory
    )   {
        $this->userCollectionFactory = $userCollectionFactory;
        parent::__construct(
            $context
        );
    }

    /**
     *  Array Data Admin Id and Name 
     *
     * @return array
     */
    private function getUserCollectionData()
    {
        $users = $this->userCollectionFactory->create();
        $data = [];
        foreach ($users as $user) {
            $data[$user->getId()] = $user->getName();
        }
        return $data;
    }

    /**
     * Return Array Data Admin Id and Name 
     *
     * @return array
     */

    protected function getAdminUserData()
    {
        if (empty($this->adminUserData)) {
            $this->adminUserData = $this->getUserCollectionData();
        }

        return $this->adminUserData;
    }

    /**
     * Return Data Admin Name by Admin Id
     *
     * @return String|false
     */

    public function getAdminUserName($userId) 
    {
        $adminUserData = $this->getAdminUserData();
        if (array_key_exists($userId, $adminUserData)) {
            return $adminUserData[$userId];
        }
        return false;
    }
    
}
