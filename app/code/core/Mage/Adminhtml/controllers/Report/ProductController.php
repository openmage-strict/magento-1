<?php

declare(strict_types=1);

/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2019-2023 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Product reports admin controller
 *
 * @category   Mage
 * @package    Mage_Adminhtml
 */
class Mage_Adminhtml_Report_ProductController extends Mage_Adminhtml_Controller_Report_Abstract
{
    /**
     * Add report/products breadcrumbs
     *
     * @return $this
     */
    public function _initAction()
    {
        parent::_initAction();
        $this->_addBreadcrumb(Mage::helper('reports')->__('Products'), Mage::helper('reports')->__('Products'));
        return $this;
    }

    /**
     * Bestsellers
     *
     * @deprecated after 1.4.0.1
     */
    public function orderedAction()
    {
        return $this->_forward('bestsellers', 'report_sales');
    }

    /**
     * Export products bestsellers report to CSV format
     *
     * @deprecated after 1.4.0.1
     */
    public function exportOrderedCsvAction()
    {
        return $this->_forward('exportBestsellersCsv', 'report_sales');
    }

    /**
     * Export products bestsellers report to XML format
     *
     * @deprecated after 1.4.0.1
     */
    public function exportOrderedExcelAction()
    {
        return $this->_forward('exportBestsellersExcel', 'report_sales');
    }

    /**
     * Sold Products Report Action
     */
    public function soldAction()
    {
        $this->_title($this->__('Reports'))
             ->_title($this->__('Products'))
             ->_title($this->__('Products Ordered'));

        $this->_initAction()
            ->_setActiveMenu('report/product/sold')
            ->_addBreadcrumb(Mage::helper('reports')->__('Products Ordered'), Mage::helper('reports')->__('Products Ordered'))
            ->_addContent($this->getLayout()->createBlock('adminhtml/report_product_sold'))
            ->renderLayout();
    }

    /**
     * Export Sold Products report to CSV format action
     */
    public function exportSoldCsvAction()
    {
        $fileName   = 'products_ordered.csv';
        $content    = $this->getLayout()
            ->createBlock('adminhtml/report_product_sold_grid')
            ->getCsv();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Export Sold Products report to XML format action
     */
    public function exportSoldExcelAction()
    {
        $fileName   = 'products_ordered.xml';
        $content    = $this->getLayout()
            ->createBlock('adminhtml/report_product_sold_grid')
            ->getExcel($fileName);

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Most viewed products
     */
    public function viewedAction()
    {
        $this->_title($this->__('Reports'))->_title($this->__('Products'))->_title($this->__('Most Viewed'));

        $this->_showLastExecutionTime(Mage_Reports_Model_Flag::REPORT_PRODUCT_VIEWED_FLAG_CODE, 'viewed');

        $this->_initAction()
            ->_setActiveMenu('report/products/viewed')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Products Most Viewed Report'), Mage::helper('adminhtml')->__('Products Most Viewed Report'));

        $gridBlock = $this->getLayout()->getBlock('report_product_viewed.grid');
        $filterFormBlock = $this->getLayout()->getBlock('grid.filter.form');

        $this->_initReportAction([
            $gridBlock,
            $filterFormBlock
        ]);

        $this->renderLayout();
    }

    /**
     * Export products most viewed report to CSV format
     */
    public function exportViewedCsvAction()
    {
        $fileName   = 'products_mostviewed.csv';
        $grid       = $this->getLayout()->createBlock('adminhtml/report_product_viewed_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    /**
     * Export products most viewed report to XML format
     */
    public function exportViewedExcelAction()
    {
        $fileName   = 'products_mostviewed.xml';
        $grid       = $this->getLayout()->createBlock('adminhtml/report_product_viewed_grid');
        $this->_initReportAction($grid);
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    /**
     * Low stock action
     */
    public function lowstockAction()
    {
        $this->_title($this->__('Reports'))
             ->_title($this->__('Products'))
             ->_title($this->__('Low Stock'));

        $this->_initAction()
            ->_setActiveMenu('report/product/lowstock')
            ->_addBreadcrumb(Mage::helper('reports')->__('Low Stock'), Mage::helper('reports')->__('Low Stock'))
            ->_addContent($this->getLayout()->createBlock('adminhtml/report_product_lowstock'))
            ->renderLayout();
    }

    /**
     * Export low stock products report to CSV format
     */
    public function exportLowstockCsvAction()
    {
        $fileName   = 'products_lowstock.csv';
        $content    = $this->getLayout()->createBlock('adminhtml/report_product_lowstock_grid')
            ->setSaveParametersInSession(true)
            ->getCsv();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Export low stock products report to XML format
     */
    public function exportLowstockExcelAction()
    {
        $fileName   = 'products_lowstock.xml';
        $content    = $this->getLayout()->createBlock('adminhtml/report_product_lowstock_grid')
            ->setSaveParametersInSession(true)
            ->getExcel($fileName);

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Downloads action
     */
    public function downloadsAction()
    {
        $this->_title($this->__('Reports'))
             ->_title($this->__('Products'))
             ->_title($this->__('Downloads'));

        $this->_initAction()
            ->_setActiveMenu('report/product/downloads')
            ->_addBreadcrumb(Mage::helper('reports')->__('Downloads'), Mage::helper('reports')->__('Downloads'))
            ->_addContent($this->getLayout()->createBlock('adminhtml/report_product_downloads'))
            ->renderLayout();
    }

    /**
     * Export products downloads report to CSV format
     */
    public function exportDownloadsCsvAction()
    {
        $fileName   = 'products_downloads.csv';
        $content    = $this->getLayout()->createBlock('adminhtml/report_product_downloads_grid')
            ->setSaveParametersInSession(true)
            ->getCsv();

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * Export products downloads report to XLS format
     */
    public function exportDownloadsExcelAction()
    {
        $fileName   = 'products_downloads.xml';
        $content    = $this->getLayout()->createBlock('adminhtml/report_product_downloads_grid')
            ->setSaveParametersInSession(true)
            ->getExcel($fileName);

        $this->_prepareDownloadResponse($fileName, $content);
    }

    /**
     * @inheritDoc
     */
    protected function _isAllowed()
    {
        $action = strtolower($this->getRequest()->getActionName());
        switch ($action) {
            case 'viewed':
                return Mage::getSingleton('admin/session')->isAllowed('report/products/viewed');
            case 'sold':
                return Mage::getSingleton('admin/session')->isAllowed('report/products/sold');
            case 'lowstock':
                return Mage::getSingleton('admin/session')->isAllowed('report/products/lowstock');
            default:
                return Mage::getSingleton('admin/session')->isAllowed('report/products');
        }
    }
}
