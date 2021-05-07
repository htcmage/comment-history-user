<?php
declare(strict_types=1);

namespace HTCMage\CommentHistoryUser\Observer;

class SalesCommentSaveBefore implements \Magento\Framework\Event\ObserverInterface
{

    protected $adminAuth;

    public function __construct(
        \Magento\Backend\Helper\Data $adminAuth
    )   {
        $this->adminAuth = $adminAuth;
    }

    /**
     * Execute observer
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(
        \Magento\Framework\Event\Observer $observer
    ) { 
        $adminUserId = $this->adminAuth->getCurrentUserId();
        if (empty($adminUserId)) {
            return;
        }

        $object = $observer->getObject();
        if ($object instanceof \Magento\Sales\Api\Data\OrderStatusHistoryInterface ||
            $object instanceof \Magento\Sales\Api\Data\InvoiceCommentInterface || 
            $object instanceof \Magento\Sales\Api\Data\ShipmentCommentInterface ||
            $object instanceof \Magento\Sales\Api\Data\CreditmemoCommentInterface 
        ) {
            $object->setUserId($adminUserId);
        }
    }
}