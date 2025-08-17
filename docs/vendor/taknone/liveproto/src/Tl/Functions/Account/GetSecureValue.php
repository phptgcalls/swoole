<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SecureValueType> types
 * @return Vector<SecureValue>
 */

final class GetSecureValue extends Instance {
	public function request(array $types) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x73665bc2);
		$writer->tgwriteVector($types,'SecureValueType');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>