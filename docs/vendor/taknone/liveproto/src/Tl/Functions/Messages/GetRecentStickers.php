<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash true attached
 * @return messages.RecentStickers
 */

final class GetRecentStickers extends Instance {
	public function request(int $hash,? true $attached = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9da9403b);
		$flags = 0;
		$flags |= is_null($attached) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>