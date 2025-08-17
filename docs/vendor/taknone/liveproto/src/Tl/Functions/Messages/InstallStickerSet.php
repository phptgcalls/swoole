<?php

declare(strict_types = 1);

namespace Tak\Liveproto\Tl\Functions\Messages;

use Tak\Liveproto\Utils\Binary;

use Tak\Liveproto\Utils\Instance;

/**
 * @param inputstickerset stickerset bool archived
 * @return messages.StickerSetInstallResult
 */

final class InstallStickerSet extends Instance {
	public function request(object $stickerset,bool $archived) : Binary {
		$writer = new Binary(true);
		$writer->writeInt(0xc78fe460);
		$writer->write($stickerset->read());
		$writer->tgwriteBool($archived);
		return $writer;
	}
	public function response(Binary $reader) : object {
		$result = array();
		$result['result'] = $reader->tgreadObject();
		return new self($result);
	}
}

?>