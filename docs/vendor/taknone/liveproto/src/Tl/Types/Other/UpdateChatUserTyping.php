<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id peer from_id sendmessageaction action
 * @return Update
 */

final class UpdateChatUserTyping extends Instance {
	public function request(int $chat_id,object $from_id,object $action) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x83487af0);
		$writer->writeLong($chat_id);
		$writer->write($from_id->read());
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat_id'] = $reader->readLong();
		$result['from_id'] = $reader->tgreadObject();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>