<?php

declare(strict_types=1);

/**
 * OpenMage
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available at https://opensource.org/license/osl-3-0-php
 *
 * @category   Magento
 * @package    Magento_Profiler
 * @copyright  Copyright (c) 2006-2020 Magento, Inc. (https://www.magento.com)
 * @copyright  Copyright (c) 2022 The OpenMage Contributors (https://www.openmage.org)
 * @license    https://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Class that outputs profiling results to Firebug
 */
class Magento_Profiler_Output_Firebug extends Magento_Profiler_OutputAbstract
{
    /**
     * @var Zend_Controller_Request_Abstract
     */
    private $_request;

    /**
     * @var Zend_Controller_Response_Abstract
     */
    private $_response;

    /**
     * Start output buffering
     *
     * @param string|null $filter Pattern to filter timers by their identifiers (SQL LIKE syntax)
     */
    public function __construct($filter = null)
    {
        parent::__construct($filter);
        ob_start();
    }

    /**
     * Request setter
     *
     * @param Zend_Controller_Request_Abstract $request
     */
    public function setRequest(Zend_Controller_Request_Abstract $request)
    {
        $this->_request = $request;
    }

    /**
     * Response setter
     *
     * @param Zend_Controller_Response_Abstract $response
     */
    public function setResponse(Zend_Controller_Response_Abstract $response)
    {
        $this->_response = $response;
    }

    /**
     * Display profiling results and flush output buffer
     */
    public function display()
    {
        $firebugMessage = new Zend_Wildfire_Plugin_FirePhp_TableMessage($this->_renderCaption());
        $firebugMessage->setHeader(array_keys($this->_getColumns()));

        foreach ($this->_getTimers() as $timerId) {
            $row = [];
            foreach ($this->_getColumns() as $columnId) {
                $row[] = $this->_renderColumnValue($timerId, $columnId);
            }
            $firebugMessage->addRow($row);
        }

        Zend_Wildfire_Plugin_FirePhp::getInstance()->send($firebugMessage);

        // setup the wildfire channel
        $firebugChannel = Zend_Wildfire_Channel_HttpHeaders::getInstance();
        $firebugChannel->setRequest($this->_request ? $this->_request : new Zend_Controller_Request_Http());
        $firebugChannel->setResponse($this->_response ? $this->_response : new Zend_Controller_Response_Http());

        // flush the wildfire headers into the response object
        $firebugChannel->flush();

        // send the response headers
        $firebugChannel->getResponse()->sendHeaders();

        ob_end_flush();
    }

    /**
     * Render timer id column value
     *
     * @param string $timerId
     * @return string
     */
    protected function _renderTimerId($timerId)
    {
        $nestingSep = preg_quote(Magento_Profiler::NESTING_SEPARATOR, '/');
        return preg_replace('/.+?' . $nestingSep . '/', '. ', $timerId);
    }
}
