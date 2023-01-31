<?php

namespace Egits\EmployeeForm\Ui\Component\Column;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;

class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    const URL_VIEW_PATH = 'employeeform/index/view';
    const URL_DELETE_PATH = 'employeeform/index/delete';
    const URL_EDIT_PATH = 'employeeform/index/edit';

    public $urlBuilder;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item['employee_id'])) {
                    $viewUrlPath = $this->getData('config/viewUrlPath');
                    $urlEntityParamName = $this->getData('config/urlEntityParamName');
                    $item[$this->getData('name')] = [
                        
                        'delete' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_DELETE_PATH ,
                                [
                                    $urlEntityParamName => $item['employee_id'
                                    ],
                                ]
                            ),
                            'label' => __('Delete'),
                        ],
                        'view' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_VIEW_PATH,
                                [
                                    $urlEntityParamName => $item['employee_id'
                                    ],
                                ]
                            ),
                            'label' => __('View'),
                        ],
                        'edit' => [
                            'href' => $this->urlBuilder->getUrl(
                                static::URL_EDIT_PATH,
                                [
                                    $urlEntityParamName => $item['employee_id'
                                    ],
                                ]
                            ),
                            'label' => __('Edit'),
                        ],
                    ];
                }
            }
        }

        return $dataSource;
    }
}