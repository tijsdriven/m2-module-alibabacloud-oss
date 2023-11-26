<?php
/*
 * 2022-2023 Tijs Driven Development
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0) that is available
 * through the world-wide-web at this URL: http://www.opensource.org/licenses/OSL-3.0
 * If you are unable to obtain it through the world-wide-web, please send an email
 * to magento@tijsdriven.dev so a copy can be sent immediately.
 *
 * @author Tijs van Raaij
 * @copyright 2022-2023 Tijs Driven Development
 * @license http://www.opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

declare(strict_types=1);

namespace TijsDriven\AlibabaCloudOss\Model\Config;

use Magento\Framework\App\DeploymentConfig;

class DeployConfig
{

    const PATH_REGION = 'remote_storage/region';
    public const PATH_BUCKET = 'remote_storage/bucket';

    public function __construct(
        private DeploymentConfig $config,
        private Source\Endpoint $endpoint
    )
    {
    }

    public function getAccessKey(): string
    {
        return (string)$this->config->get(\TijsDriven\AlibabaCloud\Model\Config\DeployConfig::PATH_ACCESS_KEY);
    }

    public function getSecretKey(): string
    {
        return (string)$this->config->get(\TijsDriven\AlibabaCloud\Model\Config\DeployConfig::PATH_SECRET_KEY);
    }

    public function getRegion(): string
    {
        return (string)$this->config->get(self::PATH_REGION);
    }

    public function getEndpoint(): string
    {
        return $this->endpoint->get(
            $this->getRegion(),
            $this->config->get(\TijsDriven\AlibabaCloud\Model\Config\DeployConfig::PATH_CONNECTION_TYPE)
        );
    }

    public function getBucket(): string
    {
        return (string)$this->config->get(self::PATH_BUCKET);
    }

}
