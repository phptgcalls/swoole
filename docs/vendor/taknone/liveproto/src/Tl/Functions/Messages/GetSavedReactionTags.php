<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param long hash inputpeer peer
 * @return messages.SavedReactionTags
 */

final class GetSavedReactionTags extends Instance {
	public function request(int $hash,? object $peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3637e05b);
		$flags = 0;
		$flags |= is_null($peer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($peer) === false):
			$writer->write($peer->read());
		endif;
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