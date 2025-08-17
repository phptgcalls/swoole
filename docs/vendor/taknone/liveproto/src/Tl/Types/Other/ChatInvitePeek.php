<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param chat chat int expires
 * @return ChatInvite
 */

final class ChatInvitePeek extends Instance {
	public function request(object $chat,int $expires) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x61695cb0);
		$writer->write($chat->read());
		$writer->writeInt($expires);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['chat'] = $reader->tgreadObject();
		$result['expires'] = $reader->readInt();
		return new self($result);
	}
}

?>