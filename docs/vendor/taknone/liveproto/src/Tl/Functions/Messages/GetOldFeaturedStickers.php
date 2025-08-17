<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int offset int limit long hash
 * @return messages.FeaturedStickers
 */

final class GetOldFeaturedStickers extends Instance {
	public function request(int $offset,int $limit,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7ed094a1);
		$writer->writeInt($offset);
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