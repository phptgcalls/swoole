<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string street_line1 string street_line2 string city string state string country_iso2 string post_code
 * @return PostAddress
 */

final class PostAddress extends Instance {
	public function request(string $street_line1,string $street_line2,string $city,string $state,string $country_iso2,string $post_code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1e8caaeb);
		$writer->tgwriteBytes($street_line1);
		$writer->tgwriteBytes($street_line2);
		$writer->tgwriteBytes($city);
		$writer->tgwriteBytes($state);
		$writer->tgwriteBytes($country_iso2);
		$writer->tgwriteBytes($post_code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['street_line1'] = $reader->tgreadBytes();
		$result['street_line2'] = $reader->tgreadBytes();
		$result['city'] = $reader->tgreadBytes();
		$result['state'] = $reader->tgreadBytes();
		$result['country_iso2'] = $reader->tgreadBytes();
		$result['post_code'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>