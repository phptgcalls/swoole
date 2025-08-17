<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int date messagemedia media
 * @return BotPreviewMedia
 */

final class BotPreviewMedia extends Instance {
	public function request(int $date,object $media) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x23e91ba3);
		$writer->writeInt($date);
		$writer->write($media->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['date'] = $reader->readInt();
		$result['media'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>