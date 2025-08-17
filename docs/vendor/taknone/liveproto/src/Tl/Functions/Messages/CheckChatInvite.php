<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string hash
 * @return ChatInvite
 */

final class CheckChatInvite extends Instance {
	public function request(string $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3eadb1bb);
		$writer->tgwriteBytes($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>