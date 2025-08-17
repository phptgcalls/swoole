<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length
 * @return secret.MessageEntity
 */

final class MessageEntityBotCommand extends Instance {
	public function request(int $offset,int $length) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6cef8ac7);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		return new self($result);
	}
}

?>