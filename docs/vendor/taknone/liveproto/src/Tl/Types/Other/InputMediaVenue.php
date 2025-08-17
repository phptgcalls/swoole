<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgeopoint geo_point string title string address string provider string venue_id string venue_type
 * @return InputMedia
 */

final class InputMediaVenue extends Instance {
	public function request(object $geo_point,string $title,string $address,string $provider,string $venue_id,string $venue_type) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc13d1c11);
		$writer->write($geo_point->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($address);
		$writer->tgwriteBytes($provider);
		$writer->tgwriteBytes($venue_id);
		$writer->tgwriteBytes($venue_type);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo_point'] = $reader->tgreadObject();
		$result['title'] = $reader->tgreadBytes();
		$result['address'] = $reader->tgreadBytes();
		$result['provider'] = $reader->tgreadBytes();
		$result['venue_id'] = $reader->tgreadBytes();
		$result['venue_type'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>