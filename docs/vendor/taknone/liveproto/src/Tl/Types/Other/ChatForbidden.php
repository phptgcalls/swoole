<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id string title
 * @return Chat
 */

final class ChatForbidden extends Instance {
	public function request(int $id,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6592a1a7);
		$writer->writeLong($id);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['title'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>