<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Secret;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long volume_id int local_id long secret
 * @return secret.FileLocation
 */

final class FileLocationUnavailable extends Instance {
	public function request(int $volume_id,int $local_id,int $secret) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7c596b46);
		$writer->writeLong($volume_id);
		$writer->writeInt($local_id);
		$writer->writeLong($secret);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['volume_id'] = $reader->readLong();
		$result['local_id'] = $reader->readInt();
		$result['secret'] = $reader->readLong();
		return new self($result);
	}
}

?>