<?php

namespace Botify\Types\Map;

use Botify\Utils\LazyJsonMapper;

/**
 * WebhookInfo
 *
 * @method string getUrl()
 * @method bool getHasCustomCertificate()
 * @method Int getPendingUpdateCount()
 * @method string getIpAddress()
 * @method Int getLastErrorDate()
 * @method string getLastErrorMessage()
 * @method Int getLastSynchronizationErrorDate()
 * @method Int getMaxConnections()
 * @method string[] getAllowedUpdates()
 *
 * @method bool isUrl()
 * @method bool isHasCustomCertificate()
 * @method bool isPendingUpdateCount()
 * @method bool isIpAddress()
 * @method bool isLastErrorDate()
 * @method bool isLastErrorMessage()
 * @method bool isLastSynchronizationErrorDate()
 * @method bool isMaxConnections()
 * @method bool isAllowedUpdates()
 *
 * @method $this setUrl(string $value)
 * @method $this setHasCustomCertificate(bool $value)
 * @method $this setPendingUpdateCount(int $value)
 * @method $this setIpAddress(string $value)
 * @method $this setLastErrorDate(int $value)
 * @method $this setLastErrorMessage(string $value)
 * @method $this setLastSynchronizationErrorDate(int $value)
 * @method $this setMaxConnections(int $value)
 * @method $this setAllowedUpdates(string[] $value)
 *
 * @method $this unsetUrl()
 * @method $this unsetHasCustomCertificate()
 * @method $this unsetPendingUpdateCount()
 * @method $this unsetIpAddress()
 * @method $this unsetLastErrorDate()
 * @method $this unsetLastErrorMessage()
 * @method $this unsetLastSynchronizationErrorDate()
 * @method $this unsetMaxConnections()
 * @method $this unsetAllowedUpdates()
 *
 * @property string $url
 * @property bool $has_custom_certificate
 * @property Int $pending_update_count
 * @property string $ip_address
 * @property Int $last_error_date
 * @property string $last_error_message
 * @property Int $last_synchronization_error_date
 * @property Int $max_connections
 * @property string[] $allowed_updates
 */
class WebhookInfo extends LazyJsonMapper
{

    const JSON_PROPERTY_MAP = [
        'url' => 'string',
        'has_custom_certificate' => 'bool',
        'pending_update_count' => 'int',
        'ip_address' => 'string',
        'last_error_date' => 'int',
        'last_error_message' => 'string',
        'last_synchronization_error_date' => 'int',
        'max_connections' => 'int',
        'allowed_updates' => 'string[]',
    ];
}