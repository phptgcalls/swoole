<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param encryptedchat chat int date
 * @return Update
 */

final class UpdateEncryption extends Instance {
	public function request(object $chat,int $date) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb4a2e88d);
		$writer->write($chat->read());
		$writer->writeInt($date);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat'] = $reader->tgreadObject();
		$result['date'] = $reader->readInt();
		return new self($result);
	}
}

?>