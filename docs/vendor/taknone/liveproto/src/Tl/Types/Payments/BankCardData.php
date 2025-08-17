<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Payments;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string title Vector<BankCardOpenUrl> open_urls
 * @return payments.BankCardData
 */

final class BankCardData extends Instance {
	public function request(string $title,array $open_urls) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3e24e573);
		$writer->tgwriteBytes($title);
		$writer->tgwriteVector($open_urls,'BankCardOpenUrl');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['title'] = $reader->tgreadBytes();
		$result['open_urls'] = $reader->tgreadVector('BankCardOpenUrl');
		return new self($result);
	}
}

?>