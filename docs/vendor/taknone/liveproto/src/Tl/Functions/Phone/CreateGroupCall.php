<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Phone;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int random_id true rtmp_stream string title int schedule_date
 * @return Updates
 */

final class CreateGroupCall extends Instance {
	public function request(object $peer,int $random_id,? true $rtmp_stream = null,? string $title = null,? int $schedule_date = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x48cdc6d8);
		$flags = 0;
		$flags |= is_null($rtmp_stream) ? 0 : (1 << 2);
		$flags |= is_null($title) ? 0 : (1 << 0);
		$flags |= is_null($schedule_date) ? 0 : (1 << 1);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($random_id);
		if(is_null($title) === false):
			$writer->tgwriteBytes($title);
		endif;
		if(is_null($schedule_date) === false):
			$writer->writeInt($schedule_date);
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