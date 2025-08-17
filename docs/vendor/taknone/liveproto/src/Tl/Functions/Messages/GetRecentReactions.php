<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int limit long hash
 * @return messages.Reactions
 */

final class GetRecentReactions extends Instance {
	public function request(int $limit,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x39461db2);
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