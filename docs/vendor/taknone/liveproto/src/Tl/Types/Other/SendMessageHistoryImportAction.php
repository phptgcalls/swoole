<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int progress
 * @return SendMessageAction
 */

final class SendMessageHistoryImportAction extends Instance {
	public function request(int $progress) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdbda9246);
		$writer->writeInt($progress);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['progress'] = $reader->readInt();
		return new self($result);
	}
}

?>