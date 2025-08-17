<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int max_id true just_clear true revoke int min_date int max_date
 * @return messages.AffectedHistory
 */

final class DeleteHistory extends Instance {
	public function request(object $peer,int $max_id,? true $just_clear = null,? true $revoke = null,? int $min_date = null,? int $max_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xb08f922a);
		$flags = 0;
		$flags |= is_null($just_clear) ? 0 : (1 << 0);
		$flags |= is_null($revoke) ? 0 : (1 << 1);
		$flags |= is_null($min_date) ? 0 : (1 << 2);
		$flags |= is_null($max_date) ? 0 : (1 << 3);
		$writer->writeInt($flags);
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