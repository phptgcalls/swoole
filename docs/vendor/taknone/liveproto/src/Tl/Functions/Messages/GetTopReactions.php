<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int limit long hash
 * @return messages.Reactions
 */

final class GetTopReactions extends Instance {
	public function request(int $limit,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xbb8125ba);
		$writer->writeInt($limit);
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