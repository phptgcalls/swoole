<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long msg_id int seq_no int bytes
 * @return RpcDropAnswer
 */

final class RpcAnswerDropped extends Instance {
	public function request(int $msg_id,int $seq_no,int $bytes) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xa43ad8b7);
		$writer->writeLong($msg_id);
		$writer->writeInt($seq_no);
		$writer->writeInt($bytes);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['msg_id'] = $reader->readLong();
		$result['seq_no'] = $reader->readInt();
		$result['bytes'] = $reader->readInt();
		return new self($result);
	}
}

?>