## Summary
This module enables any AlibabaCloud OSS bucket to be used as remote storage drive for the Magento media files.

## Configuration
Most of the configuration the module uses will be taken from the main `TijsDriven_AlibabaCloud` module configuration.
Check that module to see how to configure. Once configuration is done successfully, no additional work should be needed
to use the OSS as the media remote storage.
```php 
'remote_storage' => [
    'driver' => 'tijsdriven-alibabacloud-oss',
    'prefix' => '',
    'config' => [
        'region' => 'oss-eu-central-1',
        'bucket' => 'magento-test',
    ]
]
```

## Usage
Magento will use the OSS bucket automatically for the `pub/media` folder. Also, for example the 
`.maintenance.flag` will be stored on the OSS so all Magento instances will be aware the system 
is in maintenance mode. 

## AlibabaCloud Resources
- [Setting up AlibabaCloud RAM user + OSS access](https://www.alibabacloud.com/help/en/oss/developer-reference/authorize-access-2#section-8rj-9sk-q7r) 
