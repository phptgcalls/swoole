<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Types\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param 
 * @return messages.StickerSetInstallResult
 */

final class StickerSetInstallResultSuccess extends Instance {
	public function request() : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0x38641628);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		return new self($result);
	}
}

?>