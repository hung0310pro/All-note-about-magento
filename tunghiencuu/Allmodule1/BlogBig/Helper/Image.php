<?php

namespace AHT\BlogBig\Helper;

use Magento\Framework\App\Filesystem\DirectoryList;

class Image extends \Magento\Framework\App\Helper\AbstractHelper
{
	/**
	 * Media path to extension images
	 *
	 * @var string
	 */
	const MEDIA_PATH = 'image';
	/**
	 * Maximum size for image in bytes
	 * Default value is 1M
	 *
	 * @var int
	 */
	const MAX_FILE_SIZE = 1048576;
	/**
	 * Manimum image height in pixels
	 *
	 * @var int
	 */
	const MIN_HEIGHT = 10;
	/**
	 * Maximum image height in pixels
	 *
	 * @var int
	 */
	const MAX_HEIGHT = 800;
	/**
	 * Manimum image width in pixels
	 *
	 * @var int
	 */
	const MIN_WIDTH = 50;
	/**
	 * Maximum image width in pixels
	 *
	 * @var int
	 */
	const MAX_WIDTH = 1024;
	/**
	 * Array of image size limitation
	 *
	 * @var array
	 */
	protected $_imageSize = array(
		'minheight' => self::MIN_HEIGHT,
		'minwidth' => self::MIN_WIDTH,
		'maxheight' => self::MAX_HEIGHT,
		'maxwidth' => self::MAX_WIDTH,
	);

	/**
	 * @var \Magento\Framework\Filesystem\Directory\WriteInterface
	 */
	protected $mediaDirectory;
	/**
	 * @var \Magento\Framework\Filesystem
	 */
	protected $filesystem;
	/**
	 * @var \Magento\Framework\HTTP\Adapter\FileTransferFactory
	 */
	protected $httpFactory;

	/**
	 * File Uploader factory
	 *
	 * @var \Magento\MediaStorage\Model\File\UploaderFactory
	 */
	protected $_fileUploaderFactory;

	/**
	 * File Uploader factory
	 *
	 * @var \Magento\Framework\Io\File
	 */
	protected $_ioFile;

	/**
	 * Store manager
	 *
	 * @var \Magento\Store\Model\StoreManagerInterface
	 */
	protected $_storeManager;

	/**
	 * @param \Magento\Framework\App\Helper\Context $context
	 */
	public function __construct(
		\Magento\Framework\App\Helper\Context $context,
		\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
		\Magento\Framework\Filesystem $filesystem,
		\Magento\Framework\File\Size $fileSize,
		\Magento\Framework\HTTP\Adapter\FileTransferFactory $httpFactory,
		\Magento\MediaStorage\Model\File\UploaderFactory $fileUploaderFactory,
		\Magento\Framework\Filesystem\Io\File $ioFile,
		\Magento\Store\Model\StoreManagerInterface $storeManager,
		\Magento\Framework\Image\Factory $imageFactory
	)
	{
		$this->_scopeConfig = $scopeConfig;
		$this->filesystem = $filesystem;
		$this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
		$this->httpFactory = $httpFactory;
		$this->_fileUploaderFactory = $fileUploaderFactory;
		$this->_ioFile = $ioFile;
		$this->_storeManager = $storeManager;
		$this->_imageFactory = $imageFactory;
		parent::__construct($context);
	}

	/**
	 * Remove news item image by image filename
	 *
	 * @param string $imageFile
	 * @return bool
	 */
	public function removeImage($imageFile)
	{
		$io = $this->_ioFile;
		$io->open(array('path' => $this->getBaseDir() . '/../'));
		if ($io->fileExists($imageFile)) {
			return $io->rm($imageFile);
		}
		return false;
	}


	/**
	 * Upload image and return uploaded image file name or false
	 *
	 * @throws Mage_Core_Exception
	 * @param string $scope the request key for file
	 * @return bool|string
	 */
	public function uploadImage($scope)
	{
		$adapter = $this->httpFactory->create();
		$adapter->addValidator(new \Zend_Validate_File_ImageSize($this->_imageSize));
		$adapter->addValidator(
			new \Zend_Validate_File_FilesSize(['max' => self::MAX_FILE_SIZE])
		);

		if ($adapter->isUploaded($scope)) {
			// validate image
			if (!$adapter->isValid($scope)) {
				return false;
			}

			$uploader = $this->_fileUploaderFactory->create(['fileId' => $scope]);
			$uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
			$uploader->setAllowRenameFiles(true);
			$uploader->setFilesDispersion(false);
			$uploader->setAllowCreateFolders(true);

			if ($uploader->save($this->getBaseDir())) {
				return $uploader->getUploadedFileName();
			}
		}
		return false;
	}

	/**
	 * Return the base media directory for News Item images
	 *
	 * @return string
	 */
	public function getBaseDir()
	{
		$path = $this->filesystem->getDirectoryRead(
			DirectoryList::MEDIA
		)->getAbsolutePath(self::MEDIA_PATH);
		return $path;
	}

	/**
	 * Return the Base URL for News Item images
	 *
	 * @return string
	 */
	public function getBaseUrl()
	{
		return $this->_storeManager->getStore()->getBaseUrl(
				\Magento\Framework\UrlInterface::URL_TYPE_MEDIA
			) . '/' . self::MEDIA_PATH;
	}
}