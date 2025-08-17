<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string name int color
 * @return AttachMenuBotIconColor
 */

final class AttachMenuBotIconColor extends Instance {
	public function request(string $name,int $color) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x4576f3f0);
		$writer->tgwriteBytes($name);
		$writer->writeInt($color);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['name'] = $reader->tgreadBytes();
		$result['color'] = $reader->readInt();
		return new self($result);
	}
}

?>