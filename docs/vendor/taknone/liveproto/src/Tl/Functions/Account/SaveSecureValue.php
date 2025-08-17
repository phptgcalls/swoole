<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputsecurevalue value long secure_secret_id
 * @return SecureValue
 */

final class SaveSecureValue extends Instance {
	public function request(object $value,int $secure_secret_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x899fe31d);
		$writer->write($value->read());
		$writer->writeLong($secure_secret_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>