<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash long bot_id string domain string browser string platform int date_created int date_active string ip string region
 * @return WebAuthorization
 */

final class WebAuthorization extends Instance {
	public function request(int $hash,int $bot_id,string $domain,string $browser,string $platform,int $date_created,int $date_active,string $ip,string $region) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa6f8f452);
		$writer->writeLong($hash);
		$writer->writeLong($bot_id);
		$writer->tgwriteBytes($domain);
		$writer->tgwriteBytes($browser);
		$writer->tgwriteBytes($platform);
		$writer->writeInt($date_created);
		$writer->writeInt($date_active);
		$writer->tgwriteBytes($ip);
		$writer->tgwriteBytes($region);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['hash'] = $reader->readLong();
		$result['bot_id'] = $reader->readLong();
		$result['domain'] = $reader->tgreadBytes();
		$result['browser'] = $reader->tgreadBytes();
		$result['platform'] = $reader->tgreadBytes();
		$result['date_created'] = $reader->readInt();
		$result['date_active'] = $reader->readInt();
		$result['ip'] = $reader->tgreadBytes();
		$result['region'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>