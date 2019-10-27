<?php

namespace AHT\CreateBlock\Setup;

use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements \Magento\Framework\Setup\UpgradeDataInterface
{
	const YOUR_STORE_ID = 1;

	/**
	 * @var \Magento\Cms\Model\BlockFactory
	 */
	private $_blockFactory;

	/**
	 * UpgradeData constructor
	 *
	 * @param \Magento\Cms\Model\BlockFactory $blockFactory
	 */
	public function __construct(
		\Magento\Cms\Model\BlockFactory $blockFactory
	)
	{
		$this->_blockFactory = $blockFactory;
	}

	/**
	 * Upgrade data for the module
	 *
	 * @param ModuleDataSetupInterface $setup
	 * @param ModuleContextInterface $context
	 * @return void
	 * @throws \Exception
	 */
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
	{
		$setup->startSetup();

		if (version_compare($context->getVersion(), '1.0.5') < 0) {

			// Shamrockgift

			$cmsBlock = $this->_blockFactory->create()->load('top-message1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'TopMessage1',
					'identifier' => 'top-message1',
					'content' => '
		              <div class="shamtopbar">
		    <div class="container-fluid">
		        <div class="row">
		            <div class="col-sm-2 top-social">
		<p class="topsociallinks"><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-pinterest-p"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-instagram"></i></a></p>
		            </div>
		            <div class="col-md-8 col-sm-10 top-text text-center">
		                <h2 class="toptext">NO HASSLE, NO HIDDEN FEES, WE GUARANTEE 100% FREE US SHIPPING & FAST DELIVERY</h2>
		            
		            </div>
		            <div class="col-sm-2 text-right">
		                <span class="bloglink"><a href="#">View Our Blog</a></span>
		            </div>
		        </div>
		    </div>
		</div>
            ',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('top-message-mobile-1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Top Message Mobile 1',
					'identifier' => 'top-message-mobile-1',
					'content' => '<h2 class="toptextmobile">WE GUARANTEE 100% FREE US SHIPPING &amp; FAST DELIVERY</h2>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('header_contact_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Header Contact 1',
					'identifier' => 'header_contact_1',
					'content' => '<ul>
				<li id="emailheader" style="text-align: left;display:none"><span style="font-size: 16px;"><strong>Email: </strong><a href="#">info@RyCo.com</a></span></li>
				<li id="phoneheader" style="text-align: left;"><span style="font-size: 16px;"><strong>Phone: </strong><a href="tel:8007730942">800-773-0942</a></span></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_newsletter_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Newsletter 1',
					'identifier' => 'footer_newsletter_1',
					'content' => '
            <h3 class="footerh3" style="text-align: center;">Newsletter sign up</h3>
<p>{{block class="Magento\\Newsletter\\Block\\Subscribe" template="Magento_Newsletter::subscribe.phtml"}}</p>
            ',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_social_top_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'footer social top 1',
					'identifier' => 'footer_social_top_1',
					'content' => '<h3 class="footerh3">Follow Us</h3>
<p><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-pinterest-p"></i></a> <a href="#"><i class="fa fa-twitter"></i></a> <a href="#"><i class="fa fa-instagram"></i></a></p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_about_us_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer About Us 1',
					'identifier' => 'footer_about_us_1',
					'content' => '<h3 class="footerh3" style="text-align: left;">Contact Us</h3>
				<ul>
				<li>Address: Shamrock Gift<br /> 55 S Macquesten Pkwy,<br /> Mt Vernon, NY 10550</li>
				</ul>
				<ul>
				<li><span style="text-decoration: underline;"><strong>Notes</strong></span>: <em>Offices not open to the public</em></li>
				<li> </li>
				<li><strong>Email: </strong><a href="#">info@Ryco.com</a></li>
				<li><strong>Phone: </strong><a href="tel:800-773-0942">800-773-0942</a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Links Block 1',
					'identifier' => 'footer_links_block_1',
					'content' => '<h3 class="footerh3" style="text-align: left;">Information</h3>
				<ul class="links" style="text-align: left; font-size: 16px;">
				<li><span style="font-size: 16px;"><a href="#">FAQs</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Contact Us</a></span></li>
				</ul>
				<ul>
				<li><span style="font-size: 16px;"><a href="#">Privacy Policy</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Shipping & Returns</a></span></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block3_1', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Links Block 3 1',
					'identifier' => 'footer_links_block3_1',
					'content' => '<h3 class="footerh3" style="text-align: left;"> </h3>
				<ul class="links" style="font-size: 16px; text-align: left;">
				<li><span style="font-size: 16px;"><a href="#">Guinness Merchandise</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Shamrock Gift Company</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Ireland Gifts</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Irish Home Decore</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">St. Patricks Day</a></span></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			// lazyjuice

			$cmsBlock = $this->_blockFactory->create()->load('top-message-2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Top Message 2',
					'identifier' => 'top-message-2',
					'content' => '<h2 class="toptext">100% FREE SAME DAY DELIVERY - On all deliveries for Gloucester residents placed before 6pm</h2>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('top-message-mobile-2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Top Message Mobile 2',
					'identifier' => 'top-message-mobile-2',
					'content' => '<h2 class="toptextmobile">100% FREE SAME DAY DELIVERY - On all deliveries for Gloucester residents placed before 6pm</h2>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('social_header_2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Social header 2',
					'identifier' => 'social_header_2',
					'content' => '<ul>
				<li id="emailheader" style="text-align: left;"><span style="font-size: 18px;"><strong>Email: </strong><a href="mailto:Ryco@gamil.co.uk">Ryco@gamil.co.uk</a></span></li>
				<li id="phoneheader" style="text-align: left;"><span style="font-size: 18px;"><strong>Phone: </strong><a href="tel:01452 270355">01452 270355</a></span></li>
				<li style="text-align: left;"><a href="#"><em class="fa fa-facebook" style="padding-right: 10px; font-size: 18px !important;"> </em></a> <a href="#"><em class="fa fa-twitter" style="padding-right: 10px; font-size: 18px !important;"> </em></a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_newsletter_2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Newsletter 2',
					'identifier' => 'footer_newsletter_2',
					'content' => '<h3 class="footerh3" style="text-align: center;">Subscribe to get our latest offers</h3>
<p>{{block class="Magento\\Newsletter\\Block\\Subscribe" template="Magento_Newsletter::subscribe.phtml"}}</p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_social_top_2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'footer social top 2',
					'identifier' => 'footer_social_top_2',
					'content' => '<h3 class="footerh3">Follow Us</h3><p><a href="#"><i class="fa fa-facebook"></i></a> <a href="#"><i class="fa fa-pinterest-p"></i></a> <a href="#"><i class="fa fa-twitter"></i></a></p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_about_us_2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer About Us 2',
					'identifier' => 'footer_about_us_2',
					'content' => '<h3 class="footerh3" style="text-align: left;">Contact Us</h3>
				<ul>
				<li>Address: Lazy Juice<br> NO 1 Business Centre,<br>Alvin Street,<br> Gloucester, <br>GL1 3EJ</li>
				</ul>
				<ul>
				<li><span style="text-decoration: underline;"><strong>Notes</strong></span>: <em>Offices not open to the public</em></li>
				<li>&nbsp;</li>
				<li><strong>Email: </strong><a href="#">sales@lazyjuice.co.uk</a></li>
				<li><strong>Phone: </strong><a href="tel:01452270355 ">01452 270355 </a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block_2', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Links Block 2',
					'identifier' => 'footer_links_block_2',
					'content' => '<h3 class="footerh3" style="text-align: left;">Information</h3>
				<ul class="links" style="text-align: left; font-size: 16px;">
				<li><span style="font-size: 16px;"><a href="#">Contact Us</a></span></li>
				</ul>
				<ul>
				<li><span style="font-size: 16px;"><a href="#">Privacy Policy</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Shipping &amp; Returns</a></span></li>
				<li><span style="font-size: 16px;"><a href="#">Terms &amp; Conditions</a></span></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			// basecamp

			$cmsBlock = $this->_blockFactory->create()->load('top-header-menu-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Top Header Menu 3',
					'identifier' => 'top-header-menu-3',
					'content' => '<ul class="menu-top-contact">
				<li><a href="#">My Account</a></li>
				<li><a href="#">My Wishlist</a></li>
				<li><a href="#">Contact</a></li>
				<li><span class="call">Call us: <a href="tel:+35318782711">+3531 878 2711</a></span></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('browse-basecamp-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Browse Basecamp 3',
					'identifier' => 'browse-basecamp-3',
					'content' => '<div class="footer-item">
				<h4>BROWSE BASECAMP</h4>
				<ul>
				<li><a href="#">About Us</a></li>
				<li><a href="#">Basecamp Membership</a></li>
				<li><a href="#">Advanced Search</a></li>
				<li><a href="#">Group Sales &amp; Bulk Orders</a></li>
				<li><a href="#">Jobs- Sitemap</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">Camino Kit List</a></li>
				</ul>
				</div>
				<div class="footer-item">
				<h4>STAY CONNECTED</h4>
				</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('my-account-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'My Account 3',
					'identifier' => 'my-account-3',
					'content' => '<div class="footer-item">
				<h4>MY ACCOUNT</h4>
				<ul>
				<li><a href="#">Sign In</a></li>
				<li><a href="#">Account Settings </a></li>
				<li><a href="#">View Cart </a></li>
				<li><a href="#">My Wishlist</a></li>
				<li><a href="#">My Compared Products</a></li>
				</ul>
				</div>
				<div class="footer-item">
				<h4>WE ACCEPT</h4>
				<img src="{{media url=&quot;payment-icon.png&quot;}}" alt=""></div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('terms-conditions-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Terms Conditions 3',
					'identifier' => 'terms-conditions-3',
					'content' => '<div class="footer-item">
				<h4>TERMS AND CONDITIONS</h4>
				<ul>
				<li><a href="#">Customer Service</a></li>
				<li><a href="#">Shipping Method </a></li>
				<li><a href="#">Delivery </a></li>
				<li><a href="#">Returns Policy </a></li>
				<li><a href="#">Payment Information</a></li>
				<li><a href="#">Enviromental Responsibility</a></li>
				<li><a href="#">Privacy Policy </a></li>
				<li><a href="#">Privacy Statement</a></li>
				</ul>
				</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer-located-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Located 3',
					'identifier' => 'footer-located-3',
					'content' => '<div class="footer-item">
				<h4>WE ARE LOCATED AT:</h4>
				<p>DUBLIN ADDRESS Basecamp Unit 1-4, The Smyths Building, Jervis Street Dublin 1</p>
				<div class="clear">&nbsp;</div>
				<p>Telephone: <a href="tel:+3531443 0800">+353 1 8</a>782711</p>
				<p>Email: <a href="mailto:info@basecamp.ie">info@basecamp.ie</a></p>
				<p>&nbsp;</p>
				</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer-logo-3', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Logo 3',
					'identifier' => 'footer-logo-3',
					'content' => '<p><a class="logo-footer" href="#"><img src="{{media url=&quot;logo-footer.png&quot;}}" alt=""></a></p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}


			//mykindofdress

			$cmsBlock = $this->_blockFactory->create()->load('sub_header_content_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Sub Header Content 4',
					'identifier' => 'sub_header_content_4',
					'content' => '<ul>
				<li><a href="#" target="_self">FREE DELIVERY OVER €50</a></li>
				<!-- <li><a href="#" target="_self">30% OFF IN ALL PRODUCTS</a></li> -->
				<li>
				<ul class="footer-social-links">
				<li><a class="link-1" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a class="link-2" href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li><a class="link-3" href="#" target="_blank"><i class="fa fa-instagram"></i> </a></li>
				</ul>
				</li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('contact-top-4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'contact top 4',
					'identifier' => 'contact-top-4',
					'content' => '<div class="contact-top"><a href="tel:+35314430800"><span class="icon"></span>contact</a></div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}


			$cmsBlock = $this->_blockFactory->create()->load('footer_newsletter_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Newsletter 4',
					'identifier' => 'footer_newsletter_4',
					'content' => '<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
				<ul class="footer-social-links">
				<li><a class="link-1" href="#" target="_blank"><i class="fa fa-facebook"></i></a></li>
				<li><a class="link-2" href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
				<li><a class="link-3" href="#" target="_blank"><i class="fa fa-instagram"></i> </a></li>
				</ul>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">{{block class="Magento\\Newsletter\\Block\\Subscribe" template="Magento_Newsletter::subscribe.phtml"}}</div>
				</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}


			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link My Account 4',
					'identifier' => 'footer_links_block_4',
					'content' => '<h4 class="title">My Account</h4>
				<ul class="links">
				<li><a href="#">Privacy Policy &amp; Terms</a></li>
				<li><a href="#">Returns Policy</a></li>
				<li><a href="#">Cookie Policy</a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block2_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link Information 4',
					'identifier' => 'footer_links_block2_4',
					'content' => '<h4 class="title">Information</h4>
				<ul class="links">
				<li><a href="#">About Us</a></li>
				<li><a href="#">Deliveries</a></li>
				<li><a href="#">Returns</a></li>
				<li><a href="#">Size Guide</a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block3_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link Quick Link 4',
					'identifier' => 'footer_links_block3_4',
					'content' => '<h4 class="title">Quick link</h4>
				<ul class="links">
				<li><a href="#">Blog</a></li>
				<li><a href="#">My Account</a></li>
				<li><a href="#">Order History</a></li>
				<li><a href="#">My Wishlist</a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block4_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link Customer Service 4',
					'identifier' => 'footer_links_block4_4',
					'content' => '<h4 class="title">CUSTOMER SERVICE</h4>
<p><a href="mailto:customerservice@ryco.com">customerservice@Ryco.com</a><br /> Unit 1, Fashion City, Ballymount, D24</p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('coppyright_4', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Footer Coppyright 4 ',
					'identifier' => 'coppyright_4',
					'content' => '<p class="coppyright">Copyright © 2018- 2019 Ryco.</p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}


			// promowear

			$cmsBlock = $this->_blockFactory->create()->load('header_top_call_us_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Header top Call us 5',
					'identifier' => 'header_top_call_us_5',
					'content' => '<p>Call Us : <a href="tel:+35318647350">+353 (0)1 8647333</a></p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('header_top_email_us_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Header top Email us 5',
					'identifier' => 'header_top_email_us_5',
					'content' => '<p>Email : <a href="mailto:sales@ryco.ie">sales@Ryco.ie</a></p>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_newsletter_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Newsletter 5',
					'identifier' => 'footer_newsletter_5',
					'content' => '<h4 class="box-title">Signup for Exclusive Discounts</h4>
<div class="box-content">{{block class="Magento\\Newsletter\\Block\\Subscribe" template="Magento_Newsletter::subscribe.phtml"}}</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_call_us_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Call Us 5',
					'identifier' => 'footer_call_us_5',
					'content' => '<h4 class="call-us"><span class="title">Call Us: </span><a href="tel:+353018647350">+353 (0)1 8647333</a></h4>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link 5',
					'identifier' => 'footer_links_block_5',
					'content' => '<h4 class="title">Promowear</h4>
				<ul class="links">
				<li><a href="#">About us</a></li>
				<li><a href="#" target="_self">Contact details </a></li>
				<li><a href="#">Testimonials</a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block2_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link Services 5',
					'identifier' => 'footer_links_block2_5',
					'content' => '<h4 class="title">Services</h4>
				<ul class="links">
				<li><span class="widget block block-cms-link-inline"> <a title="Services- Print" href="{{store direct_url="services-print-content"}}"> <span>Services- Print</span> </a> </span></li>
				<li><span class="widget block block-cms-link-inline"> <a title="Services- Embroidery" href="{{store direct_url="services-embroidery-content"}}"> <span>Services- Embroidery</span> </a> </span></li>
				<li><span class="widget block block-cms-link-inline"> <a title="Services- Bespoke" href="{{store direct_url="services-bespoke-content"}}"> <span>Services- Bespoke</span> </a> </span></li>
				<li>
				<div class="widget block block-cms-link"><a title="FAQs" href="{{store direct_url="faqs"}}"> <span>FAQs</span> </a></div>
				</li>
				<li>
				<div class="widget block block-cms-link"><a title="Trade Accounts" href="{{store direct_url="trade-accounts"}}"> <span>Trade Accounts</span> </a></div>
				</li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_links_block3_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Link Legal 5',
					'identifier' => 'footer_links_block3_5',
					'content' => '<h4 class="title">Legal</h4>
				<ul class="links">
				<li><span class="widget block block-category-link-inline"> <a href="{{store direct_url="content-pages/terms-conditions"}}"><span>Terms &amp; Conditions</span></a> </span></li>
				<li>
				<div class="widget block block-cms-link"><a title="Privacy and Cookie Policy" href="{{store direct_url="privacy-policy-cookie-restriction-mode"}}"> <span>Privacy and Cookie Policy</span> </a></div>
				</li>
				<li><span class="widget block block-category-link-inline"> <a href="{{store direct_url="content-pages/returns-policy"}}"><span>Returns Policy</span></a> </span></li>
				<li><a title="Cookies Policy" href="{{store direct_url="privacy-policy-cookie-restriction-mode"}}" target="_blank"></a></li>
				</ul>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_address_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Address 5',
					'identifier' => 'footer_address_5',
					'content' => '<h4 class="title">Address</h4>
<div class="address">Ryco Ltd.,<br />7 North Park, North Rd, Kildonan, <br />Dublin, D996 X123 </div>
<div class="address">Dubai.</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

			$cmsBlock = $this->_blockFactory->create()->load('footer_contact_info_5', 'identifier');
			$cmsBlockData =
				[
					'title' => 'Default Footer Contact Info 5',
					'identifier' => 'footer_contact_info_5',
					'content' => '<h4 class="title">Contact Us</h4>
				<div class="content">
				<p class="email">Email: sales@Ryco.com</p>
				<p class="work-hours">9:00 AM - 6:00 PM Monday to Friday<br />By Appointment on Saturday</p>
				<ul class="social-links">
				<li><a href="#"><span class="fa fa-facebook"><span style="display: none;">Facebook</span></span></a></li>
				<li><a href="#"><span class="fa fa-linkedin"><span style="display: none;">Linkedin</span></span></a></li>
				<li><a href="#"><span class="fa fa-instagram"><span style="display: none;">Instagram</span></span></a></li>
				</ul>
				</div>',
					'is_active' => 1,
					'stores' => [0],
					'sort_order' => 0
				];

			if (!$cmsBlock->getId()) {
				$this->_blockFactory->create()->setData($cmsBlockData)->save();
			} else {
				$cmsBlock->setContent($cmsBlockData['content'])->save();
			}

		}

		$setup->endSetup();
	}
}