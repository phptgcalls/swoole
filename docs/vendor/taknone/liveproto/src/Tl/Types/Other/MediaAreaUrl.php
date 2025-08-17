<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param mediaareacoordinates coordinates string url
 * @return MediaArea
 */

final class MediaAreaUrl extends Instance {
	public function request(object $coordinates,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x37381085);
		$writer->write($coordinates->read());
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['coordinates'] = $reader->tgreadObject();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>