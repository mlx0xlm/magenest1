<?php
namespace Mgn\Wedding\Block\Adminhtml\Wedding;
use Magento\Framework\View\Element\UiComponent\Context;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;
/**
 * Class GenericButton
 */
class GenericButton implements ButtonProviderInterface
{
    protected $context;
    protected $_authorization;
    public function __construct(
        Context $context,
        \Magento\Framework\AuthorizationInterface $authorization
    ) {
        $this->context = $context;
        $this->_authorization = $authorization;
    }

    public function getMovieId()
    {
        return (int)$this->context->getRequestParam("id");
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->context->getUrl($route, $params);
    }

    public function getButtonData()
    {
        return [];
    }

    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}