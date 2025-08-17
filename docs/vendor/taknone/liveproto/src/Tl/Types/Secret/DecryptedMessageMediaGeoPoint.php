<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double lat double long
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaGeoPoint extends Instance {
	public function request(float $lat,float $long) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35480a59);
		$writer->writeDouble($lat);
		$writer->writeDouble($long);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['lat'] = $reader->readDouble();
		$result['long'] = $reader->readDouble();
		return new self($result);
	}
}

?>