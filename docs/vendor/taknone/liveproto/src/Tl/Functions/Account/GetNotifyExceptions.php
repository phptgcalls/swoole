<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true compare_sound true compare_stories inputnotifypeer peer
 * @return Updates
 */

final class GetNotifyExceptions extends Instance {
	public function request(? true $compare_sound = null,? true $compare_stories = null,? object $peer = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53577479);
		$flags = 0;
		$flags |= is_null($compare_sound) ? 0 : (1 << 1);
		$flags |= is_null($compare_stories) ? 0 : (1 << 2);
		$flags |= is_null($peer) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		if(is_null($peer) === false):
			$writer->write($peer->read());
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