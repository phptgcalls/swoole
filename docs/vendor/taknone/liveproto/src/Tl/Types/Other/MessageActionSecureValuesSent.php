<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SecureValueType> types
 * @return MessageAction
 */

final class MessageActionSecureValuesSent extends Instance {
	public function request(array $types) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd95c6154);
		$writer->tgwriteVector($types,'SecureValueType');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['types'] = $reader->tgreadVector('SecureValueType');
		return new self($result);
	}
}

?>