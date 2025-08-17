<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int offset_id int add_offset int limit int max_id int min_id int top_msg_id
 * @return messages.Messages
 */

final class GetUnreadMentions extends Instance {
	public function request(object $peer,int $offset_id,int $add_offset,int $limit,int $max_id,int $min_id,? int $top_msg_id = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf107e790);
		$flags = 0;
		$flags |= is_null($top_msg_id) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		if(is_null($top_msg_id) === false):
			$writer->writeInt($top_msg_id);
		endif;
		$writer->writeInt($offset_id);
		$writer->writeInt($add_offset);
		$writer->writeInt($limit);
		$writer->writeInt($max_id);
		$writer->writeInt($min_id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>