<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates string slug
 * @return MediaArea
 */

final class MediaAreaStarGift extends Instance {
	public function request(object $coordinates,string $slug) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5787686d);
		$writer->write($coordinates->read());
		$writer->tgwriteBytes($slug);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['slug'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>