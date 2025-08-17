<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param string format inputtheme theme
 * @return Theme
 */

final class GetTheme extends Instance {
	public function request(string $format,object $theme) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x3a5869ec);
		$writer->tgwriteBytes($format);
		$writer->write($theme->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>