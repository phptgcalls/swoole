<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Channels;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputchannel broadcast inputchannel group
 * @return Bool
 */

final class SetDiscussionGroup extends Instance {
	public function request(object $broadcast,object $group) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x40582bb2);
		$writer->write($broadcast->read());
		$writer->write($group->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>