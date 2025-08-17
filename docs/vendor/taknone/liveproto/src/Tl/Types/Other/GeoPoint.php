<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double long double lat long access_hash int accuracy_radius
 * @return GeoPoint
 */

final class GeoPoint extends Instance {
	public function request(float $long,float $lat,int $access_hash,? int $accuracy_radius = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb2a2f663);
		$flags = 0;
		$flags |= is_null($accuracy_radius) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeDouble($long);
		$writer->writeDouble($lat);
		$writer->writeLong($access_hash);
		if(is_null($accuracy_radius) === false):
			$writer->writeInt($accuracy_radius);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['long'] = $reader->readDouble();
		$result['lat'] = $reader->readDouble();
		$result['access_hash'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['accuracy_radius'] = $reader->readInt();
		else:
			$result['accuracy_radius'] = null;
		endif;
		return new self($result);
	}
}

?>