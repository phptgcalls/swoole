<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param double lat double long string title string address string provider string venue_id
 * @return secret.DecryptedMessageMedia
 */

final class DecryptedMessageMediaVenue extends Instance {
	public function request(float $lat,float $long,string $title,string $address,string $provider,string $venue_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8a0df56f);
		$writer->writeDouble($lat);
		$writer->writeDouble($long);
		$writer->tgwriteBytes($title);
		$writer->tgwriteBytes($address);
		$writer->tgwriteBytes($provider);
		$writer->tgwriteBytes($venue_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['lat'] = $reader->readDouble();
		$result['long'] = $reader->readDouble();
		$result['title'] = $reader->tgreadBytes();
		$result['address'] = $reader->tgreadBytes();
		$result['provider'] = $reader->tgreadBytes();
		$result['venue_id'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>