<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Account;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param autodownloadsettings low autodownloadsettings medium autodownloadsettings high
 * @return account.AutoDownloadSettings
 */

final class AutoDownloadSettings extends Instance {
	public function request(object $low,object $medium,object $high) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x63cacf26);
		$writer->write($low->read());
		$writer->write($medium->read());
		$writer->write($high->read());
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['low'] = $reader->tgreadObject();
		$result['medium'] = $reader->tgreadObject();
		$result['high'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>