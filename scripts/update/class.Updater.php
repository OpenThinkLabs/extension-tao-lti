<?php
use oat\tao\scripts\update\OntologyUpdater;
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
 * Copyright (c) 2014 (original work) Open Assessment Technologies SA;
 *
 *
 */

use oat\tao\model\mvc\error\ExceptionInterpreterService;
use oat\taoLti\models\classes\ExceptionInterpreter;
/**
 * 
 * @author Joel Bout <joel@taotesting.com>
 */
class taoLti_scripts_update_Updater extends \common_ext_ExtensionUpdater
{

    /**
     * 
     * @param string $initialVersion
     * @return string $versionUpdatedTo
     */
    public function update($initialVersion)
    {
        $this->skip('0', '1.2');
        
        if ($this->isVersion('1.2')) {
            OntologyUpdater::syncModels();
            $this->setVersion('1.3.0');
        }

        $this->skip('1.3.0', '1.5.2');
        
        // add teacher assistant role
        if ($this->isVersion('1.5.2')) {
            OntologyUpdater::syncModels();
            $this->setVersion('1.6.0');
        }
        $this->skip('1.6.0', '1.11.0');

        if ($this->isVersion('1.11.0')) {
            $service = $this->getServiceManager()->get(ExceptionInterpreterService::SERVICE_ID);
            $interpreters = $service->getOption(ExceptionInterpreterService::OPTION_INTERPRETERS);
            $interpreters[\taoLti_models_classes_LtiException::class] = ExceptionInterpreter::class;
            $service->setOption(ExceptionInterpreterService::OPTION_INTERPRETERS, $interpreters);
            $this->getServiceManager()->register($service);
            $this->setVersion('1.12.0');
        }
    }
}
