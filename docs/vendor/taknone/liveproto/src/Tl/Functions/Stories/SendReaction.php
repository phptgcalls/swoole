<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stories;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int story_id reaction reaction true add_to_recent
 * @return Updates
 */

final class SendReaction extends Instance {
	public function request(object $peer,int $story_id,object $reaction,? true $add_to_recent = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x7fd736b2);
		$flags = 0;
		$flags |= is_null($add_to_recent) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($story_id);
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>