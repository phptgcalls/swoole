<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param Vector<InputWallPaper> wallpapers
 * @return Vector<WallPaper>
 */

final class GetMultiWallPapers extends Instance {
	public function request(array $wallpapers) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x65ad71dc);
		$writer->tgwriteVector($wallpapers,'InputWallPaper');
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>