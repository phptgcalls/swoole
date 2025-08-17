<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string address geopoint geo_point
 * @return BusinessLocation
 */

final class BusinessLocation extends Instance {
	public function request(string $address,? object $geo_point = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xac5c1af7);
		$flags = 0;
		$flags |= is_null($geo_point) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($geo_point) === false):
			$writer->write($geo_point->read());
		endif;
		$writer->tgwriteBytes($address);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['geo_point'] = $reader->tgreadObject();
		else:
			$result['geo_point'] = null;
		endif;
		$result['address'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>