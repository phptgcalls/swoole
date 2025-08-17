<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url string title
 * @return PaymentFormMethod
 */

final class PaymentFormMethod extends Instance {
	public function request(string $url,string $title) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x88f8f21b);
		$writer->tgwriteBytes($url);
		$writer->tgwriteBytes($title);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['url'] = $reader->tgreadBytes();
		$result['title'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>