<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length string language
 * @return secret.MessageEntity
 */

final class MessageEntityPre extends Instance {
	public function request(int $offset,int $length,string $language) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x73924be0);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		$writer->tgwriteBytes($language);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		$result['language'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>