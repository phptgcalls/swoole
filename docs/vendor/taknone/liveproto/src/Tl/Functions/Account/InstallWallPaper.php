<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputwallpaper wallpaper wallpapersettings settings
 * @return Bool
 */

final class InstallWallPaper extends Instance {
	public function request(object $wallpaper,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xfeed5769);
		$writer->write($wallpaper->read());
		$writer->write($settings->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>