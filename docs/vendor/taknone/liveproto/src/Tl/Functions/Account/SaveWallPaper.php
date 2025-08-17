<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputwallpaper wallpaper bool unsave wallpapersettings settings
 * @return Bool
 */

final class SaveWallPaper extends Instance {
	public function request(object $wallpaper,bool $unsave,object $settings) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x6c5a5b37);
		$writer->write($wallpaper->read());
		$writer->tgwriteBool($unsave);
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