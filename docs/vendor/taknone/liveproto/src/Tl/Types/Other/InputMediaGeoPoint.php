<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point
 * @return InputMedia
 */

final class InputMediaGeoPoint extends Instance {
	public function request(object $geo_point) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf9c44144);
		$writer->write($geo_point->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo_point'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>