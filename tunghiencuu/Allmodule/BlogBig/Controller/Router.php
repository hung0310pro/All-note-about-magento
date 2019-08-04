<?php

namespace AHT\BlogBig\Controller;


class Router implements \Magento\Framework\App\RouterInterface
{
	/**
	 * @var \Magento\Framework\App\ActionFactory
	 */
	protected $actionFactory;

	/**
	 * Router constructor.
	 *
	 * @param \Magento\Framework\App\ActionFactory $actionFactory
	 */
	public function __construct(
		\Magento\Framework\App\ActionFactory $actionFactory
	)
	{
		$this->actionFactory = $actionFactory;
	}

	/**
	 *
	 * @param \Magento\Framework\App\RequestInterface $request
	 * @return bool
	 */
	public function match(\Magento\Framework\App\RequestInterface $request)
	{
		// xem ở cái Mymenu.php trong Block, và cái detailpf.phtml(trong templates)
		// muốn biết rõ thì pr cái $urlKey ra là biết.
		// Hàm này giúp ta viết lại url cho friend =))
		// phải khai báo di.xml cho nó trong frontend.
		$identifier = trim($request->getPathInfo(), '/');
		$urlKey = explode("-", $identifier);
		$urlKey1 = explode("/", $identifier);
		$origUrlKey = $identifier;



		if ($urlKey[1] == "category" && isset($urlKey[2])) {
			$request->setModuleName('blogbig')
				->setControllerName('indexcategory')
				->setActionName('categorypf')
				->setParam('id', $urlKey[2]);
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);

		} else if ($urlKey[1] == "detail" && isset($urlKey[2])) {
			$request->setModuleName('blogbig')
				->setControllerName('indexportfolio')
				->setActionName('detailpf')
				->setParam('id', $urlKey[2]);
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		} else if ($urlKey1[2] == "addcmt") {
			$request->setModuleName('blogbig')
				->setControllerName('indexcmt')
				->setActionName('addcmt');
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		} else if ($urlKey1[2] == "updatecmt") {
			$request->setModuleName('blogbig')
				->setControllerName('indexcmt')
				->setActionName('updatecmt');
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		} else if ($urlKey1[2] == "deletecmt") {
			$request->setModuleName('blogbig')
				->setControllerName('indexcmt')
				->setActionName('deletecmt');
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		} else if ($urlKey[2] == "indexcmt") {
			$request->setModuleName('blogbig')
				->setControllerName('indexcmt')
				->setActionName('indexcmt');
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		}/*if ($urlKey1[0] == "bookskin") {
			$request->setModuleName('bookskin')
				->setControllerName('indexbook')
				->setActionName('sendemail');
			$request->setAlias(\Magento\Framework\Url::REWRITE_REQUEST_PATH_ALIAS, $origUrlKey);
			$request->setDispatched(true);
			$this->dispatched = true;
			return $this->actionFactory->create(
				'Magento\Framework\App\Action\Forward',
				['request' => $request]
			);
		}*/
	}

}