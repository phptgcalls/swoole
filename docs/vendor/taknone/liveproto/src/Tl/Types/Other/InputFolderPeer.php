<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int folder_id
 * @return InputFolderPeer
 */

final class InputFolderPeer extends Instance {
	public function request(object $peer,int $folder_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfbd2c296);
		$writer->write($peer->read());
		$writer->writeInt($folder_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['folder_id'] = $reader->readInt();
		return new self($result);
	}
}

?>