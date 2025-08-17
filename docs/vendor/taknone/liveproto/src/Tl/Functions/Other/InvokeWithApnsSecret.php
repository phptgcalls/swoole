<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string nonce string secret x query
 * @return X
 */

final class InvokeWithApnsSecret extends Instance {
	public function request(string $nonce,string $secret,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xdae54f8);
		$writer->tgwriteBytes($nonce);
		$writer->tgwriteBytes($secret);
		$writer->write($query->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>