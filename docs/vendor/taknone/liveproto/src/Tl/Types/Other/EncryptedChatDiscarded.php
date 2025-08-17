<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int id true history_deleted
 * @return EncryptedChat
 */

final class EncryptedChatDiscarded extends Instance {
	public function request(int $id,? true $history_deleted = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1e1c7c45);
		$flags = 0;
		$flags |= is_null($history_deleted) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['history_deleted'] = true;
		else:
			$result['history_deleted'] = false;
		endif;
		$result['id'] = $reader->readInt();
		return new self($result);
	}
}

?>