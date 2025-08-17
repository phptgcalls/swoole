<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel channel int topic_id bool pinned
 * @return Updates
 */

final class UpdatePinnedForumTopic extends Instance {
	public function request(object $channel,int $topic_id,bool $pinned) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c2d9026);
		$writer->write($channel->read());
		$writer->writeInt($topic_id);
		$writer->tgwriteBool($pinned);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>