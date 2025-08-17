<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param int start_seq_no int end_seq_no
 * @return secret.DecryptedMessageAction
 */

final class DecryptedMessageActionResend extends Instance {
	public function request(int $start_seq_no,int $end_seq_no) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x511110b0);
		$writer->writeInt($start_seq_no);
		$writer->writeInt($end_seq_no);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['start_seq_no'] = $reader->readInt();
		$result['end_seq_no'] = $reader->readInt();
		return new self($result);
	}
}

?>