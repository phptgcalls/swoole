<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string country_iso2 string state string city string street
 * @return GeoPointAddress
 */

final class GeoPointAddress extends Instance {
	public function request(string $country_iso2,? string $state = null,? string $city = null,? string $street = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde4c5d93);
		$flags = 0;
		$flags |= is_null($state) ? 0 : (1 << 0);
		$flags |= is_null($city) ? 0 : (1 << 1);
		$flags |= is_null($street) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->tgwriteBytes($country_iso2);
		if(is_null($state) === false):
			$writer->tgwriteBytes($state);
		endif;
		if(is_null($city) === false):
			$writer->tgwriteBytes($city);
		endif;
		if(is_null($street) === false):
			$writer->tgwriteBytes($street);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['country_iso2'] = $reader->tgreadBytes();
		if($flags & (1 << 0)):
			$result['state'] = $reader->tgreadBytes();
		else:
			$result['state'] = null;
		endif;
		if($flags & (1 << 1)):
			$result['city'] = $reader->tgreadBytes();
		else:
			$result['city'] = null;
		endif;
		if($flags & (1 << 2)):
			$result['street'] = $reader->tgreadBytes();
		else:
			$result['street'] = null;
		endif;
		return new self($result);
	}
}

?>