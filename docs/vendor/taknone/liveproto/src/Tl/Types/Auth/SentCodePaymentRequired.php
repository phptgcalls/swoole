<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string store_product string phone_code_hash
 * @return auth.SentCode
 */

final class SentCodePaymentRequired extends Instance {
	public function request(string $store_product,string $phone_code_hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd7cef980);
		$writer->tgwriteBytes($store_product);
		$writer->tgwriteBytes($phone_code_hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['store_product'] = $reader->tgreadBytes();
		$result['phone_code_hash'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>