<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Bots;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputuser bot string username bool active
 * @return Bool
 */

final class ToggleUsername extends Instance {
	public function request(object $bot,string $username,bool $active) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x53ca973);
		$writer->write($bot->read());
		$writer->tgwriteBytes($username);
		$writer->tgwriteBool($active);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>