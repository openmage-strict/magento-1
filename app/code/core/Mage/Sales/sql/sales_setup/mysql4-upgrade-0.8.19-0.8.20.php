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
 * @package    Mage_Sales
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2020-2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/** @var Mage_Sales_Model_Entity_Setup $installer */
$installer = $this;

$installer->getConnection()->addColumn($this->getTable('sales_order'), 'subtotal_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'subtotal_canceled', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'tax_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'tax_canceled', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'shipping_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'shipping_canceled', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_subtotal_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_subtotal_canceled', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_tax_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_tax_canceled', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_shipping_refunded', 'decimal(12,4) NULL');
$installer->getConnection()->addColumn($this->getTable('sales_order'), 'base_shipping_canceled', 'decimal(12,4) NULL');

$installer->addAttribute('order', 'subtotal_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'subtotal_canceled', ['type' => 'static']);
$installer->addAttribute('order', 'tax_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'tax_canceled', ['type' => 'static']);
$installer->addAttribute('order', 'shipping_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'shipping_canceled', ['type' => 'static']);
$installer->addAttribute('order', 'base_subtotal_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'base_subtotal_canceled', ['type' => 'static']);
$installer->addAttribute('order', 'base_tax_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'base_tax_canceled', ['type' => 'static']);
$installer->addAttribute('order', 'base_shipping_refunded', ['type' => 'static']);
$installer->addAttribute('order', 'base_shipping_canceled', ['type' => 'static']);
