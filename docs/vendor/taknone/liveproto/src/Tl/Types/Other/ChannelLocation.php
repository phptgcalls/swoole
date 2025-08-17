<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo_point string address
 * @return ChannelLocation
 */

final class ChannelLocation extends Instance {
	public function request(object $geo_point,string $address) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x209b82db);
		$writer->write($geo_point->read());
		$writer->tgwriteBytes($address);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo_point'] = $reader->tgreadObject();
		$result['address'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>