<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash string device_model string platform string system_version int api_id string app_name string app_version int date_created int date_active string ip string country string region true current true official_app true password_pending true encrypted_requests_disabled true call_requests_disabled true unconfirmed
 * @return Authorization
 */

final class Authorization extends Instance {
	public function request(int $hash,string $device_model,string $platform,string $system_version,int $api_id,string $app_name,string $app_version,int $date_created,int $date_active,string $ip,string $country,string $region,? true $current = null,? true $official_app = null,? true $password_pending = null,? true $encrypted_requests_disabled = null,? true $call_requests_disabled = null,? true $unconfirmed = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xad01d61d);
		$flags = 0;
		$flags |= is_null($current) ? 0 : (1 << 0);
		$flags |= is_null($official_app) ? 0 : (1 << 1);
		$flags |= is_null($password_pending) ? 0 : (1 << 2);
		$flags |= is_null($encrypted_requests_disabled) ? 0 : (1 << 3);
		$flags |= is_null($call_requests_disabled) ? 0 : (1 << 4);
		$flags |= is_null($unconfirmed) ? 0 : (1 << 5);
		$writer->writeInt($flags);
		$writer->writeLong($hash);
		$writer->tgwriteBytes($device_model);
		$writer->tgwriteBytes($platform);
		$writer->tgwriteBytes($system_version);
		$writer->writeInt($api_id);
		$writer->tgwriteBytes($app_name);
		$writer->tgwriteBytes($app_version);
		$writer->writeInt($date_created);
		$writer->writeInt($date_active);
		$writer->tgwriteBytes($ip);
		$writer->tgwriteBytes($country);
		$writer->tgwriteBytes($region);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['current'] = true;
		else:
			$result['current'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['official_app'] = true;
		else:
			$result['official_app'] = false;
		endif;
		if($flags & (1 << 2)):
			$result['password_pending'] = true;
		else:
			$result['password_pending'] = false;
		endif;
		if($flags & (1 << 3)):
			$result['encrypted_requests_disabled'] = true;
		else:
			$result['encrypted_requests_disabled'] = false;
		endif;
		if($flags & (1 << 4)):
			$result['call_requests_disabled'] = true;
		else:
			$result['call_requests_disabled'] = false;
		endif;
		if($flags & (1 << 5)):
			$result['unconfirmed'] = true;
		else:
			$result['unconfirmed'] = false;
		endif;
		$result['hash'] = $reader->readLong();
		$result['device_model'] = $reader->tgreadBytes();
		$result['platform'] = $reader->tgreadBytes();
		$result['system_version'] = $reader->tgreadBytes();
		$result['api_id'] = $reader->readInt();
		$result['app_name'] = $reader->tgreadBytes();
		$result['app_version'] = $reader->tgreadBytes();
		$result['date_created'] = $reader->readInt();
		$result['date_active'] = $reader->readInt();
		$result['ip'] = $reader->tgreadBytes();
		$result['country'] = $reader->tgreadBytes();
		$result['region'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>