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

namespace TijsDriven\AlibabaCloudOss\Driver;

use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\ObjectManagerInterface;
use Magento\RemoteStorage\Driver\Adapter\Cache\CacheInterfaceFactory;
use Magento\RemoteStorage\Driver\Adapter\CachedAdapterInterfaceFactory;
use Magento\RemoteStorage\Driver\Adapter\MetadataProviderInterfaceFactory;
use Magento\RemoteStorage\Driver\DriverException;
use Magento\RemoteStorage\Driver\DriverFactoryInterface;
use Magento\RemoteStorage\Driver\RemoteDriverInterface;
use Magento\RemoteStorage\Model\Config;
use OSS\OssClient;
use Psr\Log\LoggerInterface;
use TijsDriven\AlibabaCloud\Api\GetTokenInterface;
use TijsDriven\AlibabaCloud\Model\Config\DeployConfig;
use TijsDriven\AlibabaCloudOss\Model\Config\Source\Endpoint;
use TijsDriven\Flysystem\AlibabaCloudOss\AlibabaCloudOssAdapter;
use function __;
use function md5;
use function rtrim;

class AlibabaCloudOssFactory implements DriverFactoryInterface
{

    public function __construct(
        protected ObjectManagerInterface           $objectManager,
        protected GetTokenInterface                $getToken,
        protected Config                           $config,
        protected MetadataProviderInterfaceFactory $metadataProviderFactory,
        protected CacheInterfaceFactory            $cacheInterfaceFactory,
        protected CachedAdapterInterfaceFactory    $cachedAdapterInterfaceFactory,
        protected DeployConfig                     $alibabaCloudConfig,
        protected Endpoint                         $endpoint,
        protected LoggerInterface                  $logger,
        protected ?string                          $cachePrefix = 'alibabacloud_oss_'
    )
    {
    }

    /**
     * @inheritDoc
     */
    public function create(): RemoteDriverInterface
    {
        try {
            return $this->createConfigured(
                $this->config->getConfig(),
                $this->config->getPrefix()
            );
        } catch (LocalizedException $exception) {
            throw new DriverException(__($exception->getMessage()), $exception);
        }
    }

    /**
     * @inheritDoc
     */
    public function createConfigured(array $config, string $prefix, string $cacheAdapter = '', array $cacheConfig = []): RemoteDriverInterface
    {
        $token = $this->getToken->execute();
        $endpoint = $this->endpoint->get($config['region'], $this->alibabaCloudConfig->getConnectionType());
        $client = new OssClient(
            $token->getAccessKeyId(),
            $token->getAccessKeySecret(),
            $endpoint,
            false,
            $token->getSecurityToken()
        );

        $adapter = new AlibabaCloudOssAdapter($client, $config['bucket']);

        $cache = $this->cacheInterfaceFactory->create(
            $this->cachePrefix ? ['prefix' => $this->cachePrefix] : ['prefix' => md5($config['bucket'] . $prefix)]
        );
        $metadataProvider = $this->metadataProviderFactory->create(
            [
                'adapter' => $adapter,
                'cache' => $cache
            ]
        );

        // @todo: make better/prettier
        $objectUrl = 'https://' . $config['bucket'] . '.' . $endpoint . '/';
        if(!empty($prefix)) {
            $objectUrl .= rtrim($prefix, '/') . '/';
        }

        return $this->objectManager->create(
            AlibabaCloudOss::class,
            [
                'adapter' => $this->cachedAdapterInterfaceFactory->create(
                    [
                        'adapter' => $adapter,
                        'cache' => $cache,
                        'metadataProvider' => $metadataProvider
                    ]
                ),
                'objectUrl' => $objectUrl,
                'metadataProvider' => $metadataProvider,
            ]
        );
    }
}
