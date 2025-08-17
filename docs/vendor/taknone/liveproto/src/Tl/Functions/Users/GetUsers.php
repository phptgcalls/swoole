<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Users;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputUser> id
 * @return Vector<User>
 */

final class GetUsers extends Instance {
	public function request(array $id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd91a548);
		$writer->tgwriteVector($id,'InputUser');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>