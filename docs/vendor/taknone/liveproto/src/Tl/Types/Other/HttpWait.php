<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int max_delay int wait_after int max_wait
 * @return HttpWait
 */

final class HttpWait extends Instance {
	public function request(int $max_delay,int $wait_after,int $max_wait) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9299359f);
		$writer->writeInt($max_delay);
		$writer->writeInt($wait_after);
		$writer->writeInt($max_wait);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['max_delay'] = $reader->readInt();
		$result['wait_after'] = $reader->readInt();
		$result['max_wait'] = $reader->readInt();
		return new self($result);
	}
}

?>