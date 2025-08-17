<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SecureRequiredType> types
 * @return SecureRequiredType
 */

final class SecureRequiredTypeOneOf extends Instance {
	public function request(array $types) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x27477b4);
		$writer->tgwriteVector($types,'SecureRequiredType');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['types'] = $reader->tgreadVector('SecureRequiredType');
		return new self($result);
	}
}

?>