<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title long chat_id
 * @return MessageAction
 */

final class MessageActionChannelMigrateFrom extends Instance {
	public function request(string $title,int $chat_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xea3948e9);
		$writer->tgwriteBytes($title);
		$writer->writeLong($chat_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['chat_id'] = $reader->readLong();
		return new self($result);
	}
}

?>