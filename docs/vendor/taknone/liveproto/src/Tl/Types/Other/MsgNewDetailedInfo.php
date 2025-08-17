<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long answer_msg_id int bytes int status
 * @return MsgDetailedInfo
 */

final class MsgNewDetailedInfo extends Instance {
	public function request(int $answer_msg_id,int $bytes,int $status) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x809db6df);
		$writer->writeLong($answer_msg_id);
		$writer->writeInt($bytes);
		$writer->writeInt($status);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['answer_msg_id'] = $reader->readLong();
		$result['bytes'] = $reader->readInt();
		$result['status'] = $reader->readInt();
		return new self($result);
	}
}

?>