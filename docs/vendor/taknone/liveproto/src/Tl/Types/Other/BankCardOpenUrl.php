<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url string name
 * @return BankCardOpenUrl
 */

final class BankCardOpenUrl extends Instance {
	public function request(string $url,string $name) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf568028a);
		$writer->tgwriteBytes($url);
		$writer->tgwriteBytes($name);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['name'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>