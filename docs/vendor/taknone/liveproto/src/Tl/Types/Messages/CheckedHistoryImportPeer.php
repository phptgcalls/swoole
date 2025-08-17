<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string confirm_text
 * @return messages.CheckedHistoryImportPeer
 */

final class CheckedHistoryImportPeer extends Instance {
	public function request(string $confirm_text) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa24de717);
		$writer->tgwriteBytes($confirm_text);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['confirm_text'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>