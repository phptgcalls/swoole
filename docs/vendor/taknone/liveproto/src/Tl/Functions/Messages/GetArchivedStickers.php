<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long offset_id int limit true masks true emojis
 * @return messages.ArchivedStickers
 */

final class GetArchivedStickers extends Instance {
	public function request(int $offset_id,int $limit,? true $masks = null,? true $emojis = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x57f17692);
		$flags = 0;
		$flags |= is_null($masks) ? 0 : (1 << 0);
		$flags |= is_null($emojis) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->writeLong($offset_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>