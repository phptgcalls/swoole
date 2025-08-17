<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length long document_id
 * @return MessageEntity
 */

final class MessageEntityCustomEmoji extends Instance {
	public function request(int $offset,int $length,int $document_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc8cf05f8);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		$writer->writeLong($document_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		$result['document_id'] = $reader->readLong();
		return new self($result);
	}
}

?>