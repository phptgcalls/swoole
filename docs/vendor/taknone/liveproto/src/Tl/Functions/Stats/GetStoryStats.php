<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Stats;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer int id true dark
 * @return stats.StoryStats
 */

final class GetStoryStats extends Instance {
	public function request(object $peer,int $id,? true $dark = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x374fef40);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		$writer->writeInt($id);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>