<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer inputfile file int media_count
 * @return messages.HistoryImport
 */

final class InitHistoryImport extends Instance {
	public function request(object $peer,object $file,int $media_count) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x34090c3b);
		$writer->write($peer->read());
		$writer->write($file->read());
		$writer->writeInt($media_count);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>