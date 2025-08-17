<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer autosavesettings settings
 * @return AutoSaveException
 */

final class AutoSaveException extends Instance {
	public function request(object $peer,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x81602d47);
		$writer->write($peer->read());
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['peer'] = $reader->tgreadObject();
		$result['settings'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>