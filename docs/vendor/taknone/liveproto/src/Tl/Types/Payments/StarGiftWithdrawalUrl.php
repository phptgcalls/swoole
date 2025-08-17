<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string url
 * @return payments.StarGiftWithdrawalUrl
 */

final class StarGiftWithdrawalUrl extends Instance {
	public function request(string $url) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x84aa3a9c);
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