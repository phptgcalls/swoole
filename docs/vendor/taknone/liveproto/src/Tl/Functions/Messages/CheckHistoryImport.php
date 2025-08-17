<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string import_head
 * @return messages.HistoryImportParsed
 */

final class CheckHistoryImport extends Instance {
	public function request(string $import_head) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x43fe19f3);
		$writer->tgwriteBytes($import_head);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>