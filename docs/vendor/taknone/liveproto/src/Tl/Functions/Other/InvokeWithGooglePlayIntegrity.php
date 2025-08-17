<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string nonce string token x query
 * @return X
 */

final class InvokeWithGooglePlayIntegrity extends Instance {
	public function request(string $nonce,string $token,object $query) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1df92984);
		$writer->tgwriteBytes($nonce);
		$writer->tgwriteBytes($token);
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