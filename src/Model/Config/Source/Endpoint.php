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

namespace TijsDriven\AlibabaCloudOss\Model\Config\Source;

use Magento\Framework\Exception\RuntimeException;
use function __;
use function var_dump;

class Endpoint
{
    const ENDPOINTS = [
        'oss-cn-hangzhou' => [
            'external' => 'oss-cn-hangzhou.aliyuncs.com',
            'internal' => 'oss-cn-hangzhou-internal.aliyuncs.com'
        ],
        'oss-cn-shanghai' => [
            'external' => 'oss-cn-shanghai.aliyuncs.com',
            'internal' => 'oss-cn-shanghai-internal.aliyuncs.com'
        ],
        'oss-cn-nanjing' => [
            'external' => 'oss-cn-nanjing.aliyuncs.com',
            'internal' => 'oss-cn-nanjing-internal.aliyuncs.com'
        ],
        'oss-cn-qingdao' => [
            'external' => 'oss-cn-qingdao.aliyuncs.com',
            'internal' => 'oss-cn-qingdao-internal.aliyuncs.com'
        ],
        'oss-cn-beijing' => [
            'external' => 'oss-cn-beijing.aliyuncs.com',
            'internal' => 'oss-cn-beijing-internal.aliyuncs.com'
        ],
        'oss-cn-zhangjiakou' => [
            'external' => 'oss-cn-zhangjiakou.aliyuncs.com',
            'internal' => 'oss-cn-zhangjiakou-internal.aliyuncs.com'
        ],
        'oss-cn-huhehaote' => [
            'external' => 'oss-cn-huhehaote.aliyuncs.com',
            'internal' => 'oss-cn-huhehaote-internal.aliyuncs.com'
        ],
        'oss-cn-wulanchabu' => [
            'external' => 'oss-cn-wulanchabu.aliyuncs.com',
            'internal' => 'oss-cn-wulanchabu-internal.aliyuncs.com'
        ],
        'oss-cn-shenzhen' => [
            'external' => 'oss-cn-shenzhen.aliyuncs.com',
            'internal' => 'oss-cn-shenzhen-internal.aliyuncs.com'
        ],
        'oss-cn-heyuan' => [
            'external' => 'oss-cn-heyuan.aliyuncs.com',
            'internal' => 'oss-cn-heyuan-internal.aliyuncs.com'
        ],
        'oss-cn-hangzhou' => [
            'external' => 'oss-cn-hangzhou.aliyuncs.com',
            'internal' => 'oss-cn-hangzhou-internal.aliyuncs.com'
        ],
        'oss-cn-guangzhou' => [
            'external' => 'oss-cn-guangzhou.aliyuncs.com',
            'internal' => 'oss-cn-guangzhou-internal.aliyuncs.com'
        ],
        'oss-cn-chengdu' => [
            'external' => 'oss-cn-chengdu.aliyuncs.com',
            'internal' => 'oss-cn-chengdu-internal.aliyuncs.com'
        ],
        'oss-cn-hongkong' => [
            'external' => 'oss-cn-hongkong.aliyuncs.com',
            'internal' => 'oss-cn-hongkong-internal.aliyuncs.com'
        ],
        'oss-us-west-1' => [
            'external' => 'oss-us-west-1.aliyuncs.com',
            'internal' => 'oss-us-west-1-internal.aliyuncs.com'
        ],
        'oss-us-east-1' => [
            'external' => 'oss-us-east-1.aliyuncs.com',
            'internal' => 'oss-us-east-1-internal.aliyuncs.com'
        ],
        'oss-ap-northeast-1' => [
            'external' => 'oss-ap-northeast-1.aliyuncs.com',
            'internal' => 'oss-ap-northeast-1-internal.aliyuncs.com'
        ],
        'oss-ap-northeast-2' => [
            'external' => 'oss-ap-northeast-2.aliyuncs.com',
            'internal' => 'oss-ap-northeast-2-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-1' => [
            'external' => 'oss-ap-southeast-1.aliyuncs.com',
            'internal' => 'oss-ap-southeast-1-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-2' => [
            'external' => 'oss-ap-southeast-2.aliyuncs.com',
            'internal' => 'oss-ap-southeast-2-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-3' => [
            'external' => 'oss-ap-southeast-3.aliyuncs.com',
            'internal' => 'oss-ap-southeast-3-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-5' => [
            'external' => 'oss-ap-southeast-5.aliyuncs.com',
            'internal' => 'oss-ap-southeast-5-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-6' => [
            'external' => 'oss-ap-southeast-6.aliyuncs.com',
            'internal' => 'oss-ap-southeast-6-internal.aliyuncs.com'
        ],
        'oss-ap-southeast-7' => [
            'external' => 'oss-ap-southeast-7.aliyuncs.com',
            'internal' => 'oss-ap-southeast-7-internal.aliyuncs.com'
        ],
        'oss-ap-south-1' => [
            'external' => 'oss-ap-south-1.aliyuncs.com',
            'internal' => 'oss-ap-south-1-internal.aliyuncs.com'
        ],
        'oss-eu-central-1' => [
            'external' => 'oss-eu-central-1.aliyuncs.com',
            'internal' => 'oss-eu-central-1-internal.aliyuncs.com'
        ],
        'oss-eu-west-1' => [
            'external' => 'oss-eu-west-1.aliyuncs.com',
            'internal' => 'oss-eu-west-1-internal.aliyuncs.com'
        ],
        'oss-me-east-1' => [
            'external' => 'oss-me-east-1.aliyuncs.com',
            'internal' => 'oss-me-east-1-internal.aliyuncs.com'
        ],
    ];

    /**
     * @throws \Magento\Framework\Exception\RuntimeException
     */
    public function get(string $region, string $type): string
    {
        if (!isset(self::ENDPOINTS[$region]) || !isset(self::ENDPOINTS[$region][$type])) {
            throw new RuntimeException(__('Invalid region or connection type configured.'));
        }

        return self::ENDPOINTS[$region][$type];
    }
}
