<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputgroupcall call Vector<long> users
 * @return MessageAction
 */

final class MessageActionInviteToGroupCall extends Instance {
	public function request(object $call,array $users) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x502f92f7);
		$writer->write($call->read());
		$writer->tgwriteVector($users,'long');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['call'] = $reader->tgreadObject();
		$result['users'] = $reader->tgreadVector('long');
		return new self($result);
	}
}

?>