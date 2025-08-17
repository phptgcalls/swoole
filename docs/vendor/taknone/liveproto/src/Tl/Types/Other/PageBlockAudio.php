<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long audio_id pagecaption caption
 * @return PageBlock
 */

final class PageBlockAudio extends Instance {
	public function request(int $audio_id,object $caption) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x804361ea);
		$writer->writeLong($audio_id);
		$writer->write($caption->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['audio_id'] = $reader->readLong();
		$result['caption'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>