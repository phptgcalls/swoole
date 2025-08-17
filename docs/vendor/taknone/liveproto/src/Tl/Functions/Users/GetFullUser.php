<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser id
 * @return users.UserFull
 */

final class GetFullUser extends Instance {
	public function request(object $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb60f5918);
		$writer->write($id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>