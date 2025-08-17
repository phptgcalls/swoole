<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long first_msg_id long unique_id long server_salt
 * @return NewSession
 */

final class NewSessionCreated extends Instance {
	public function request(int $first_msg_id,int $unique_id,int $server_salt) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x9ec20908);
		$writer->writeLong($first_msg_id);
		$writer->writeLong($unique_id);
		$writer->writeLong($server_salt);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['first_msg_id'] = $reader->readLong();
		$result['unique_id'] = $reader->readLong();
		$result['server_salt'] = $reader->readLong();
		return new self($result);
	}
}

?>