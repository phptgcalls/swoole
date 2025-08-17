<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<SecureValue> values securecredentialsencrypted credentials
 * @return MessageAction
 */

final class MessageActionSecureValuesSentMe extends Instance {
	public function request(array $values,object $credentials) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1b287353);
		$writer->tgwriteVector($values,'SecureValue');
		$writer->write($credentials->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['values'] = $reader->tgreadVector('SecureValue');
		$result['credentials'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>