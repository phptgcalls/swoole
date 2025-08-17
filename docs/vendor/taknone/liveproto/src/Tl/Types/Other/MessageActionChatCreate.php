<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title Vector<long> users
 * @return MessageAction
 */

final class MessageActionChatCreate extends Instance {
	public function request(string $title,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbd47cbad);
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($users,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['users'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>