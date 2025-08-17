<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int chat_id int max_date int date
 * @return Update
 */

final class UpdateEncryptedMessagesRead extends Instance {
	public function request(int $chat_id,int $max_date,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x38fe25b7);
		$writer->writeInt($chat_id);
		$writer->writeInt($max_date);
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readInt();
		$result['max_date'] = $reader->readInt();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>