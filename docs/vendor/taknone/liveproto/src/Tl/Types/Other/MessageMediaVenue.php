<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param geopoint geo string title string address string provider string venue_id string venue_type
 * @return MessageMedia
 */

final class MessageMediaVenue extends Instance {
	public function request(object $geo,string $title,string $address,string $provider,string $venue_id,string $venue_type) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2ec0533f);
		$writer->write($geo->read());
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($address);
		$writer->tgwriteBytes($provider);
		$writer->tgwriteBytes($venue_id);
		$writer->tgwriteBytes($venue_type);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['geo'] = $reader->tgreadObject();
		$result['title'] = $reader->tgreadBytes();
		$result['address'] = $reader->tgreadBytes();
		$result['provider'] = $reader->tgreadBytes();
		$result['venue_id'] = $reader->tgreadBytes();
		$result['venue_type'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>