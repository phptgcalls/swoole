<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param messagemedia media
 * @return MessageExtendedMedia
 */

final class MessageExtendedMedia extends Instance {
	public function request(object $media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xee479c64);
		$writer->write($media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['media'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>