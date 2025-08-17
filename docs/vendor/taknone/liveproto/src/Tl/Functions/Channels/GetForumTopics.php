<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int offset_date int offset_id int offset_topic int limit string q
 * @return messages.ForumTopics
 */

final class GetForumTopics extends Instance {
	public function request(object $channel,int $offset_date,int $offset_id,int $offset_topic,int $limit,? string $q = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xde560d1);
		$flags = 0;
		$flags |= is_null($q) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($channel->read());
		if(is_null($q) === false):
			$writer->tgwriteBytes($q);
		endif;
		$writer->writeInt($offset_date);
		$writer->writeInt($offset_id);
		$writer->writeInt($offset_topic);
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