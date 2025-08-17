<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputwallpaper wallpaper
 * @return WallPaper
 */

final class GetWallPaper extends Instance {
	public function request(object $wallpaper) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfc8ddbea);
		$writer->write($wallpaper->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>