<?php
namespace Mgn\CyberGame\Block\UpdateRomInfo;
use Mgn\CyberGame\Model\RomExtraOptionFactory;
use \Magento\Framework\View\Element\Template;
class UpdateRomInfo extends  Template
{
    protected $rom;
    public function __construct(Template\Context $context,RomExtraOptionFactory $Rom)
    {
        $this->rom=$Rom;
        parent::__construct($context);
    }
    public function romExtraOption()
    {
        $result= $this->rom->create()->getCollection();
        return $result;
    }
}