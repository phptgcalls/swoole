<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int max_id inputpeer parent_peer int min_date int max_date
 * @return messages.AffectedHistory
 */

final class DeleteSavedHistory extends Instance {
	public function request(object $peer,int $max_id,? object $parent_peer = null,? int $min_date = null,? int $max_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4dc5085f);
		$flags = 0;
		$flags |= is_null($parent_peer) ? 0 : (1 << 0);
		$flags |= is_null($min_date) ? 0 : (1 << 2);
		$flags |= is_null($max_date) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($parent_peer) === false):
			$writer->write($parent_peer->read());
		endif;
		$writer->write($peer->read());
		$writer->writeInt($max_id);
		if(is_null($min_date) === false):
			$writer->writeInt($min_date);
		endif;
		if(is_null($max_date) === false):
			$writer->writeInt($max_date);
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