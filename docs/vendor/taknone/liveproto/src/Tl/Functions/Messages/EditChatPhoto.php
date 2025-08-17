<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id inputchatphoto photo
 * @return Updates
 */

final class EditChatPhoto extends Instance {
	public function request(int $chat_id,object $photo) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x35ddd674);
		$writer->writeLong($chat_id);
		$writer->write($photo->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>