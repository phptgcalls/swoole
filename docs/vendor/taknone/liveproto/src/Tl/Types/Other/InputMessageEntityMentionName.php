<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length inputuser user_id
 * @return MessageEntity
 */

final class InputMessageEntityMentionName extends Instance {
	public function request(int $offset,int $length,object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x208e68c9);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		$result['user_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>