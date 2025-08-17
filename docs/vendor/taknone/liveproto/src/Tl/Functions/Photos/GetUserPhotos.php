<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Photos;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser user_id int offset long max_id int limit
 * @return photos.Photos
 */

final class GetUserPhotos extends Instance {
	public function request(object $user_id,int $offset,int $max_id,int $limit) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x91cd32a8);
		$writer->write($user_id->read());
		$writer->writeInt($offset);
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