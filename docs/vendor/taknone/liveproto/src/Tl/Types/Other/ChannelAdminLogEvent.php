<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long id int date long user_id channeladminlogeventaction action
 * @return ChannelAdminLogEvent
 */

final class ChannelAdminLogEvent extends Instance {
	public function request(int $id,int $date,int $user_id,object $action) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x1fad68cd);
		$writer->writeLong($id);
		$writer->writeInt($date);
		$writer->writeLong($user_id);
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['id'] = $reader->readLong();
		$result['date'] = $reader->readInt();
		$result['user_id'] = $reader->readLong();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>