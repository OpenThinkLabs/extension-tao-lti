<?php

/**
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; under version 2
 * of the License (non-upgradable).
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 *
 * Copyright (c) 2018 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 *
 */

namespace oat\taoLti\test\models\classes\user;

use oat\generis\test\TestCase;
use oat\taoLti\models\classes\LtiLaunchData;
use oat\taoLti\models\classes\user\LtiUserFactoryService;
use oat\taoLti\models\classes\user\LtiUserInterface;

class LtiUserFactoryServiceTest extends TestCase
{
    public function testCreate()
    {
        $ltiUserFactory = new LtiUserFactoryService();
        $ltiUserFactory->setServiceLocator($this->getServiceLocatorMock());
        $launchData = $this->getMockBuilder(LtiLaunchData::class)->disableOriginalConstructor()->getMock();

        $this->assertInstanceOf(LtiUserInterface::class, $ltiUserFactory->create($launchData, '123'));
    }
}
