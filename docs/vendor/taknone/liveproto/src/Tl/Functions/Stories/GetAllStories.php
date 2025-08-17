<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true next true hidden string state
 * @return stories.AllStories
 */

final class GetAllStories extends Instance {
	public function request(? true $next = null,? true $hidden = null,? string $state = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xeeb0d625);
		$flags = 0;
		$flags |= is_null($next) ? 0 : (1 << 1);
		$flags |= is_null($hidden) ? 0 : (1 << 2);
		$flags |= is_null($state) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($state) === false):
			$writer->tgwriteBytes($state);
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