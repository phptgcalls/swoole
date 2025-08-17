<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length long user_id
 * @return MessageEntity
 */

final class MessageEntityMentionName extends Instance {
	public function request(int $offset,int $length,int $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdc7b1140);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		$writer->writeLong($user_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		return new self($result);
	}
}

?>