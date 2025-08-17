<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int value string emoticon
 * @return MessageMedia
 */

final class MessageMediaDice extends Instance {
	public function request(int $value,string $emoticon) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3f7ee58b);
		$writer->writeInt($value);
		$writer->tgwriteBytes($emoticon);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['value'] = $reader->readInt();
		$result['emoticon'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>