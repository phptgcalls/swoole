<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int chat_id long access_hash
 * @return InputEncryptedChat
 */

final class InputEncryptedChat extends Instance {
	public function request(int $chat_id,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf141b5e1);
		$writer->writeInt($chat_id);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readInt();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>