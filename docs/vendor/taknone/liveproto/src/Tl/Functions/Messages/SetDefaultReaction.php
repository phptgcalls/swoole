<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param reaction reaction
 * @return Bool
 */

final class SetDefaultReaction extends Instance {
	public function request(object $reaction) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4f47a016);
		$writer->write($reaction->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>