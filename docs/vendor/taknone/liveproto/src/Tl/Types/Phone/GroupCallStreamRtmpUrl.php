<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url string key
 * @return phone.GroupCallStreamRtmpUrl
 */

final class GroupCallStreamRtmpUrl extends Instance {
	public function request(string $url,string $key) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2dbf3432);
		$writer->tgwriteBytes($url);
		$writer->tgwriteBytes($key);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['key'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>