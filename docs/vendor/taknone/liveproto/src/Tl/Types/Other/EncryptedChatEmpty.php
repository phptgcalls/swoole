<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id
 * @return EncryptedChat
 */

final class EncryptedChatEmpty extends Instance {
	public function request(int $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xab7ec0a0);
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readInt();
		return new self($result);
	}
}

?>