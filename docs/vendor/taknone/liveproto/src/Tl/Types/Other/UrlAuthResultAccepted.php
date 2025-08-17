<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url
 * @return UrlAuthResult
 */

final class UrlAuthResultAccepted extends Instance {
	public function request(string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8f8c0e4e);
		$writer->tgwriteBytes($url);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>