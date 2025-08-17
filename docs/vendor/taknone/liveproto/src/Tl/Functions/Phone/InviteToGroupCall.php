<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<InputUser> users
 * @return Updates
 */

final class InviteToGroupCall extends Instance {
	public function request(object $call,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7b393160);
		$writer->write($call->read());
		$writer->tgwriteVector($users,'InputUser');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>