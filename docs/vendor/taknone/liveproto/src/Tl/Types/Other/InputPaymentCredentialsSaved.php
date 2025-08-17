<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string id bytes tmp_password
 * @return InputPaymentCredentials
 */

final class InputPaymentCredentialsSaved extends Instance {
	public function request(string $id,string $tmp_password) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc10eb2cf);
		$writer->tgwriteBytes($id);
		$writer->tgwriteBytes($tmp_password);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->tgreadBytes();
		$result['tmp_password'] = $reader->tgreadBytes();
		return new self($result);
	}
}

?>