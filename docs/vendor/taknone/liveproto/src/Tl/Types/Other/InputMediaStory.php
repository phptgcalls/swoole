<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id
 * @return InputMedia
 */

final class InputMediaStory extends Instance {
	public function request(object $peer,int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x89fdd778);
		$writer->write($peer->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['id'] = $reader->readInt();
		return new self($result);
	}
}

?>