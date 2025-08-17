<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int length string url
 * @return MessageEntity
 */

final class MessageEntityTextUrl extends Instance {
	public function request(int $offset,int $length,string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x76a6d327);
		$writer->writeInt($offset);
		$writer->writeInt($length);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['offset'] = $reader->readInt();
		$result['length'] = $reader->readInt();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>