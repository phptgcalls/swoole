<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputtheme theme bool unsave
 * @return Bool
 */

final class SaveTheme extends Instance {
	public function request(object $theme,bool $unsave) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xf257106c);
		$writer->write($theme->read());
		$writer->tgwriteBool($unsave);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>