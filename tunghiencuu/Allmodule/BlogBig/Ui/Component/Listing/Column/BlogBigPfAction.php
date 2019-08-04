<?php

// xác định id để xóa, sửa cho các danh mục tương ứng.

namespace AHT\BlogBig\Ui\Component\Listing\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

/**
 * Class PageActions
 */
class BlogBigPfAction extends Column
{


	/**
	 * @var \Magento\Framework\UrlInterface
	 */
	protected $urlBuilder;

	/**
	 * @param ContextInterface $context
	 * @param UiComponentFactory $uiComponentFactory
	 * @param UrlInterface $urlBuilder
	 * @param array $components
	 * @param array $data
	 * @param string $editUrl
	 */
	public function __construct(
		ContextInterface $context,
		UiComponentFactory $uiComponentFactory,
		UrlInterface $urlBuilder,
		array $components = [],
		array $data = []
	)
	{
		$this->urlBuilder = $urlBuilder;
		parent::__construct($context, $uiComponentFactory, $components, $data);
	}

	/**
	 * @inheritDoc
	 */
	public function prepareDataSource(array $dataSource)
	{
		if (isset($dataSource['data']['items'])) {
			foreach ($dataSource['data']['items'] as & $item) {
				$name = $this->getData('name');
				if (isset($item['id'])) {
					$item[$name]['edit'] = [
						'href' => $this->urlBuilder->getUrl("blogbig/indexportfolio/showupdatepf", ['id' => $item['id']]),
						'label' => __('Edit')
					];
					$item[$name]['delete'] = [
						'href' => $this->urlBuilder->getUrl("blogbig/indexportfolio/deletepf", ['id' => $item['id']]),
						'label' => __('Delete'),
						'confirm' => [
							'title' => __('Delete ${ $.$data.title }'),
							'message' => __('Bạn có muốn xóa Portfolio này ?')
						]
					];
				}
			}
		}

		return $dataSource;
	}
}
