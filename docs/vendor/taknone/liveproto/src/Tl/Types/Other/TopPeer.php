<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer double rating
 * @return TopPeer
 */

final class TopPeer extends Instance {
	public function request(object $peer,float $rating) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedcdc05b);
		$writer->write($peer->read());
		$writer->writeDouble($rating);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['rating'] = $reader->readDouble();
		return new self($result);
	}
}

?>