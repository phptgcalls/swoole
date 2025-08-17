<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param true dark inputtheme theme string format basetheme base_theme
 * @return Bool
 */

final class InstallTheme extends Instance {
	public function request(? true $dark = null,? object $theme = null,? string $format = null,? object $base_theme = null) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc727bb3b);
		$flags = 0;
		$flags |= is_null($dark) ? 0 : (1 << 0);
		$flags |= is_null($theme) ? 0 : (1 << 1);
		$flags |= is_null($format) ? 0 : (1 << 2);
		$flags |= is_null($base_theme) ? 0 : (1 << 3);
		$writer->writeInt($flags);
		if(is_null($theme) === false):
			$writer->write($theme->read());
		endif;
		if(is_null($format) === false):
			$writer->tgwriteBytes($format);
		endif;
		if(is_null($base_theme) === false):
			$writer->write($base_theme->read());
		endif;
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>