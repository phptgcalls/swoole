<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int album_id
 * @return Bool
 */

final class DeleteAlbum extends Instance {
	public function request(object $peer,int $album_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8d3456d0);
		$writer->write($peer->read());
		$writer->writeInt($album_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>