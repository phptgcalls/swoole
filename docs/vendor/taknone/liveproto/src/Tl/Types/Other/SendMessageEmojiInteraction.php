<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string emoticon int msg_id datajson interaction
 * @return SendMessageAction
 */

final class SendMessageEmojiInteraction extends Instance {
	public function request(string $emoticon,int $msg_id,object $interaction) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x25972bcb);
		$writer->tgwriteBytes($emoticon);
		$writer->writeInt($msg_id);
		$writer->write($interaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['emoticon'] = $reader->tgreadBytes();
		$result['msg_id'] = $reader->readInt();
		$result['interaction'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>