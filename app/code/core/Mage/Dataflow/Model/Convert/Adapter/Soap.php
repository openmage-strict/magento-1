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
 * @package    Mage_Dataflow
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2022-2023 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Convert SOAP adapter
 *
 * @category   Mage
 * @package    Mage_Dataflow
 */
class Mage_Dataflow_Model_Convert_Adapter_Soap extends Mage_Dataflow_Model_Convert_Adapter_Abstract
{
    public function load()
    {
        return $this;
    }

    public function save()
    {
        return $this;
    }
}
