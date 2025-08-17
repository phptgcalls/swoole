<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer long import_id
 * @return Bool
 */

final class StartHistoryImport extends Instance {
	public function request(object $peer,int $import_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb43df344);
		$writer->write($peer->read());
		$writer->writeLong($import_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>