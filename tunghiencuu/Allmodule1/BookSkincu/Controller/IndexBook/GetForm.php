<?php

namespace Convert\BookSkin\Controller\IndexBook;

use Magento\Framework\App\Action\Context;
use Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Psr\Log\LoggerInterface;
use Magento\Framework\View\Result\PageFactory;
//gửi mail vs form bt
class GetForm extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;

	protected $transportBuilder;

	protected $storeManager;

	protected $logger;

	public function __construct(
		Context $context,
		TransportBuilder $transportBuilder,
		StoreManagerInterface $storeManager,
		LoggerInterface $logger,
		PageFactory $pageFactory)
	{
		$this->_pageFactory = $pageFactory;
		$this->transportBuilder = $transportBuilder;
		$this->storeManager = $storeManager;
		$this->logger = $logger;
		return parent::__construct($context);
	}

	public function execute()
	{
		if (isset($_POST)) {
			$receiverInfo = [
				'name' => 'Lê Hùng',
				'email' => 'hung0210pro@gmail.com'
			];
			$store = $this->storeManager->getStore();


			$templateParams = ['name' => $_POST['name'], 'last-name' => $_POST['last-name'], 'email' => $_POST['email'], 'telephone' => $_POST['telephone'], 'skin_concern' => $_POST['skin_concern'], "pigmentation" => $_POST['pigmentation'], 'or_oily' => $_POST['or_oily'], "currently" => $_POST['currently'], 'outcome' => $_POST['outcome'], 'Extra_Comments' => $_POST['Extra_Comments']];


			$transport = $this->transportBuilder->setTemplateIdentifier(
				'bookskin_test_template'
			)->setTemplateOptions(
				['area' => 'frontend', 'store' => $store->getId()]
			)->addTo(
				$receiverInfo['email'], $receiverInfo['name'] // chỗ người gửi
			)->setTemplateVars(
				$templateParams // nội dung gửi
			)->setFrom(
				'general'
			)->getTransport();
			try {

				$transport->sendMessage(); // gửi mail
			} catch (\Exception $e) {
				// Write a log message whenever get errors
				$this->logger->critical($e->getMessage());
			}

			$this->messageManager->addSuccess(__("Thanks for contacting us with your comments and questions. We'll respond to you very soon"));
			return $this->_redirect('book-skin');
		}
	}
}