<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id true big true add_to_recent Vector<Reaction> reaction
 * @return Updates
 */

final class SendReaction extends Instance {
	public function request(object $peer,int $msg_id,? true $big = null,? true $add_to_recent = null,? array $reaction = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xd30d78d4);
		$flags = 0;
		$flags |= is_null($big) ? 0 : (1 << 1);
		$flags |= is_null($add_to_recent) ? 0 : (1 << 2);
		$flags |= is_null($reaction) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		if(is_null($reaction) === false):
			$writer->tgwriteVector($reaction,'Reaction');
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>