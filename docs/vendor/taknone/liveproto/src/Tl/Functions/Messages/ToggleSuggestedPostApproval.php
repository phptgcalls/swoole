<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int msg_id true reject int schedule_date string reject_comment
 * @return Updates
 */

final class ToggleSuggestedPostApproval extends Instance {
	public function request(object $peer,int $msg_id,? true $reject = null,? int $schedule_date = null,? string $reject_comment = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8107455c);
		$flags = 0;
		$flags |= is_null($reject) ? 0 : (1 << 1);
		$flags |= is_null($schedule_date) ? 0 : (1 << 0);
		$flags |= is_null($reject_comment) ? 0 : (1 << 2);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($msg_id);
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
		endif;
		if(is_null($reject_comment) === false):
			$writer->tgwriteBytes($reject_comment);
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