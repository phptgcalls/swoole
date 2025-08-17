<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id long max_id int limit
 * @return messages.Chats
 */

final class GetCommonChats extends Instance {
	public function request(object $user_id,int $max_id,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe40ca104);
		$writer->write($user_id->read());
		$writer->writeLong($max_id);
		$writer->writeInt($limit);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>