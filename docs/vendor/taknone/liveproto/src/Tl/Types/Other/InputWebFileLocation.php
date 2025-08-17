<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url long access_hash
 * @return InputWebFileLocation
 */

final class InputWebFileLocation extends Instance {
	public function request(string $url,int $access_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc239d686);
		$writer->tgwriteBytes($url);
		$writer->writeLong($access_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['access_hash'] = $reader->readLong();
		return new self($result);
	}
}

?>