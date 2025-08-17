<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates geopoint geo geopointaddress address
 * @return MediaArea
 */

final class MediaAreaGeoPoint extends Instance {
	public function request(object $coordinates,object $geo,? object $address = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xcad5452d);
		$flags = 0;
		$flags |= is_null($address) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($coordinates->read());
		$writer->write($geo->read());
		if(is_null($address) === false):
			$writer->write($address->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['coordinates'] = $reader->tgreadObject();
		$result['geo'] = $reader->tgreadObject();
		if($flags & (1 << 0)):
			$result['address'] = $reader->tgreadObject();
		else:
			$result['address'] = null;
		endif;
		return new self($result);
	}
}

?>