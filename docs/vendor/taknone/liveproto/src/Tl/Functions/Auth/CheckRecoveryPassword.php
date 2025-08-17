<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Auth;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string code
 * @return Bool
 */

final class CheckRecoveryPassword extends Instance {
	public function request(string $code) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd36bf79);
		$writer->tgwriteBytes($code);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>