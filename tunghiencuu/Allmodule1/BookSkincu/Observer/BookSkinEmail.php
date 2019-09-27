<?php


namespace Convert\BookSkin\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;

class BookSkinEmail implements ObserverInterface
{
	/**
	 * @var TransportBuilder
	 */
	protected $transportBuilder;
	/**
	 * @var StoreManagerInterface
	 */
	protected $storeManager;
	/**
	 * @var LoggerInterface
	 */
	protected $logger;

	/**
	 * @param TransportBuilder $transportBuilder
	 * @param StoreManagerInterface $storeManager
	 * @param LoggerInterface $logger
	 */
	public function __construct(
		TransportBuilder $transportBuilder,
		StoreManagerInterface $storeManager,
		LoggerInterface $logger
	)
	{
		$this->transportBuilder = $transportBuilder;
		$this->storeManager = $storeManager;
		$this->logger = $logger;
	}

	/**
	 * @param \Magento\Framework\Event\Observer $observer
	 * @return $this
	 */
	public function execute(\Magento\Framework\Event\Observer $observer)
	{
		$customer = $observer->getMyform();

		// If customer data is empty then doesn't need to process
		/* Receiver Detail */
		if (isset($customer)) {
			$receiverInfo = [
				'name' => 'Lê Hùng',
				'email' => 'hung0210pro@gmail.com'
			];
			$store = $this->storeManager->getStore();


			$templateParams = ['store' => "Hùng đẹp trai"];

			$transport = $this->transportBuilder->setTemplateIdentifier(
				'bookskin_test_template'
			)->setTemplateOptions(
				['area' => 'frontend', 'store' => $store->getId()]
			)->addTo(
				$receiverInfo['email'], $receiverInfo['name']
			)->setTemplateVars(
				$templateParams
			)->setFrom(
				'general'
			)->getTransport();
			try {
				// Send an email
				$transport->sendMessage();
			} catch (\Exception $e) {
				// Write a log message whenever get errors
				$this->logger->critical($e->getMessage());
			}
			return $this;
		}
	}
}