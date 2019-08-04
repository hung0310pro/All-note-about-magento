<?php

namespace Convert\RouteHome\Plugin;

// cái này mặc định phải có theo pluggin, cả mấy cái biến ở hàm after cx vậy
use Magento\Framework\App\Router\NoRouteHandler as NativeNoRouteHandler; 
// Cái hàm này thì sang file Http.php rồi sang cái tk nó kế thừa là Response.php thì sẽ có 
// cái hàm setRedirect.(hàm này nó như kiểu hàm header cmn luôn muốn biết rõ sang đó xem)
use Magento\Framework\App\Response\Http as responseHttp;
// còn tk này thì phải gọi để lấy link ban đầu.
use Magento\Store\Model\StoreManagerInterface;

class NoRouteHandler
{
	public function __construct(
		responseHttp $response,
		StoreManagerInterface $storeManager
	)
	{
		$this->response = $response;
		$this->storeManager = $storeManager;
	}


    // lấy link ban đầu,rồi truyền vào, rồi chuyển trang thôi.
	public function afterProcess(NativeNoRouteHandler $subject, $result)
	{
		$url = $this->storeManager->getStore()->getBaseUrl();
		$this->response->setRedirect($url);
		return $result;
	}
}



