<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id long channel_id
 * @return InputChannel
 */

final class InputChannelFromMessage extends Instance {
	public function request(object $peer,int $msg_id,int $channel_id) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x5b934f9d);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		$writer->writeLong($channel_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['msg_id'] = $reader->readInt();
		$result['channel_id'] = $reader->readLong();
		return new self($result);
	}
}

?>