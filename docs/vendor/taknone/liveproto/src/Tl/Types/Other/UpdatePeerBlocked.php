<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer_id true blocked true blocked_my_stories_from
 * @return Update
 */

final class UpdatePeerBlocked extends Instance {
	public function request(object $peer_id,? true $blocked = null,? true $blocked_my_stories_from = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xebe07752);
		$flags = 0;
		$flags |= is_null($blocked) ? 0 : (1 << 0);
		$flags |= is_null($blocked_my_stories_from) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer_id->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$flags = $reader->readInt();
		if($flags & (1 << 0)):
			$result['blocked'] = true;
		else:
			$result['blocked'] = false;
		endif;
		if($flags & (1 << 1)):
			$result['blocked_my_stories_from'] = true;
		else:
			$result['blocked_my_stories_from'] = false;
		endif;
		$result['peer_id'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>