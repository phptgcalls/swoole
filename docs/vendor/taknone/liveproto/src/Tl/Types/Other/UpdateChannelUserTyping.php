<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long channel_id peer from_id sendmessageaction action int top_msg_id
 * @return Update
 */

final class UpdateChannelUserTyping extends Instance {
	public function request(int $channel_id,object $from_id,object $action,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8c88c923);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->writeLong($channel_id);
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		$writer->write($from_id->read());
		$writer->write($action->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		if($flags & (1 << 0)):
			$result['top_msg_id'] = $reader->readInt();
		else:
			$result['top_msg_id'] = null;
		endif;
		$result['from_id'] = $reader->tgreadObject();
		$result['action'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>