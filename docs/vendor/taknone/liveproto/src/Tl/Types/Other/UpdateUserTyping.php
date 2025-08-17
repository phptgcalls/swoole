<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long user_id sendmessageaction action
 * @return Update
 */

final class UpdateUserTyping extends Instance {
	public function request(int $user_id,object $action) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc01e857f);
		$writer->writeLong($user_id);
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['user_id'] = $reader->readLong();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>