<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string hash
 * @return Updates
 */

final class ImportChatInvite extends Instance {
	public function request(string $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c50051c);
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