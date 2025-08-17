<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser id Vector<SecureValueError> errors
 * @return Bool
 */

final class SetSecureValueErrors extends Instance {
	public function request(object $id,array $errors) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x90c894b5);
		$writer->write($id->read());
		$writer->tgwriteVector($errors,'SecureValueError');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>