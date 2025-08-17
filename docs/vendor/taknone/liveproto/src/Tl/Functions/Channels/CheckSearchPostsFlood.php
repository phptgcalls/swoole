<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string query
 * @return SearchPostsFlood
 */

final class CheckSearchPostsFlood extends Instance {
	public function request(? string $query = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x22567115);
		$flags = 0;
		$flags |= is_null($query) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($query) === false):
			$writer->tgwriteBytes($query);
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>