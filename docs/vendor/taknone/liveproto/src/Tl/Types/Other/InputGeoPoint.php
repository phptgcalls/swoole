<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double lat double long int accuracy_radius
 * @return InputGeoPoint
 */

final class InputGeoPoint extends Instance {
	public function request(float $lat,float $long,? int $accuracy_radius = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x48222faf);
		$flags = 0;
		$flags |= is_null($accuracy_radius) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeDouble($lat);
		$writer->writeDouble($long);
		if(is_null($accuracy_radius) === false):
			$writer->writeInt($accuracy_radius);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['lat'] = $reader->readDouble();
		$result['long'] = $reader->readDouble();
		if($flags & (1 << 0)):
			$result['accuracy_radius'] = $reader->readInt();
		else:
			$result['accuracy_radius'] = null;
		endif;
		return new self($result);
	}
}

?>