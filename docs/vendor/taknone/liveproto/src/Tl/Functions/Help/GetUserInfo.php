<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Help;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id
 * @return help.UserInfo
 */

final class GetUserInfo extends Instance {
	public function request(object $user_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x38a08d3);
		$writer->write($user_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>