<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param storiesstealthmode stealth_mode
 * @return Update
 */

final class UpdateStoriesStealthMode extends Instance {
	public function request(object $stealth_mode) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x2c084dc1);
		$writer->write($stealth_mode->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['stealth_mode'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>