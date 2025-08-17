<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long bad_msg_id int bad_msg_seqno int error_code long new_server_salt
 * @return BadMsgNotification
 */

final class BadServerSalt extends Instance {
	public function request(int $bad_msg_id,int $bad_msg_seqno,int $error_code,int $new_server_salt) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xedab447b);
		$writer->writeLong($bad_msg_id);
		$writer->writeInt($bad_msg_seqno);
		$writer->writeInt($error_code);
		$writer->writeLong($new_server_salt);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['bad_msg_id'] = $reader->readLong();
		$result['bad_msg_seqno'] = $reader->readInt();
		$result['error_code'] = $reader->readInt();
		$result['new_server_salt'] = $reader->readLong();
		return new self($result);
	}
}

?>