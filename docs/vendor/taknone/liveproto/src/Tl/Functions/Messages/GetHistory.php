<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int offset_id int offset_date int add_offset int limit int max_id int min_id long hash
 * @return messages.Messages
 */

final class GetHistory extends Instance {
	public function request(object $peer,int $offset_id,int $offset_date,int $add_offset,int $limit,int $max_id,int $min_id,int $hash) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4423e6c5);
		$writer->write($peer->read());
		$writer->writeInt($offset_id);
		$writer->writeInt($offset_date);
		$writer->writeInt($add_offset);
		$writer->writeInt($limit);
		$writer->writeInt($max_id);
		$writer->writeInt($min_id);
		$writer->writeLong($hash);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>