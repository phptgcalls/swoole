<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputpeer peer true disabled
 * @return Bool
 */

final class TogglePeerTranslations extends Instance {
	public function request(object $peer,? true $disabled = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xe47cb579);
		$flags = 0;
		$flags |= is_null($disabled) ? 0 : (1 << 0);
		$writer->writeInt($flags);
		$writer->write($peer->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>