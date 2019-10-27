<?php

namespace AHT\CreateBlock\Setup;

use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;


class InstallData implements InstallDataInterface
{
    private $blockFactory;

    public function __construct(BlockFactory $blockFactory)
    {
        $this->blockFactory = $blockFactory;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $cmsBlockData =
        	[
            'title' => 'ShamrockTopMessage',
            'identifier' => 'shamrock-top-message',
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

        $this->blockFactory->create()->setData($cmsBlockData)->save();
    }
}