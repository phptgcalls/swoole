<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Other;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param theme theme
 * @return Update
 */

final class UpdateTheme extends Instance {
	public function request(object $theme) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x8216fba3);
		$writer->write($theme->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['theme'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>