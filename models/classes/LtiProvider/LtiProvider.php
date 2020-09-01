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
 * Copyright (c) 2019 (original work) Open Assessment Technologies SA (under the project TAO-PRODUCT);
 */

namespace oat\taoLti\models\classes\LtiProvider;

use JsonSerializable;

/**
 * LTI provider business object.
 */
class LtiProvider implements JsonSerializable
{
    /** @var string */
    private $id;

    /** @var string */
    private $label;

    /** @var string */
    private $key;

    /** @var string */
    private $secret;

    /** @var string */
    private $callbackUrl;

    /** @var array */
    private $roles;

    /**
     * @param string[] $roles
     */
    public function __construct(
        string $id,
        string $label,
        string $key,
        string $secret,
        string $callbackUrl,
        array $roles = []
    )
    {
        $this->id = $id;
        $this->label = $label;
        $this->key = $key;
        $this->secret = $secret;
        $this->callbackUrl = $callbackUrl;
        $this->roles = $roles;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getSecret(): string
    {
        return $this->secret;
    }

    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    public function getLtiVersion(): string
    {
        return '1.3'; //@TODO Will retrieve this info from DB
    }

    public function getToolClientId(): string
    {
        return 'client_id'; //@TODO Will retrieve this info from DB
    }

    public function getToolDeploymentIds(): array
    {
        return ['42']; //@TODO Will retrieve this info from DB
    }

    public function getToolAudience(): string
    {
        return 'http://localhost:8888/tool'; //@TODO Will retrieve this info from DB
    }

    public function getToolOidcLoginInitiationUrl(): string
    {
        return 'http://localhost:8888/lti1p3/oidc/login-initiation'; //@TODO Will retrieve this info from DB
    }

    public function getToolLaunchUrl(): string
    {
        return 'http://localhost:8888/tool/launch'; //@TODO Will retrieve this info from DB
    }

    public function getToolPublicKey(): string
    {
        $keyFile = ROOT_PATH . 'tool.key';

        return file_exists($keyFile) ? file_get_contents($keyFile) : ''; //@TODO Will retrieve this info from DB
    }

    /**
     * @inheritdoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'uri' => $this->getId(),
            'text' => $this->getLabel(),
            'key' => $this->getKey(),
            'secret' => $this->getSecret(),
            'callback' => $this->getCallbackUrl(),
            'roles' => $this->getRoles(),
        ];
    }

    /**
     * @return string[]
     */
    public function getRoles()
    {
        return $this->roles;
    }
}
