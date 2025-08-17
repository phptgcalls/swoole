<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long chat_id string title
 * @return Updates
 */

final class EditChatTitle extends Instance {
	public function request(int $chat_id,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x73783ffd);
		$writer->writeLong($chat_id);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>