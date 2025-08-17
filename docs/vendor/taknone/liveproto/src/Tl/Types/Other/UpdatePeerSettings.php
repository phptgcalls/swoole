<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param peer peer peersettings settings
 * @return Update
 */

final class UpdatePeerSettings extends Instance {
	public function request(object $peer,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6a7e7366);
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