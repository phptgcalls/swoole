<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id peer peer_id
 * @return Message
 */

final class MessageEmpty extends Instance {
	public function request(int $id,? object $peer_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x90a6ca84);
		$flags = 0;
		$flags |= is_null($peer_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		if(is_null($peer_id) === false):
			$writer->write($peer_id->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['id'] = $reader->readInt();
		if($flags & (1 << 0)):
			$result['peer_id'] = $reader->tgreadObject();
		else:
			$result['peer_id'] = null;
		endif;
		return new self($result);
	}
}

?>